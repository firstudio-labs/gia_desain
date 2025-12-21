<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Keranjang;
use App\Models\OwnerWhatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /**
     * Display checkout page
     */
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $keranjangs = Keranjang::where('user_id', Auth::id())
            ->with('produk')
            ->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->route('shop')->with('error', 'Keranjang Anda kosong');
        }

        $items = [];
        $subtotal = 0;
        $totalQuantity = 0;

        foreach ($keranjangs as $keranjang) {
            $produk = $keranjang->produk;
            if ($produk) {
                $harga = $produk->diskon > 0 
                    ? $produk->harga - ($produk->harga * $produk->diskon / 100)
                    : $produk->harga;

                $items[] = [
                    'id' => $keranjang->id,
                    'produk_id' => $produk->id,
                    'judul' => $produk->judul,
                    'harga' => $harga,
                    'quantity' => $keranjang->quantity,
                    'total' => $harga * $keranjang->quantity,
                ];

                $subtotal += $harga * $keranjang->quantity;
                $totalQuantity += $keranjang->quantity;
            }
        }

        $ownerWhatsapp = OwnerWhatsapp::first();
        $user = Auth::user();

        return view('page_web.pesanan.index', compact('items', 'subtotal', 'totalQuantity', 'ownerWhatsapp', 'user'));
    }

    /**
     * Process checkout and save order
     */
    public function processCheckout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'no_wa_penerima' => 'required|string|max:20',
            'alamat_penerima' => 'required|string',
        ]);

        $keranjangs = Keranjang::where('user_id', Auth::id())
            ->with('produk')
            ->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->route('shop')->with('error', 'Keranjang Anda kosong');
        }

        $items = [];
        $subtotal = 0;
        $totalQuantity = 0;

        foreach ($keranjangs as $keranjang) {
            $produk = $keranjang->produk;
            if ($produk) {
                $harga = $produk->diskon > 0 
                    ? $produk->harga - ($produk->harga * $produk->diskon / 100)
                    : $produk->harga;

                $items[] = [
                    'produk_id' => $produk->id,
                    'judul' => $produk->judul,
                    'harga' => $harga,
                    'quantity' => $keranjang->quantity,
                    'total' => $harga * $keranjang->quantity,
                ];

                $subtotal += $harga * $keranjang->quantity;
                $totalQuantity += $keranjang->quantity;
            }
        }

        // Generate unique order ID
        $orderId = $this->generateOrderId();

        // Simpan pesanan ke database
        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'order_id' => $orderId,
            'produk_items' => $items,
            'quantity' => $totalQuantity,
            'sub_total' => $subtotal,
            'total' => $subtotal,
            'status' => 'pending',
        ]);

        // Hapus keranjang setelah checkout
        Keranjang::where('user_id', Auth::id())->delete();

        // Ambil data owner WhatsApp
        $ownerWhatsapp = OwnerWhatsapp::first();
        
        if (!$ownerWhatsapp || !$ownerWhatsapp->no_wa) {
            return redirect()->back()->with('error', 'Nomor WhatsApp owner belum dikonfigurasi');
        }

        // Ambil data user
        $user = Auth::user();

        // Siapkan pesan dan tautan WhatsApp
        $whatsappLink = $this->generateWhatsappLink(
            $ownerWhatsapp,
            $pesanan->order_id,
            $items,
            $subtotal,
            $totalQuantity,
            $request,
            $pesanan->id
        );

        // Return view dengan data untuk membuat pesan WhatsApp
        return view('page_web.pesanan.index', compact('items', 'subtotal', 'totalQuantity', 'ownerWhatsapp', 'user', 'pesanan', 'request', 'whatsappLink'));
    }

    /**
     * Generate unique order ID
     */
    private function generateOrderId(): string
    {
        $timestamp = date('YmdHis');
        $userId = str_pad(Auth::id(), 4, '0', STR_PAD_LEFT);
        $randomString = strtoupper(substr(uniqid(), -6));
        
        return 'ORD-' . $timestamp . '-' . $userId . '-' . $randomString;
    }

    /**
     * Generate formatted WhatsApp link with order details.
     */
    private function generateWhatsappLink($ownerWhatsapp, $orderId, array $items, float $subtotal, int $totalQuantity, Request $request, int $idPesanan): string
    {
        $namaPenerima = $request->nama_penerima;
        $noWaPenerima = $request->no_wa_penerima;
        $alamatPenerima = $request->alamat_penerima;

        $detailPesanan = "🛒 *Detail Pesanan:*\n";
        foreach ($items as $index => $item) {
            $detailPesanan .= ($index + 1) . ". " . $item['judul'] . "\n";
            $detailPesanan .= "   Qty: " . $item['quantity'] . " x Rp " . number_format($item['harga'], 0, ',', '.') . "\n";
            $detailPesanan .= "   Subtotal: Rp " . number_format($item['total'], 0, ',', '.') . "\n\n";
        }

        $defaultMessage = function () use ($namaPenerima, $noWaPenerima, $alamatPenerima, $detailPesanan, $subtotal, $totalQuantity, $orderId) {
            $pesan = "Halo, saya ingin melakukan pemesanan:\n\n";
            $pesan .= "*Detail Penerima:*\n";
            $pesan .= "> _Nama: " . $namaPenerima . "_\n";
            $pesan .= "> _No. WhatsApp: " . $noWaPenerima . "_\n";
            $pesan .= "> _Alamat: " . $alamatPenerima . "_\n\n";
            $pesan .= $detailPesanan;
            $pesan .= "*Total: Rp " . number_format($subtotal, 0, ',', '.') . "*\n";
            $pesan .= "Total Item: " . $totalQuantity . " item\n";
            $pesan .= "> _ID Pesanan: #" . $orderId . "_\n";
            return $pesan;
        };

        $pesan = $defaultMessage();
        $templatePesan = $ownerWhatsapp->template_pesan ?? '';
        $hasPlaceholder = false;
        if ($templatePesan && trim($templatePesan) !== '') {
            $hasPlaceholder = preg_match('/\{(nama_penerima|no_wa_penerima|alamat_penerima|detail_pesanan|total|id_pesanan|total_item)\}/', $templatePesan) === 1;
        }

        if ($templatePesan && trim($templatePesan) !== '' && $hasPlaceholder) {
            $templateOriginal = $templatePesan;
            $placeholderMap = [
                '{nama_penerima}' => $namaPenerima,
                '{no_wa_penerima}' => $noWaPenerima,
                '{alamat_penerima}' => $alamatPenerima,
                '{detail_pesanan}' => $detailPesanan,
                '{total}' => number_format($subtotal, 0, ',', '.'),
                '{id_pesanan}' => $idPesanan,
                '{total_item}' => $totalQuantity,
            ];

            foreach ($placeholderMap as $placeholder => $value) {
                $templatePesan = str_replace($placeholder, $value, $templatePesan);
            }

            $tambahanInfo = [];
            if (
                strpos($templateOriginal, '{nama_penerima}') === false ||
                strpos($templateOriginal, '{no_wa_penerima}') === false ||
                strpos($templateOriginal, '{alamat_penerima}') === false
            ) {
                $detailPenerima = "*Detail Penerima:*\n";
                $detailPenerima .= "Nama: " . $namaPenerima . "\n";
                $detailPenerima .= "No. WhatsApp: " . $noWaPenerima . "\n";
                $detailPenerima .= "Alamat: " . $alamatPenerima;
                $tambahanInfo[] = $detailPenerima;
            }
            if (strpos($templateOriginal, '{detail_pesanan}') === false) {
                $tambahanInfo[] = $detailPesanan;
            }
            if (strpos($templateOriginal, '{total}') === false) {
                $tambahanInfo[] = "*Total: Rp " . number_format($subtotal, 0, ',', '.') . "*";
            }
            if (strpos($templateOriginal, '{total_item}') === false) {
                $tambahanInfo[] = "Total Item: " . $totalQuantity . " item";
            }
            if (strpos($templateOriginal, '{id_pesanan}') === false) {
                $tambahanInfo[] = "ID Pesanan: #" . $idPesanan;
            }

            $pesan = trim($templatePesan);
            if (!empty($tambahanInfo)) {
                $pesan .= "\n\n" . implode("\n", array_filter($tambahanInfo));
            }
        }

        $noWaOwner = preg_replace('/\D/', '', $ownerWhatsapp->no_wa);

        return "https://wa.me/" . $noWaOwner . "?text=" . urlencode($pesan);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        //
    }
}

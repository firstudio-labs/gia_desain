<?php

namespace App\Http\Controllers\admin;

use App\Models\ManageProduk;
use App\Models\ManageKategori;
use App\Models\ManageSubKategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ManageProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = ManageProduk::with(['kategori','subKategori'])->latest()->get();
        return view('page_admin.manage_produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = ManageKategori::orderBy('nama_kategori')->get();
        return view('page_admin.manage_produk.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:manage_kategoris,id',
            'sub_kategori_id' => 'required|exists:manage_sub_kategoris,id',
            'harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|integer|min:0|max:100',
            'sku' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
            'berat' => 'nullable|numeric|min:0',
            'ukuran' => 'nullable|string|max:255',
            'warna' => 'nullable|string|max:255',
            'gambar_produk' => 'nullable|array',
            'gambar_produk.*' => 'file|mimes:jpg,jpeg,png,gif,webp,svg|max:3072',
        ], [
            'judul.required' => 'Judul produk wajib diisi.',
            'judul.max' => 'Judul produk maksimal 255 karakter.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'sub_kategori_id.required' => 'Sub kategori wajib dipilih.',
            'sub_kategori_id.exists' => 'Sub kategori yang dipilih tidak valid.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
            'diskon.integer' => 'Diskon harus berupa angka bulat.',
            'diskon.min' => 'Diskon tidak boleh negatif.',
            'diskon.max' => 'Diskon maksimal 100%.',
            'sku.required' => 'SKU wajib diisi.',
            'sku.max' => 'SKU maksimal 255 karakter.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
            'berat.numeric' => 'Berat harus berupa angka.',
            'berat.min' => 'Berat tidak boleh negatif.',
            'ukuran.max' => 'Ukuran maksimal 255 karakter.',
            'warna.max' => 'Warna maksimal 255 karakter.',
            'gambar_produk.array' => 'Gambar produk harus berupa array.',
            'gambar_produk.*.file' => 'File yang diupload harus berupa file.',
            'gambar_produk.*.mimes' => 'Format gambar harus jpg, jpeg, png, gif, webp, atau svg.',
            'gambar_produk.*.max' => 'Ukuran gambar maksimal 3MB.',
        ]);

        try {
            $slug = Str::slug($request->judul . '-' . Str::random(6));
            $gambarPaths = [];

            if ($request->hasFile('gambar_produk')) {
                foreach ($request->file('gambar_produk') as $file) {
                    if (!$file) { continue; }
                    $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                    $targetDir = public_path('produk/gambar');
                    if (!is_dir($targetDir)) { @mkdir($targetDir, 0755, true); }
                    $file->move($targetDir, $filename);
                    $gambarPaths[] = $filename;
                }
            }

            ManageProduk::create([
                'slug' => $slug,
                'judul' => $validated['judul'],
                'kategori_id' => $validated['kategori_id'],
                'sub_kategori_id' => $validated['sub_kategori_id'],
                'gambar_produk' => !empty($gambarPaths) ? $gambarPaths : null,
                'harga' => $validated['harga'],
                'diskon' => $validated['diskon'] ?? null,
                'sku' => $validated['sku'],
                'deskripsi' => $validated['deskripsi'],
                'status' => $validated['status'],
                'berat' => $validated['berat'] ?? null,
                'ukuran' => $validated['ukuran'] ?? null,
                'warna' => $validated['warna'] ?? null,
            ]);

            Alert::toast('Produk berhasil disimpan', 'success')->position('top-end');
            return redirect()->route('manage-produk.index');
        } catch (\Exception $e) {
            Log::error('Error store produk: '.$e->getMessage());
            Alert::toast('Terjadi kesalahan saat menyimpan', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageProduk $manageProduk)
    {
        $manageProduk->load(['kategori','subKategori']);
        return view('page_admin.manage_produk.show', compact('manageProduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageProduk $manageProduk)
    {
        $kategoris = ManageKategori::orderBy('nama_kategori')->get();
        // Gunakan old kategori_id jika ada (saat error), jika tidak gunakan kategori_id dari database
        $kategoriId = old('kategori_id', $manageProduk->kategori_id);
        $subKategoris = ManageSubKategori::where('kategori_id', $kategoriId)->orderBy('first_nama_sub_kategori')->get();
        return view('page_admin.manage_produk.edit', compact('manageProduk','kategoris','subKategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageProduk $manageProduk)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:manage_kategoris,id',
            'sub_kategori_id' => 'required|exists:manage_sub_kategoris,id',
            'harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|integer|min:0|max:100',
            'sku' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
            'berat' => 'nullable|numeric|min:0',
            'ukuran' => 'nullable|string|max:255',
            'warna' => 'nullable|string|max:255',
            'gambar_produk' => 'nullable|array',
            'gambar_produk.*' => 'file|mimes:jpg,jpeg,png,gif,webp,svg|max:3072',
            'hapus_gambar' => 'nullable|array',
            'hapus_gambar.*' => 'string',
        ], [
            'judul.required' => 'Judul produk wajib diisi.',
            'judul.max' => 'Judul produk maksimal 255 karakter.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'sub_kategori_id.required' => 'Sub kategori wajib dipilih.',
            'sub_kategori_id.exists' => 'Sub kategori yang dipilih tidak valid.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
            'diskon.integer' => 'Diskon harus berupa angka bulat.',
            'diskon.min' => 'Diskon tidak boleh negatif.',
            'diskon.max' => 'Diskon maksimal 100%.',
            'sku.required' => 'SKU wajib diisi.',
            'sku.max' => 'SKU maksimal 255 karakter.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
            'berat.numeric' => 'Berat harus berupa angka.',
            'berat.min' => 'Berat tidak boleh negatif.',
            'ukuran.max' => 'Ukuran maksimal 255 karakter.',
            'warna.max' => 'Warna maksimal 255 karakter.',
            'gambar_produk.array' => 'Gambar produk harus berupa array.',
            'gambar_produk.*.file' => 'File yang diupload harus berupa file.',
            'gambar_produk.*.mimes' => 'Format gambar harus jpg, jpeg, png, gif, webp, atau svg.',
            'gambar_produk.*.max' => 'Ukuran gambar maksimal 3MB.',
        ]);

        try {
            $gambarExisting = is_array($manageProduk->gambar_produk) ? $manageProduk->gambar_produk : [];

            // Hapus gambar yang dipilih
            if ($request->filled('hapus_gambar')) {
                foreach ($request->hapus_gambar as $filename) {
                    $path = public_path('produk/gambar/' . $filename);
                    if (is_file($path)) { @unlink($path); }
                    $gambarExisting = array_values(array_filter($gambarExisting, function($g) use ($filename){ return $g !== $filename; }));
                }
            }

            // Tambah gambar baru
            if ($request->hasFile('gambar_produk')) {
                foreach ($request->file('gambar_produk') as $file) {
                    if (!$file) { continue; }
                    $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                    $targetDir = public_path('produk/gambar');
                    if (!is_dir($targetDir)) { @mkdir($targetDir, 0755, true); }
                    $file->move($targetDir, $filename);
                    $gambarExisting[] = $filename;
                }
            }

            $manageProduk->update([
                'judul' => $validated['judul'],
                'kategori_id' => $validated['kategori_id'],
                'sub_kategori_id' => $validated['sub_kategori_id'],
                'gambar_produk' => !empty($gambarExisting) ? array_values($gambarExisting) : null,
                'harga' => $validated['harga'],
                'diskon' => $validated['diskon'] ?? null,
                'sku' => $validated['sku'],
                'deskripsi' => $validated['deskripsi'],
                'status' => $validated['status'],
                'berat' => $validated['berat'] ?? null,
                'ukuran' => $validated['ukuran'] ?? null,
                'warna' => $validated['warna'] ?? null,
            ]);

            Alert::toast('Produk berhasil diperbarui', 'success')->position('top-end');
            return redirect()->route('manage-produk.index');
        } catch (\Exception $e) {
            Log::error('Error update produk: '.$e->getMessage());
            Alert::toast('Terjadi kesalahan saat memperbarui', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageProduk $manageProduk)
    {
        try {
            // Hapus file gambar
            if (is_array($manageProduk->gambar_produk)) {
                foreach ($manageProduk->gambar_produk as $filename) {
                    $path = public_path('produk/gambar/' . $filename);
                    if (is_file($path)) { @unlink($path); }
                }
            }
            $manageProduk->delete();
            Alert::toast('Produk berhasil dihapus', 'success')->position('top-end');
            return redirect()->route('manage-produk.index');
        } catch (\Exception $e) {
            Log::error('Error delete produk: '.$e->getMessage());
            Alert::toast('Terjadi kesalahan saat menghapus', 'error')->position('top-end');
            return redirect()->back();
        }
    }

    // Endpoint AJAX: ambil sub kategori berdasarkan kategori
    public function subKategoriByKategori(Request $request)
    {
        $request->validate(['kategori_id' => 'required|exists:manage_kategoris,id']);
        $subs = ManageSubKategori::where('kategori_id', $request->kategori_id)
            ->orderBy('first_nama_sub_kategori')
            ->get(['id','first_nama_sub_kategori']);
        return response()->json($subs);
    }
}

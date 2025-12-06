<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\Beranda;
use App\Models\ManageSection;
use App\Models\ManageProduk;
use App\Models\ManageKategori;
use App\Models\ManageLayanan;
use App\Models\OwnerWhatsapp;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $profil = Profil::first();
        $beranda = Beranda::first();
        $manageLayanans = ManageLayanan::orderBy('created_at', 'desc')->take(4)->get();
        $ownerWhatsapp = OwnerWhatsapp::first();
        // Ambil section dengan is_new = true atau yang terbaru
        $sectionTerbaru = ManageSection::where('is_new', true)
            ->orderBy('created_at', 'desc')
            ->first();
        
        // Jika tidak ada yang is_new = true, ambil yang terbaru
        if (!$sectionTerbaru) {
            $sectionTerbaru = ManageSection::orderBy('created_at', 'desc')->first();
        }
        
        // Ambil produk berdasarkan product_ids dari section
        $produkTerbaru = collect();
        if ($sectionTerbaru) {
            // Ambil product_ids langsung dari database sebagai JSON string
            $rawProductIds = DB::table('manage_sections')
                ->where('id', $sectionTerbaru->id)
                ->value('product_ids');
            
            // Decode JSON string ke array
            if ($rawProductIds) {
                $productIds = json_decode($rawProductIds, true);
                
                // Jika decode berhasil dan array tidak kosong
                if (is_array($productIds) && count($productIds) > 0) {
                    // Filter null/empty dan cast ke integer
                    $productIds = array_filter($productIds, function($id) {
                        return $id !== null && $id !== '' && $id !== 0;
                    });
                    
                    // Cast semua ID ke integer
                    $productIds = array_map(function($id) {
                        return (int) $id;
                    }, array_values($productIds));
                    
                    // Ambil produk berdasarkan ID
                    if (count($productIds) > 0) {
                        $produkTerbaru = ManageProduk::whereIn('id', $productIds)
                            ->where('status', 'aktif')
                            ->get()
                            ->sortBy(function($produk) use ($productIds) {
                                // Urutkan sesuai urutan di product_ids
                                $index = array_search($produk->id, $productIds);
                                return $index !== false ? $index : 999;
                            })
                            ->values();
                    }
                }
            }
        }
        
        // Ambil produk dikelompokkan per kategori
        $produkPerKategori = ManageKategori::with(['produks' => function($query) {
            $query->where('status', 'aktif')
                  ->orderBy('created_at', 'desc')
                  ->take(8); // Ambil maksimal 8 produk per kategori
        }])
        ->whereHas('produks', function($query) {
            $query->where('status', 'aktif');
        })
        ->get()
        ->map(function($kategori) {
            return [
                'kategori' => $kategori,
                'produks' => $kategori->produks
            ];
        })
        ->filter(function($item) {
            return $item['produks']->count() > 0;
        });
        
        return view('page_web.landing.index', compact('profil', 'beranda', 'produkTerbaru', 'manageLayanans', 'ownerWhatsapp', 'produkPerKategori', 'sectionTerbaru'));
    }
}
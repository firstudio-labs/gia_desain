<?php

namespace App\Http\Controllers\admin;

use App\Models\ManageLayanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use RealRashid\SweetAlert\Facades\Alert;

class ManageLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manageLayanans = ManageLayanan::latest()->get();
        return view('page_admin.manage_layanans.index', compact('manageLayanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page_admin.manage_layanans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_layanan' => 'required|string|max:255',
            'deskripsi_layanan' => 'required|string',
            'gambar_layanan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'faq' => 'nullable|array',
            'faq.*.pertanyaan' => 'required_with:faq|string',
            'faq.*.jawaban' => 'required_with:faq|string',
        ], [
            'gambar_layanan.image' => 'File yang diupload harus berupa gambar.',
            'gambar_layanan.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau WEBP.',
            'gambar_layanan.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        try {
            // Buat direktori jika belum ada
            if (!file_exists(public_path('gambar_layanan/gambar'))) {
                mkdir(public_path('gambar_layanan/gambar'), 0755, true);
            }

            $gambar = null;
            if ($request->hasFile('gambar_layanan')) {
                $path = public_path('gambar_layanan/gambar');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                
                $gambar = time() . '.webp';
                $file = $request->file('gambar_layanan');
                
                // Kompresi dan konversi ke WebP
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file);
                $image->toWebp(80); // Kualitas 80%
                $image->save($path . '/' . $gambar);
            }
            $faqData = [];
            if ($request->has('faq') && is_array($request->faq)) {
                foreach ($request->faq as $faq) {
                    if (!empty($faq['pertanyaan']) && !empty($faq['jawaban'])) {
                        $faqData[] = [
                            'pertanyaan' => $faq['pertanyaan'],
                            'jawaban' => $faq['jawaban'],
                        ];
                    }
                }
            }

            ManageLayanan::create([
                'judul_layanan' => $request->judul_layanan,
                'deskripsi_layanan' => $request->deskripsi_layanan,
                'gambar_layanan' => $gambar,
                'faq' => !empty($faqData) ? $faqData : null,
            ]);

            Alert::toast('Data layanan berhasil disimpan', 'success')->position('top-end');
            return redirect()->route('manage-layanan.index');
        } catch (\Exception $e) {
            Log::error('Error storing ManageLayanan: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat menyimpan data', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageLayanan $manageLayanan)
    {
        return view('page_admin.manage_layanans.show', compact('manageLayanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageLayanan $manageLayanan)
    {
        return view('page_admin.manage_layanans.edit', compact('manageLayanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageLayanan $manageLayanan)
    {
        $request->validate([
            'judul_layanan' => 'required|string|max:255',
            'deskripsi_layanan' => 'required|string',
            'gambar_layanan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'faq' => 'nullable|array',
            'faq.*.pertanyaan' => 'required_with:faq|string',
            'faq.*.jawaban' => 'required_with:faq|string',
        ], [
            'gambar_layanan.image' => 'File yang diupload harus berupa gambar.',
            'gambar_layanan.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau WEBP.',
            'gambar_layanan.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        try {
            $updateData = [
                'judul_layanan' => $request->judul_layanan,
                'deskripsi_layanan' => $request->deskripsi_layanan,
            ];

            // Handle gambar upload
            if ($request->hasFile('gambar_layanan')) {
                // Hapus gambar lama jika ada
                if ($manageLayanan->gambar_layanan && file_exists(public_path('gambar_layanan/gambar/' . $manageLayanan->gambar_layanan))) {
                    unlink(public_path('gambar_layanan/gambar/' . $manageLayanan->gambar_layanan));
                }
                
                // Upload gambar baru dengan kompresi dan konversi ke WebP
                $path = public_path('gambar_layanan/gambar');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                
                $gambar = time() . '.webp';
                $file = $request->file('gambar_layanan');
                
                // Kompresi dan konversi ke WebP
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file);
                $image->toWebp(80); // Kualitas 80%
                $image->save($path . '/' . $gambar);
                
                $updateData['gambar_layanan'] = $gambar;
            }

            // Handle FAQ
            $faqData = [];
            if ($request->has('faq') && is_array($request->faq)) {
                foreach ($request->faq as $faq) {
                    if (!empty($faq['pertanyaan']) && !empty($faq['jawaban'])) {
                        $faqData[] = [
                            'pertanyaan' => $faq['pertanyaan'],
                            'jawaban' => $faq['jawaban'],
                        ];
                    }
                }
            }
            $updateData['faq'] = !empty($faqData) ? $faqData : null;

            $manageLayanan->update($updateData);

            Alert::toast('Data layanan berhasil diperbarui', 'success')->position('top-end');
            return redirect()->route('manage-layanan.index');
        } catch (\Exception $e) {
            Log::error('Error updating ManageLayanan: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat memperbarui data', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageLayanan $manageLayanan)
    {
        try {
            // Hapus gambar jika ada
            if ($manageLayanan->gambar_layanan && file_exists(public_path('gambar_layanan/gambar/' . $manageLayanan->gambar_layanan))) {
                unlink(public_path('gambar_layanan/gambar/' . $manageLayanan->gambar_layanan));
            }
            $manageLayanan->delete();
            Alert::toast('Data layanan berhasil dihapus', 'success')->position('top-end');
            return redirect()->route('manage-layanan.index');
        } catch (\Exception $e) {
            Log::error('Error deleting ManageLayanan: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat menghapus data', 'error')->position('top-end');
            return redirect()->back();
        }
    }
}

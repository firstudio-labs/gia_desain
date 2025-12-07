<?php

namespace App\Http\Controllers\admin;

use App\Models\ManageInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ManageInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infos = ManageInfo::latest()->get();
        return view('page_admin.manage_info.index', compact('infos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page_admin.manage_info.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        $filename = null;
        if ($request->hasFile('gambar')) {
            $dir = public_path('info/gambar');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $safeBase = Str::slug(pathinfo($request->file('gambar')->getClientOriginalName(), PATHINFO_FILENAME));
            $filename = time() . '_' . $safeBase . '.webp';
            
            // Kompresi dan konversi ke WebP
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('gambar'));
            $image->toWebp(80); // Kualitas 80%
            $image->save($dir . '/' . $filename);
        }

        ManageInfo::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'gambar' => $filename,
            'status' => $validated['status'],
        ]);

        Alert::toast('Info berhasil dibuat', 'success')->position('top-end');
        return redirect()->route('manage-info.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageInfo $manageInfo)
    {
        return view('page_admin.manage_info.show', ['manageInfo' => $manageInfo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageInfo $manageInfo)
    {
        return view('page_admin.manage_info.edit', ['manageInfo' => $manageInfo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageInfo $manageInfo)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        $data = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'status' => $validated['status'],
        ];

        if ($request->hasFile('gambar')) {
            $dir = public_path('info/gambar');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            // hapus gambar lama
            if (!empty($manageInfo->gambar)) {
                $oldPath = $dir . DIRECTORY_SEPARATOR . $manageInfo->gambar;
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
            $safeBase = Str::slug(pathinfo($request->file('gambar')->getClientOriginalName(), PATHINFO_FILENAME));
            $filename = time() . '_' . $safeBase . '.webp';
            
            // Kompresi dan konversi ke WebP
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('gambar'));
            $image->toWebp(80); // Kualitas 80%
            $image->save($dir . '/' . $filename);
            
            $data['gambar'] = $filename;
        }

        $manageInfo->update($data);

        Alert::toast('Info berhasil diperbarui', 'success')->position('top-end');
        return redirect()->route('manage-info.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageInfo $manageInfo)
    {
        if (!empty($manageInfo->gambar)) {
            $path = public_path('info/gambar/' . $manageInfo->gambar);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $manageInfo->delete();
        Alert::toast('Info berhasil dihapus', 'success')->position('top-end');
        return redirect()->route('manage-info.index');
    }
}

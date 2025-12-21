<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DaftarRiwayatPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pesanan::with('user')->latest();
        
        // Pencarian berdasarkan order_id
        if ($request->has('search') && $request->search != '') {
            $query->where('order_id', 'like', '%' . $request->search . '%');
        }
        
        $pesanans = $query->paginate(15)->withQueryString();
        
        return view('page_admin.riwayat_pesanan.index', compact('pesanans'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pesanan = Pesanan::with('user')->findOrFail($id);
        
        return view('page_admin.riwayat_pesanan.show', compact('pesanan'));
    }

    /**
     * Update status pesanan to 'proses'
     */
    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,proses,selesai'
        ]);

        $pesanan->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diubah menjadi ' . ucfirst($request->status));
    }
}


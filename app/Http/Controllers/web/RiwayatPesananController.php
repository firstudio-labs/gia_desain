<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('page_web.riwayat_pesanan.index', compact('pesanans'));
    }

    public function detail($id)
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();
        
        return view('page_web.riwayat_pesanan.detail', compact('pesanan'));
    }

    public function invoice($id)
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->where('id', $id)
            ->with('user')
            ->firstOrFail();
        
        // Cek apakah status sudah selesai
        if ($pesanan->status !== 'selesai') {
            return redirect()->route('riwayat-pesanan.detail', $id)
                ->with('error', 'Invoice hanya dapat dicetak jika status pesanan sudah selesai');
        }
        
        $profil = Profil::first();
        
        return view('page_web.riwayat_pesanan.invoice', compact('pesanan', 'profil'));
    }

    /**
     * Update status pesanan to 'selesai' by user
     */
    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        // Hanya bisa update jika status saat ini adalah 'proses'
        if ($pesanan->status !== 'proses') {
            return redirect()->back()->with('error', 'Status pesanan hanya dapat diubah ke selesai jika status saat ini adalah proses');
        }

        $pesanan->update([
            'status' => 'selesai'
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diubah menjadi selesai');
    }
}
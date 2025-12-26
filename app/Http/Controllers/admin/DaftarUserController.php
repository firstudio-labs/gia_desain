<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DaftarUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::where('role', '!=', 'superadmin')->latest();
        
        // Pencarian berdasarkan nama, email, atau username
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('username', 'like', '%' . $search . '%');
            });
        }
        
        $users = $query->paginate(15)->withQueryString();
        
        return view('page_admin.daftar_user.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::withCount('pesanans')->findOrFail($id);
        
        // Get pesanan statistics
        $totalPesanan = Pesanan::where('user_id', $user->id)->count();
        $pesananPending = Pesanan::where('user_id', $user->id)->where('status', 'pending')->count();
        $pesananProses = Pesanan::where('user_id', $user->id)->where('status', 'proses')->count();
        $pesananSelesai = Pesanan::where('user_id', $user->id)->where('status', 'selesai')->count();
        $totalBelanja = Pesanan::where('user_id', $user->id)->where('status', 'selesai')->sum('total');
        
        // Get recent pesanans
        $pesanans = Pesanan::where('user_id', $user->id)
            ->latest()
            ->paginate(10);
        
        return view('page_admin.daftar_user.show', compact('user', 'totalPesanan', 'pesananPending', 'pesananProses', 'pesananSelesai', 'totalBelanja', 'pesanans'));
    }
}


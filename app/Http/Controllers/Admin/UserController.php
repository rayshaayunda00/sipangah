<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ==========================
    // Daftar Pengguna + Pencarian
    // ==========================
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // ==========================
    // Form Tambah Pengguna
    // ==========================
    public function create()
    {
        return view('admin.users.create');
    }

    // ==========================
    // Simpan Pengguna Baru
    // ==========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',

            // Wajib 16 digit dan unik
            'nik'         => 'required|digits:16|unique:users,nik',

            // Tidak dibatasi karena kolom TEXT
            'alamat'      => 'required|string',

            // Boleh 10–16 digit
            'no_telepon'  => 'required|digits_between:10,16|unique:users,no_telepon',

            'email'       => 'required|email|unique:users,email',

            'password'    => 'required|min:6',

            'is_admin'    => 'required|in:0,1',
        ]);

        User::create([
            'name'        => $validated['name'],
            'nik'         => $validated['nik'],
            'alamat'      => $validated['alamat'],
            'no_telepon'  => $validated['no_telepon'],
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
            'is_admin'    => $validated['is_admin'],
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    // ==========================
    // Detail Pengguna
    // ==========================
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    // ==========================
    // Hapus Pengguna
    // ==========================
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'Pengguna berhasil dihapus.');
    }

    // ==========================
    // Dashboard Admin
    // ==========================
    public function dashboard()
    {
        return view('dashboard');
    }
}

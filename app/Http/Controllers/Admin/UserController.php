<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ✅ Daftar pengguna + pencarian
    public function index(Request $request)
    {
        $query = User::query();

        // Fitur pencarian berdasarkan nama, NIK, atau email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Ambil data terbaru dan paginasi
        $users = $query->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // ✅ Form tambah pengguna
    public function create()
    {
        return view('admin.users.create');
    }

    // ✅ Simpan pengguna baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'nik'         => 'required|string|max:20|unique:users,nik',
            'alamat'      => 'required|string|max:255',
            'no_telepon'  => 'required|string|max:20',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:6',
        ]);

        User::create([
            'name'        => $validated['name'],
            'nik'         => $validated['nik'],
            'alamat'      => $validated['alamat'],
            'no_telepon'  => $validated['no_telepon'],
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
            'is_admin'    => false, // supaya default jadi pengguna biasa
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    // ✅ Tampilkan detail pengguna
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    // ✅ Hapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'Pengguna berhasil dihapus.');
    }
}

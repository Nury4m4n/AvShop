<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserDetailController extends Controller
{
    public function index()
    {
        // Mengambil ID pengguna yang sedang login
        $userId = auth()->id();
        $userDetail = UserDetail::where('user_id', $userId)->first();

        // Mengarahkan ke halaman create jika detail pengguna belum ada
        if (!$userDetail) {
            return redirect()->route('user_details.create');
        }

        // Menampilkan detail pengguna jika sudah ada
        return view('user.user_details.index', compact('userDetail'));
    }

    public function create()
    {
        // Mengambil data pengguna yang sedang login
        return view('user.user_details.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'profile_picture' => 'required|image|max:2048', // Maksimal 2MB
        ]);

        $userDetail = new UserDetail();
        $userDetail->user_id = auth()->id();
        $userDetail->name = $request->name;
        $userDetail->phone = $request->phone;
        $userDetail->email = $request->email;
        $userDetail->address = $request->address;

        if ($request->hasFile('profile_picture')) {
            $userDetail->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        if ($userDetail->save()) {
            return redirect()->route('user_details.index')->with('success', 'Detail pengguna berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan detail pengguna.');
        }
    }

    public function edit(UserDetail $userDetail)
    {
        // Mengambil detail pengguna berdasarkan parameter
        return view('user.user_details.edit', compact('userDetail'));
    }

    public function update(Request $request, UserDetail $userDetail)
    {
        $this->validate($request, [
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            // Hapus gambar lama jika ada
            if ($userDetail->profile_picture) {
                Storage::delete('public/' . $userDetail->profile_picture);
            }
            $userDetail->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $userDetail->name = $request->name ?? $userDetail->name;
        $userDetail->phone = $request->phone ?? $userDetail->phone;
        $userDetail->email = $request->email ?? $userDetail->email;
        $userDetail->address = $request->address ?? $userDetail->address;

        if ($userDetail->save()) {
            return redirect()->route('user_details.index')->with('success', 'Detail pengguna berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui detail pengguna.');
        }
    }

    public function destroy(UserDetail $userDetail)
    {
        // Hapus gambar jika ada
        if ($userDetail->profile_picture) {
            Storage::delete('public/' . $userDetail->profile_picture);
        }

        if ($userDetail->delete()) {
            return redirect()->route('user_details.index')->with('success', 'Detail pengguna berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus detail pengguna.');
        }
    }
}
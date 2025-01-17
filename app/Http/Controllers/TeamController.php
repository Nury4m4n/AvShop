<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
   public function index(Request $request)
{
    $query = Team::orderBy('created_at', 'asc');

    // Filter berdasarkan Nama Anggota Tim
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // Filter berdasarkan Jabatan
    if ($request->filled('position')) {
        $query->where('position', 'like', '%' . $request->position . '%');
    }

    // Paginate hasil filter
    $teamMembers = $query->paginate(20);

    // Total anggota tim setelah filter
    $totalPage = $teamMembers->total();

    return view('admin.teams.index', compact('teamMembers', 'totalPage'));
}


    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'position' => 'required|string|max:255',
            'image' => 'image|max:2048|nullable',
        ]);

        $teamMember = new Team();
        $teamMember->name = $request->name;
        $teamMember->position = $request->position;
        $teamMember->phone = $request->phone;

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $teamMember->image = $request->file('image')->store('teams', 'public');
        }

        $teamMember->save();

        return redirect()->route('teams.index')->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $teamMember = Team::findOrFail($id);
        return view('admin.teams.edit', compact('teamMember'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'image|max:2048|nullable',
            'phone' => 'required|numeric',
        ]);

        $teamMember = Team::findOrFail($id);
        $teamMember->name = $request->name;
        $teamMember->position = $request->position;
        $teamMember->phone = $request->phone;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($teamMember->image) {
                Storage::disk('public')->delete($teamMember->image);
            }
            $teamMember->image = $request->file('image')->store('teams', 'public');
        }

        $teamMember->save();

        return redirect()->route('teams.index')->with('success', 'Anggota tim berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $teamMember = Team::findOrFail($id);

        if ($teamMember->image) {
            Storage::disk('public')->delete($teamMember->image);
        }

        $teamMember->delete();

        return redirect()->route('teams.index')->with('success', 'Anggota tim berhasil dihapus.');
    }
}
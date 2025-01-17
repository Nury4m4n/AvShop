<?php
// app/Http/Controllers/CarouselController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::orderBy('created_at', 'desc')->paginate(20);
        $totalPage = Carousel::count();
    
        return view('admin.carousels.index', compact('carousels', 'totalPage'));
    }

    public function create()
    {
        return view('admin.carousels.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        // Membuat instance Carousel baru
        $carousel = new Carousel();

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $carousel->image = $request->file('image')->store('carousels', 'public');
        }

        // Menyimpan data dan pengecekan apakah berhasil
        if ($carousel->save()) {
            return redirect()->route('carousels.index')->with('success', 'Carousel item added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add carousel item.');
        }
    }

    public function show($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.carousels.show', compact('carousel'));
    }

    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.carousels.edit', compact('carousel'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'image' => 'image|max:2048|nullable',
        ]);

        $carousel = Carousel::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($carousel->image) {
                Storage::delete('public/' . $carousel->image);
            }
            $carousel->image = $request->file('image')->store('carousels', 'public');
        }

        // Memperbarui data dan pengecekan apakah berhasil
        if ($carousel->save()) {
            return redirect()->route('carousels.index')->with('success', 'Carousel item updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update carousel item.');
        }
    }

    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);

        if ($carousel->image) {
            Storage::delete('public/' . $carousel->image);
        }

        if ($carousel->delete()) {
            return redirect()->route('carousels.index')->with('success', 'Carousel item deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete carousel item.');
        }
    }
}
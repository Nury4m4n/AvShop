<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index(Request $request)
{
    // Membuat query untuk mengambil data Testimonial
    $query = Testimonial::orderBy('created_at', 'desc');

    // Filter berdasarkan nama jika ada
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // Filter lainnya bisa ditambahkan di sini, jika diperlukan

    // Paginate hasil filter
    $testimonials = $query->paginate(20);

    // Total testimonial setelah filter
    $totalPage = $query->count();

    // Mengembalikan view dengan data testimonial yang sudah difilter dan total halamannya
    return view('admin.testimonials.index', compact('testimonials', 'totalPage'));
}



    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'message' => 'required|string',
            'image' => 'image|max:2048|nullable',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->date = $request->date;
        $testimonial->message = $request->message;

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $testimonial->image = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->save();

        return redirect()->route('testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'message' => 'required|string',
            'image' => 'image|max:2048|nullable',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->name = $request->name;
        $testimonial->date = $request->date;
        $testimonial->message = $request->message;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $testimonial->image = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->save();

        return redirect()->route('testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }

        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}

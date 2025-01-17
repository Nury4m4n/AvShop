@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Input',
                    html: `
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    `,
                    showConfirmButton: true,
                    confirmButtonText: 'Perbaiki'
                });
            });
        </script>
    @endif

    <div class="container mt-4">
        <h1 class="mb-4 text-center">Edit Testimoni</h1>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="m-0">Form Edit Testimoni</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $testimonial->name) }}" required>
                        @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ old('date', $testimonial->date) }}" required>
                        @error('date')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message" name="message" required>{{ old('message', $testimonial->message) }}</textarea>
                        @error('message')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar (kosongkan jika tidak ingin mengubah)</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end ">
                        <button type="submit" class="btn btn-primary me-1">Simpan</button>
                        <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

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

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Edit Carousel Item</h1>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="m-0">Form Edit Carousel Item</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('carousels.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if ($carousel->image)
                            <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->title }}"
                                width="100" class="mt-2">
                        @endif
                        @error('image')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1">Simpan</button>
                        <a href="{{ route('carousels.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

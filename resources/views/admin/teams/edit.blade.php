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
        <h1 class="mb-4 text-center">Edit Admin {{ $teamMember->name }}</h1>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="m-0">Form Edit Admin</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('teams.update', $teamMember->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Anggota</label>
                        <input type="text" name="name" id="name" class="form-control" required
                            placeholder="Masukkan nama anggota" value="{{ old('name', $teamMember->name) }}">
                        @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Jabatan</label>
                        <input type="text" name="position" id="position" class="form-control" required
                            placeholder="Masukkan jabatan" value="{{ old('position', $teamMember->position) }}">
                        @error('position')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" inputmode="numeric"
                            required placeholder="Masukkan nomor telepon" value="{{ old('phone', $teamMember->phone) }}">
                        @error('phone')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Foto Anggota</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @if ($teamMember->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $teamMember->image) }}" alt="Foto Anggota"
                                    class="img-thumbnail" style="max-width: 150px;">
                            </div>
                        @endif
                        @error('image')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <a href="{{ route('teams.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

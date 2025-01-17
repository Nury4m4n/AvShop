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
        <h1 class="mb-4 text-center">Tambah Paket Umrah</h1>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="m-0">Form Tambah Paket Umrah</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('umrah-packages.store') }}" method="POST" enctype="multipart/form-data"
                    onsubmit="return formatPriceBeforeSubmit();">
                    @csrf
                    <div class="mb-3">
                        <label for="main_package_name" class="form-label">Nama Paket Utama</label>
                        <input type="text" name="main_package_name" id="main_package_name" class="form-control" required
                            placeholder="Masukkan nama paket" value="{{ old('main_package_name') }}">
                        @error('main_package_name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="text" id="price" name="price" class="form-control" required
                            placeholder="Harga varian" oninput="formatCurrency(this)" maxlength="20"
                            value="{{ old('price') }}">
                        @error('price')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Brosur</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                        @error('image')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1">Simpan</button>
                        <a href="{{ route('umrah-packages.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function formatCurrency(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            if (value) {
                input.value = 'Rp ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            } else {
                input.value = '';
            }
        }

        function formatPriceBeforeSubmit() {
            const input = document.getElementById('price');
            input.value = input.value.replace('Rp ', '').replace(/\./g, '').replace(/,/g, '.');
            return true;
        }
    </script>
@endsection

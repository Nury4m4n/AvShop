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
        <h1 class="mb-4 text-center">Edit Paket {{ $package->main_package_name }}</h1>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="m-0">Form Edit Paket Umrah</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('umrah-packages.update', $package->id) }}" method="POST" enctype="multipart/form-data"
                    onsubmit="return formatPriceBeforeSubmit();">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="main_package_name" class="form-label">Nama Paket Utama</label>
                        <input type="text" name="main_package_name" id="main_package_name" class="form-control" required
                            placeholder="Masukkan nama paket"
                            value="{{ old('main_package_name', $package->main_package_name) }}">
                        @error('main_package_name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="text" id="price" name="price" class="form-control" required
                            placeholder="Harga varian" oninput="formatCurrency(this)" maxlength="20"
                            value="{{ old('price', number_format($package->price, 0, ',', '.')) }}">
                        @error('price')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Brosur</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @if ($package->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $package->image) }}" alt="Foto Anggota"
                                    class="img-thumbnail" style="max-width: 100px;">
                            </div>
                        @endif
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
                input.value = 'Rp ' + parseInt(value).toLocaleString('id-ID');
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

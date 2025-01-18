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
        <h1 class="mb-4 text-center">Edit Varian Anggrek</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Form Edit Varian Anggrek
            </div>
            <div class="card-body">
                <form action="{{ route('package-variants.update', $packageVariant->id) }}" method="POST"
                    enctype="multipart/form-data" onsubmit="return formatPriceBeforeSubmit();">
                    @csrf
                    @method('PUT')

                    <!-- Pemilihan Paket Umrah dan Varian -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="umrah_package_id" class="form-label">Pilih Anggrek</label>
                            <select name="umrah_package_id" class="form-select w-100" required>
                                <option value="" disabled selected>Pilih Anggrek</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}"
                                        {{ old('umrah_package_id', $packageVariant->umrah_package_id) == $package->id ? 'selected' : '' }}>
                                        {{ $package->main_package_name }}</option>
                                @endforeach
                            </select>
                            @error('umrah_package_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="variant" class="form-label">Nama Varian</label>
                            <input type="text" name="variant" class="form-control w-100"
                                placeholder="Masukan Nama Varian" value="{{ $packageVariant->variant }}">
                            @error('variant')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        @error('variant')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
            </div>

            <!-- Brosur dan Biaya Tambahan -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="variant_image" class="form-label">Gambar Varian</label>
                    <input type="file" name="variant_image" class="form-control w-100" accept="image/*">
                    @if ($packageVariant->variant_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $packageVariant->variant_image) }}" alt="Foto Anggota"
                                class="img-thumbnail" style="max-width: 100px;">
                        </div>
                    @endif
                    @error('variant_image')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label">Harga</label>
                    <input type="text" id="price" name="price" class="form-control" required
                        placeholder="Harga varian" oninput="formatCurrency(this)" maxlength="20"
                        value="{{ old('price', number_format($packageVariant->price, 0, ',', '.')) }}">
                    @error('price')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Kursi Tersedia dan Hotel -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="stock" class="form-label">Stok Tersedia</label>
                    <input type="number" name="stock" class="form-control w-100" required placeholder="Stok varian"
                        value="{{ old('stock', $packageVariant->stock) }}">
                    @error('stock')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="description" class="form-label">Deskripsi</label>
                <input id="description" type="hidden" name="description"
                    value="{{ old('description', $packageVariant->description) }}">
                <trix-editor input="description"></trix-editor>
                @error('description')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('package-variants.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
    </div>
    <style>
        /* Menghilangkan tombol upload gambar dari Trix Editor */
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

        .trix-button--icon-upload {
            display: none !important;
        }
    </style>
    <script>
        function formatPriceBeforeSubmit() {
            let priceInput = document.getElementById('price');
            priceInput.value = priceInput.value.replace(/[^\d]/g, '');
            return true;
        }

        function formatCurrency(input) {
            let value = input.value.replace(/[^\d]/g, '');
            let formattedValue = new Intl.NumberFormat().format(value);
            input.value = formattedValue;
        }
    </script>
@endsection

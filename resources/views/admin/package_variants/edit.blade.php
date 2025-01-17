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
        <h1 class="mb-4 text-center">Edit Varian Paket Umrah</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Form Edit Varian Paket Umrah</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('package-variants.update', $packageVariant->id) }}" method="POST"
                    enctype="multipart/form-data" onsubmit="return formatPriceBeforeSubmit();">
                    @csrf
                    @method('PUT')

                    <!-- Pemilihan Paket Umrah dan Varian -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="umrah_package_id" class="form-label">Pilih Paket Umrah</label>
                            <select name="umrah_package_id" class="form-select w-100" required>
                                <option value="" disabled selected>Pilih paket umrah</option>
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
                            <select name="variant" class="form-select w-100" required onchange="updatePrice();">
                                <option value="" disabled selected>Pilih varian paket</option>
                                <option value="Up Double"
                                    {{ old('variant', $packageVariant->variant) == 'Up Double' ? 'selected' : '' }}>Up
                                    Double
                                </option>
                                <option value="Up Triple"
                                    {{ old('variant', $packageVariant->variant) == 'Up Triple' ? 'selected' : '' }}>Up
                                    Triple
                                </option>
                                <option value="No Variant"
                                    {{ old('variant', $packageVariant->variant) == 'No Variant' ? 'selected' : '' }}>Tanpa
                                    Varian
                                </option>
                            </select>
                            @error('variant')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Brosur dan Biaya Tambahan -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="variant_image" class="form-label">Brosur</label>
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
                            <label for="stock" class="form-label">Kursi Tersedia</label>
                            <input type="number" name="stock" class="form-control w-100" required
                                placeholder="Stok varian" value="{{ old('stock', $packageVariant->stock) }}">
                            @error('stock')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="hotel_mecca" class="form-label">Hotel di Mekkah</label>
                            <input type="text" name="hotel_mecca" class="form-control w-100" required
                                placeholder="Hotel di Mekkah"
                                value="{{ old('hotel_mecca', $packageVariant->hotel_mecca) }}">
                            @error('hotel_mecca')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Hotel Madinah dan Durasi -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="hotel_madinah" class="form-label">Hotel di Madinah</label>
                            <input type="text" name="hotel_madinah" class="form-control w-100" required
                                placeholder="Hotel di Madinah"
                                value="{{ old('hotel_madinah', $packageVariant->hotel_madinah) }}">
                            @error('hotel_madinah')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="duration_days" class="form-label">Durasi (Hari)</label>
                            <input type="number" name="duration_days" class="form-control w-100" required
                                placeholder="Durasi dalam hari"
                                value="{{ old('duration_days', $packageVariant->duration_days) }}">
                            @error('duration_days')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Penerbangan dan Kereta -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="flight" class="form-label">Penerbangan (Opsional)</label>
                            <input type="text" name="flight" class="form-control w-100"
                                placeholder="Detail penerbangan" value="{{ old('flight', $packageVariant->flight) }}">
                            @error('flight')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="train" class="form-label">Kereta (Opsional)</label>
                            <input type="text" name="train" class="form-control w-100" placeholder="Detail kereta"
                                value="{{ old('train', $packageVariant->train) }}">
                            @error('train')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Tahun Hijriyah dan Tanggal Keberangkatan -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="hijri_year" class="form-label">Tahun Hijriyah</label>
                            <input type="text" name="hijri_year" class="form-control w-100" required
                                placeholder="Tahun Hijriyah"
                                value="{{ old('hijri_year', $packageVariant->hijri_year) }}">
                            @error('hijri_year')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="departure_date" class="form-label">Tanggal Keberangkatan</label>
                            <input type="date" name="departure_date" class="form-control w-100" required
                                value="{{ old('departure_date', $packageVariant->departure_date) }}">
                            @error('departure_date')
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

        function updatePrice() {
            var variant = document.querySelector('select[name="variant"]').value;
            var priceInput = document.querySelector('input[name="price"]');

            if (variant === "Up Triple") {
                priceInput.value = 1500000;
            } else if (variant === "Up Double") {
                priceInput.value = 3500000;
            } else if (variant === "No Variant") {
                priceInput.value = 0;
            }
            priceInput.disabled = false; // Aktifkan input harga
            formatCurrency(priceInput); // Format harga
        }
    </script>
@endsection

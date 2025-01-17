@extends('Home.layouts.main')

@section('content')
    <div class="container">
        <h1>Ajukan Cicilan Baru</h1>

        <form action="{{ route('savings.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="package_variant_id">Pilih Paket</label>
                <select name="package_variant_id" class="form-control" required>
                    <option value="">Pilih Paket Umrah</option>
                    @foreach ($variants as $variant)
                        <option value="{{ $variant->id }}">
                            {{ $variant->umrahPackage->main_package_name . ' ' . $variant->variant }} - Rp
                            {{ number_format(intval($variant->price) + intval($variant->umrahPackage->price ?? 0), 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="phone">No Telepon</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Ajukan Cicilan</button>
        </form>
    </div>
@endsection

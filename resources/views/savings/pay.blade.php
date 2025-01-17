@extends('Home.layouts.main')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Proses Pembayaran</h1>

        <!-- Form untuk proses pembayaran -->
        <form action="{{ route('savings.processPayment', $saving->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Input jumlah pembayaran -->
            <div class="form-group mb-3">
                <label for="amount" class="form-label">Jumlah Pembayaran</label>
                <input type="number" name="amount" class="form-control" placeholder="Masukkan jumlah pembayaran" required
                    min="1">
            </div>

            <!-- Input untuk unggah bukti pembayaran -->
            <div class="form-group mb-4">
                <label for="proof_of_payment" class="form-label">Unggah Bukti Pembayaran</label>
                <input type="file" name="proof_of_payment" class="form-control" accept="image/*" required>
            </div>

            <!-- Tombol kirim -->
            <button type="submit" class="btn btn-primary">Kirim Pembayaran</button>
        </form>
    </div>
@endsection

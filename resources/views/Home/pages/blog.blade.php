@extends('Home.layouts.main')
@section('content')
    <style>
        .development-section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 50vh;
            background-color: #f8f9fa;
        }

        .development-message {
            text-align: center;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    <section class="development-section">
        <div class="development-message">
            <h2>Sedang Dalam Pengembangan</h2>
            <p>Fitur ini sedang dalam tahap pengembangan. Harap kembali lagi nanti.</p>
        </div>
    </section>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
@endsection

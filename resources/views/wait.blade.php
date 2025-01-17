<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silakan Tunggu</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            display: none;
            /* Sembunyikan tombol di awal */
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Silakan Tunggu</h1>
        <p>Akun Anda telah terkunci. Silakan tunggu 1 menit sebelum mencoba lagi.</p>
        <p id="countdown"></p> <!-- Tempat untuk menampilkan hitungan mundur -->
        <a href="{{ url()->previous() }}" class="btn" id="backButton">Kembali</a>
    </div>

    <script>
        // Set waktu awal dalam detik
        const initialTime = 60;
        let timeLeft = localStorage.getItem('timeLeft') ? parseInt(localStorage.getItem('timeLeft')) : initialTime;

        const countdownElement = document.getElementById('countdown');
        const backButton = document.getElementById('backButton');

        const countdownTimer = setInterval(function() {
            countdownElement.textContent = timeLeft + ' detik tersisa';
            timeLeft--;

            // Simpan waktu tersisa di localStorage
            localStorage.setItem('timeLeft', timeLeft);

            if (timeLeft < 0) {
                clearInterval(countdownTimer);
                countdownElement.textContent = 'Waktu habis!'; // Tampilkan pesan waktu habis
                backButton.style.display = 'block'; // Tampilkan tombol kembali
                localStorage.removeItem('timeLeft'); // Hapus waktu tersisa setelah habis
            }
        }, 1000); // 1000 ms = 1 detik

        // Mengatur waktu tersisa saat halaman dimuat
        countdownElement.textContent = timeLeft + ' detik tersisa';
    </script>
</body>

</html>

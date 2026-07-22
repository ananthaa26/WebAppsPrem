<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mengalihkan... — ZANNSTORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h2>Memproses Pembayaran...</h2>
        <p>Anda akan dialihkan ke halaman pembayaran dalam beberapa detik.</p>
    </div>

    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Permintaan deposit berhasil dibuat. Anda akan dialihkan ke halaman pembayaran...',
            icon: 'success',
            timer: 5000,
            timerProgressBar: true,
            showConfirmButton: false,
            allowOutsideClick: false
        }).then((result) => {
            window.location.href = "{{ $checkout_url }}";
        });
        
        // Fallback jika SweetAlert bermasalah atau terblokir
        setTimeout(function() {
            window.location.href = "{{ $checkout_url }}";
        }, 5500);
    </script>
</body>
</html>

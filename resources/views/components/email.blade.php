<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Arial, sans-serif; background: #f8f9fa; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { text-align: center; margin-bottom: 24px; }
        .logo { font-size: 24px; font-weight: 800; color: #ff416c; letter-spacing: -1px; }
        .title { font-size: 18px; font-weight: 700; margin-bottom: 10px; }
        .content { font-size: 15px; line-height: 1.6; color: #555; }
        .btn { display: inline-block; padding: 12px 24px; background: linear-gradient(135deg, #ff416c, #ff4b2b); color: #fff !important; text-decoration: none; border-radius: 8px; font-weight: 700; margin-top: 20px; }
        .footer { margin-top: 30px; font-size: 12px; color: #999; text-align: center; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">ZANNSTORE</div>
        </div>
        <div class="title">Verifikasi Email Anda</div>
        <div class="content">
            Halo {{ $name }},<br><br>
            Terima kasih telah mendaftar di ZANNSTORE. Untuk mengaktifkan akun Anda dan menikmati seluruh fitur, silakan verifikasi alamat email Anda dengan mengklik tombol di bawah ini:
            <div style="text-align: center;">
                <a href="{{ $verify_url }}" class="btn">Verifikasi Email</a>
            </div>
            <br>
            Jika Anda tidak merasa mendaftar di ZANNSTORE, abaikan saja email ini.<br><br>
            Terima kasih,<br>
            Tim ZANNSTORE
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} ZANNSTORE. All Rights Reserved.
        </div>
    </div>
</body>
</html>

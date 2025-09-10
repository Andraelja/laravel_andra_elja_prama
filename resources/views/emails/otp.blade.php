<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kode Verifikasi Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .greeting {
            margin-bottom: 20px;
            font-size: 16px;
            color: #333333;
        }

        .message {
            font-size: 16px;
            color: #333333;
            margin-bottom: 30px;
        }

        .otp-box {
            background-color: #4CAF50;
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 15px 0;
            width: 180px;
            margin: 0 auto 30px auto;
            border-radius: 4px;
            letter-spacing: 8px;
            user-select: all;
        }

        .footer {
            text-align: center;
            color: #999999;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="email-container bg-dark">
        <p class="greeting">Hi {{ $userName }}</p>
        <p class="message">
            Anda Telah Terdeteksi Melakukan Login.<br><br>
            Berikut Kode Verikasi Login Anda :
        </p>
        <div class="otp-box">{{ $otp }}</div>
        <p class="footer">Ria Dental Care</p>
    </div>
</body>

</html>

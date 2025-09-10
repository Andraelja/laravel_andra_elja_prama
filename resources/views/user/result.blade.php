<!DOCTYPE html>
<html>
<head>
<title>Registrasi Sukses</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
    margin: 0;
    padding: 0;
    background: #000;
    font-family: sans-serif;
}
* {
    box-sizing: border-box;
}
.container {
    background-image: url(https://demo.wpbeaveraddons.com/wp-content/uploads/2018/02/main-1.jpg);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    width: 100%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #000;
}
.container img {
    width: auto;
    max-width: 100%;
}
.title {
    font-weight: 700;
    font-size: 40px;
    margin-top: 10px;
    margin-bottom: 10px;
}
.description {
    font-weight: 400;
    font-size: 18px;
    margin-top: 0;
    margin-bottom: 20px;
}
.button {
    display: inline-block;
    padding: 12px 25px;
    font-size: 18px;
    font-weight: 600;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 15px;
}
.download-btn {
    background-color: #4CAF50;
    color: white;
}
.download-btn:hover {
    background-color: #45a049;
}
.home-btn {
    background-color: #007BFF;
    color: white;
}
.home-btn:hover {
    background-color: #0056b3;
}
</style>
</head>
<body>

<div class="container">
    <img src="https://demo.wpbeaveraddons.com/wp-content/uploads/2018/02/main-vector.png" alt="Success">
    <h3 class="title">Registrasi Sukses!</h3>
    <p class="description">Selamat! Registrasi Anda telah berhasil. Silahkan unduh kartu peserta Anda dengan menekan tombol di bawah ini.</p>
    <a href="/qr_code/{{$peserta->id}}/{{$event->id}}" class="button download-btn" target="_blank">
        <i class="fa fa-download"></i> Download Kartu Peserta
    </a>
    <a href="/" class="button home-btn">
        <i class="fa fa-home"></i> Kembali ke Beranda
    </a>
</div>

</body>
</html>
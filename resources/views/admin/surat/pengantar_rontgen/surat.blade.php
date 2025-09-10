<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Surat Pengantar Rontgen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 800px;
            margin: auto;
        }

        .header-table {
            width: 100%;
            text-align: center;
        }

        .header-table img {
            width: 80px;
        }

        .clinic-info {
            font-size: 12px;
            text-align: center;
            margin-top: -10px;
        }

        hr {
            border: 1px solid black;
            margin-top: 5px;
        }

        .section-title {
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }

        .content-table {
            margin-top: 20px;
            width: 100%;
            font-size: 14px;
        }

        .content-table td {
            padding: 5px;
            vertical-align: top;
        }

        .content-table .label {
            width: 150px;
            text-align: left;
        }

        .content-table .colon {
            width: 20px;
            text-align: center;
        }

        .footer-right {
            margin-top: 50px;
            text-align: right;
            font-size: 14px;
        }

        .signature {
            margin-top: 80px;
            text-align: right;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <table class="header-table">
        <tr>
            <td>
                <div style="margin-right: 100px"><strong style="font-size: 30px">Praktek Dokter Gigi Betri Sari</strong></div>
                <div style="margin-right: 100px">
                    <p>Jalan raya lintas Lintau - Setangkai </p>
                </div>
                <div class="clinic-info" style="margin-right: 100px;">
                    Taluak, Kec. Lintau Buo, Kabupaten Tanah Datar, Sumatera Barat 27292
                    Telp: 0852-6353-8897
                </div>
            </td>
        </tr>
    </table>
    <hr />
    <div class="section-title">SURAT PENGANTAR RONTGEN</div>

    <!-- Yang saya hormati -->
    <div style="text-align: right; font-size: 14px; margin-top: 10px; margin-right: 70px">
        Yang saya hormati,<br>
        <p>{{ $pengantar_rontgen->tempat }}</p>
        <p>Di tempat</p>
        ______________________
    </div>
    <table class="content-table">
        <tr>
            <td class="label">Nomor</td>
            <td class="colon">:</td>
            <td>{{ $pengantar_rontgen->nomor ?? '....................................................' }}</td>
        </tr>
        <tr>
            <td colspan="3"><br />Mohon dilakukan rontgen kepada pasien kami : </td>
        </tr>
        <tr>
            <td class="label">Nama</td>
            <td class="colon">:</td>
            <td>{{ $pasien->nama ?? '....................................................' }}</td>
        </tr>
        <tr>
            <td class="label">Umur</td>
            <td class="colon">:</td>
            <td>{{ $pengantar_rontgen->umur ?? '...' }} Tahun</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="colon">:</td>
            <td>{{ $pengantar_rontgen->alamat ?? '....................................................' }}</td>
        </tr>
        <tr>
            <td class="label">Diagnosa</td>
            <td class="colon">:</td>
            <td>{{ $pengantar_rontgen->diagnosa ?? '....................................................' }}</td>
        </tr>
    </table>

    <!-- Form Data Diri -->

    <table class="content-table">
        <tr>
            <td colspan="3">
                <br />
                Demikian Surat ini dibuat, Mohon bantuan dan kerjasamanya. Terima kasih atas bantuan Teman Sejawat.
            </td>
        </tr>
    </table>

    <!-- Footer dan tanda tangan -->
    <div class="footer-right" style="text-align: right; font-size: 14px; margin-top: 50px; margin-right: 150px">
        Lintau Buo, {{ \Carbon\Carbon::parse($pengantar_rontgen->tgl)->format('d M Y') }}
    </div>

    <div class="signature" style="text-align: right; font-size: 14px; margin-top: 10px; margin-right: 150px">
        Hormat saya,<br>
        <strong>Dokter Gigi</strong><br>
        <br><br><br>
        <u>{{ $dokter->nama }}</u>
    </div>
</body>

</html>

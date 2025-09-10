<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Surat Keterangan Sakit</title>
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
            margin-top: 20px;
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

        .footer-table {
            text-align: center;
            margin-top: 30px;
            width: 100%;
            font-size: 14px;
        }

        .justified {
            text-align: justify;
        }

        .footer-table td {
            vertical-align: top;
            padding-top: 40px;
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

    <!-- Judul -->
    <div class="section-title" style="margin-right: 100px">SURAT KETERANGAN SAKIT <br> (MEDICAL CERTIFICATE)</div>

    <!-- Form Data Diri -->
    <table class="content-table">
        <tr>
            <td colspan="3">Yang bertanda tangan di bawah ini menerangkan bahwa : </td>
        </tr>
        <tr>
            <td class="label">Nama</td>
            <td class="colon">:</td>
            <td>{{ $pasien->nama ?? '....................................................' }}</td>
        </tr>
        <tr>
            <td class="label">Umur</td>
            <td class="colon">:</td>
            <td>{{ $surat_sakit->umur ?? '....................................................' }} Tahun</td>
        </tr>
        <tr>
            <td class="label">Pekerjaan</td>
            <td class="colon">:</td>
            <td>{{ $surat_sakit->pekerjaan ?? '....................................................' }}</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="colon">:</td>
            <td>{{ $surat_sakit->alamat ?? '....................................................' }}</td>
        </tr>
    </table>

    <table class="content-table">
        <tr>
            <td colspan="3" class="justified">
                <br />
                Pada saat ini orang tersebut diatas dalam keadaan <b>SAKIT</b><br />
                dengan diagnosa {{ $surat_sakit->diagnosa }} dan
                perlu beristirahat selama {{ $surat_sakit->waktu_istirahat }} hari, mulai <br>tanggal
                {{ \Carbon\Carbon::parse($surat_sakit->waktu_mulai)->format('d M Y') }}
                s/d{{ \Carbon\Carbon::parse($surat_sakit->waktu_berakhir)->format('d M Y') }}<br><br>
                Demikian Surat ini dibuat dengan sebenar-benarnya agar dapat
                dipergunakan sebagaimana mestinya.
            </td>
        </tr>
    </table>

    <!-- Footer dan tanda tangan -->
    <div class="footer-right" style="text-align: right; font-size: 14px; margin-top: 50px; margin-right: 150px">
        Lintau Buo, {{ \Carbon\Carbon::parse($surat_sakit->tgl)->format('d M Y') }}
    </div>

    <div class="signature" style="text-align: right; font-size: 14px; margin-top: 10px; margin-right: 150px">
        Hormat saya,<br>
        <strong>Dokter Gigi</strong><br>
        <br><br><br>
        <u>{{ $dokter->nama }}</u>
    </div>
</body>

</html>

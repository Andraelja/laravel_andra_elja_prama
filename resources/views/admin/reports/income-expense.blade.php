<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pemasukan & Pengeluaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 24px;
            color: #0056b3;
            margin-bottom: 5px;
        }

        .header h3 {
            font-size: 16px;
            color: #666;
            margin-top: 0;
        }

        .summary-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            flex: 1;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .summary-card h4 {
            margin: 0 0 10px;
            font-size: 14px;
            opacity: 0.8;
        }

        .summary-card h3 {
            margin: 0;
            font-size: 20px;
        }

        .income-card {
            background-color: #28a745;
        }

        .expense-card {
            background-color: #dc3545;
            margin-top: 10px;
        }

        .balance-card {
            background-color: #007bff;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 11px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #555;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .section-title {
            margin-top: 30px;
            margin-bottom: 15px;
            color: #0056b3;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 5px;
            font-size: 16px;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .footer p {
            margin: 2px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN KEUANGAN BETRI SARI</h1>
        <h3>Periode: {{ $monthName }}</h3>
    </div>

    <div class="summary-container">
        <div class="summary-card income-card">
            <h4>Total Pemasukan</h4>
            <h3>Rp {{ number_format($pemasukan, 0, ',', '.') }}</h3>
        </div>
        <div class="summary-card expense-card">
            <h4>Total Pengeluaran</h4>
            <h3>Rp {{ number_format($pengeluaran, 0, ',', '.') }}</h3>
        </div>
        <div class="summary-card balance-card">
            <h4>Saldo Akhir</h4>
            <h3>Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
        </div>
    </div>

    <h3 class="section-title">Detail Pemasukan</h3>
    <table>
        <thead>
            <tr>
                <th width="15%">Tanggal</th>
                <th width="25%">Nama Pasien</th>
                <th width="20%" class="text-right">Jumlah</th>
                <th width="20%">Metode Pembayaran</th>
                <th width="20%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail_pemasukan as $data)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $data->nama_pasien ?? 'N/A' }}</td>
                    <td class="text-right">Rp {{ number_format($data->jumlah, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($data->metode_pembayaran ?? '-') }}</td>
                    <td>{{ $data->status ?? '-' }}</td>
                </tr>
            @endforeach
            @if (count($detail_pemasukan) == 0)
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data pemasukan</td>
                </tr>
            @endif
        </tbody>
    </table>

    <h3 class="section-title">Detail Pengeluaran</h3>
    <table>
        <thead>
            <tr>
                <th width="15%">Tanggal</th>
                <th width="20%">Kategori</th>
                <th width="35%">Deskripsi</th>
                <th width="20%" class="text-right">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail_pengeluaran as $data)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($data->tgl)->format('d/m/Y') }}</td>
                    <td>{{ $data->kategori ?? 'N/A' }}</td>
                    <td>{{ $data->deskripsi ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            @if (count($detail_pengeluaran) == 0)
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data pengeluaran</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Dicetak pada:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
        <p><strong>Oleh:</strong> {{ auth()->user()->name ?? 'Admin' }}</p>
    </div>
</body>

</html>

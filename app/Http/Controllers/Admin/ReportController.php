<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function incomeExpenseReport(Request $request)
    {
        $month = $request->get('month', date('Y-m'));

        $pemasukan = DB::table('pembayaran')
            ->where('status', 'Selesai')
            ->whereMonth('created_at', date('m', strtotime($month)))
            ->whereYear('created_at', date('Y', strtotime($month)))
            ->sum('total');

        $pengeluaran = DB::table('pengeluaran')
            ->whereMonth('tgl', date('m', strtotime($month)))
            ->whereYear('tgl', date('Y', strtotime($month)))
            ->sum('harga');

        $detail_pemasukan = DB::table('pembayaran')
            ->join('antrian', 'pembayaran.id_antrian', '=', 'antrian.id')
            ->join('pasien', 'pembayaran.id_pasien', '=', 'pasien.id')
            ->join('metode_pembayaran', 'pembayaran.id_metode', '=', 'metode_pembayaran.id')
            ->select(
                'pembayaran.*',
                'pasien.nama as nama_pasien',
                'pembayaran.created_at as tanggal',
                'pembayaran.total as jumlah',
                'metode_pembayaran.nama as metode_pembayaran'
            )
            ->where('pembayaran.status', 'Selesai')
            ->whereMonth('pembayaran.created_at', date('m', strtotime($month)))
            ->whereYear('pembayaran.created_at', date('Y', strtotime($month)))
            ->orderBy('pembayaran.created_at', 'desc')
            ->get();

        $detail_pengeluaran = DB::table('pengeluaran')
            ->join('kategori_pengeluaran', 'pengeluaran.id_kategori', '=', 'kategori_pengeluaran.id')
            ->select(
                'pengeluaran.*',
                'kategori_pengeluaran.*'
            )
            ->whereMonth('pengeluaran.tgl', date('m', strtotime($month)))
            ->whereYear('pengeluaran.tgl', date('Y', strtotime($month)))
            ->orderBy('pengeluaran.tgl', 'desc')
            ->get();

        $saldo = $pemasukan - $pengeluaran;

        $data = [
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'saldo' => $saldo,
            'detail_pemasukan' => $detail_pemasukan,
            'detail_pengeluaran' => $detail_pengeluaran,
            'month' => $month,
            'monthName' => Carbon::createFromFormat('Y-m', $month)->format('F Y')
        ];

        $pdf = Pdf::loadView('admin.reports.income-expense', $data);
        return $pdf->stream('laporan-pemasukan-pengeluaran-' . $month . '.pdf');
    }
}

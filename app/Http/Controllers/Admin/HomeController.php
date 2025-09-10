<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DatePeriod;
use DateInterval;
use DateTime;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $pemasukan = DB::table('pembayaran')
            ->join('antrian', 'pembayaran.id_antrian', '=', 'antrian.id')
            ->sum('pembayaran.total');

        $pengeluaran = DB::table('pengeluaran')->sum('pengeluaran.harga');

        $tanggalFilter = $request->query('tanggal', null);

        $tanggalMulai = Carbon::now()->startOfMonth();
        $tanggalAkhir = Carbon::now();

        // Buat label tanggal
        $tanggalLabels = [];
        $currentDate = $tanggalMulai->copy();
        while ($currentDate <= $tanggalAkhir) {
            $tanggalLabels[] = $currentDate->format('l, d-m-Y');
            $currentDate->addDay();
        }

        $datasets = [];

        $listAdmin = DB::table('antrian')
            ->distinct()
            ->get();

        $colors = ['#3e95cd', '#8e5ea2', '#3cba9f', '#e8c3b9', '#c45850', '#ffa600', '#00bcd4', '#4caf50'];

        $colorIndex = 0;
        foreach ($listAdmin as $admin) {
            $dataAntrian = DB::table('antrian')
                ->select('tgl as tanggal', DB::raw('COUNT(*) as total'))
                ->groupBy('tgl')
                ->orderBy('tgl', 'ASC')
                ->get();

            // Buat dataset per tanggal
            $datasetData = [];
            $currentDate = $tanggalMulai->copy();
            while ($currentDate <= $tanggalAkhir) {
                $tanggal = $currentDate->format('l, d-m-Y');
                $found = $dataAntrian->firstWhere('tanggal', $tanggal);

                // Filter by tanggal if set
                if ($tanggalFilter !== null) {
                    $filterDate = Carbon::createFromFormat('Y-m-d', $tanggalFilter)->format('l, d-m-Y');
                    if ($tanggal !== $filterDate) {
                        $datasetData[] = 0;
                        $currentDate->addDay();
                        continue;
                    }
                }

                $datasetData[] = $found ? (int) $found->total : 0;
                $currentDate->addDay();
            }

            $datasets[] = [
                'data' => $datasetData,
                'borderColor' => $colors[$colorIndex % count($colors)],
                'fill' => false
            ];

            $colorIndex++;
        }
        return view('admin.dashboard.index', [
            'labels' => $tanggalLabels,
            'datasets' => $datasets,
            'tanggalFilter' => $tanggalFilter,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
        ]);
    }

    public function change()
    {
        return view('admin/dashboard/change');
    }

    public function change_password(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Kata sandi Anda saat ini tidak cocok dengan kata sandi yang Anda berikan. Silakan coba lagi.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "Kata Sandi Baru tidak boleh sama dengan kata sandi Anda saat ini. Silakan pilih kata sandi lain.");
        }

        DB::table('users')
            ->where('id', Auth::User()->id)
            ->update([
                'password' => bcrypt($request->get('new-password'))
            ]);

        return redirect('/admin/change')->with("success", "Ganti Password Berhasil !");
    }

    public function keluar()
    {
        Auth::logout();

        // Redirect user ke halaman login atau halaman lainnya
        return redirect()->route('login')->with("error", "Akun Anda Belum Diaktifkan !");
    }
}

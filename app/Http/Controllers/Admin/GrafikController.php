<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GrafikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read(Request $request)
    {
        $user = Auth::user();
        $level = $user->level;

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

        if ($level == 1) {
            $listAdmin = DB::table('antrian')
                ->join('admin', 'antrian.id_admin', '=', 'admin.id_admin')
                ->select('antrian.id_admin', 'admin.nama')
                ->distinct()
                ->get();

            $colors = ['#3e95cd', '#8e5ea2', '#3cba9f', '#e8c3b9', '#c45850', '#ffa600', '#00bcd4', '#4caf50'];

            $colorIndex = 0;
            foreach ($listAdmin as $admin) {
                $dataAntrian = DB::table('antrian')
                    ->select('tgl as tanggal', DB::raw('COUNT(*) as total'))
                    ->where('id_admin', $admin->id_admin)
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
                    'label' => $admin->nama,
                    'data' => $datasetData,
                    'borderColor' => $colors[$colorIndex % count($colors)],
                    'fill' => false
                ];

                $colorIndex++;
            }
        } else {
            $adminId = $user->id;

            $dataAntrian = DB::table('antrian')
                ->select('tgl as tanggal', DB::raw('COUNT(*) as total'))
                ->where('id_admin', $adminId)
                ->whereBetween('tgl', [$tanggalMulai->format('l, d-m-Y'), $tanggalAkhir->format('l, d-m-Y')])
                ->groupBy('tgl')
                ->orderBy('tgl', 'ASC')
                ->get();

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
                'label' => 'Cabang ' . $adminId,
                'data' => $datasetData,
                'borderColor' => '#3e95cd',
                'fill' => false
            ];
        }

        return view('admin.grafik.index', [
            'labels' => $tanggalLabels,
            'datasets' => $datasets,
            'tanggalFilter' => $tanggalFilter
        ]);
    }
}

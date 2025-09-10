<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        date_default_timezone_set('Asia/Jakarta');

        $tgl = date('l, d-m-Y');

        $antrian = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->select('antrian.*', 'pasien.nama as nama_pasien', 'dokter.nama as nama_dokter')
            // ->where('antrian.tgl', $tgl)
            ->orderBy('antrian.id', 'DESC')
            ->get();
        $jumlah_antri = DB::table('antrian')->where('status', 'Antri')->count();
        $jumlah_tunggu = DB::table('antrian')->where('status', 'Menunggu')->count();
        $jumlah_proses = DB::table('antrian')->where('status', 'Proses')->count();
        $jumlah_belum_bayar = DB::table('antrian')->where('status', 'Belum Bayar')->count();
        $jumlah_selesai = DB::table('antrian')->where('status', 'Selesai')->count();

        $data_antri = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->where('antrian.status', 'Antri')
            ->where('antrian.tgl', $tgl)
            ->orderBy('antrian.id', 'DESC')
            ->get();

        $data_tunggu = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->where('antrian.status', 'Menunggu')
            ->where('antrian.tgl', $tgl)
            ->orderBy('antrian.id', 'DESC')
            ->get();

        $data_proses = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->where('antrian.status', 'Proses')
            ->where('antrian.tgl', $tgl)
            ->orderBy('antrian.id', 'DESC')
            ->get();

        $data_belum_bayar = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->where('antrian.status', 'Belum Bayar')
            ->where('antrian.tgl', $tgl)
            ->orderBy('antrian.id', 'DESC')
            ->get();

        $data_selesai = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->where('antrian.status', 'Selesai')
            ->where('antrian.tgl', $tgl)
            ->orderBy('antrian.id', 'DESC')
            ->get();

        $jumlahAntri = $data_antri->count();
        $jumlahTunggu = $data_tunggu->count();
        $jumlahProses = $data_proses->count();
        $jumlahBelumBayar = $data_belum_bayar->count();
        $jumlahSelesai = $data_selesai->count();

        $totalReservasi = $jumlahTunggu + $jumlahProses + $jumlahSelesai;
        $totalMasuk = $jumlahBelumBayar + $jumlahSelesai;

        $persenAntriDariReservasi = $totalReservasi > 0 ? round($jumlahAntri / $totalReservasi * 100, 2) : 0;
        $persenTungguDariReservasi = $totalReservasi > 0 ? round($jumlahTunggu / $totalReservasi * 100, 2) : 0;
        $persenProsesDariTunggu = $jumlahTunggu > 0 ? round($jumlahProses / $jumlahTunggu * 100, 2) : 0;
        $persenBelumBayarDariMasuk = $totalMasuk > 0 ? round($jumlahBelumBayar / $totalMasuk * 100, 2) : 0;
        $persenSelesaiDariReservasi = $totalReservasi > 0 ? round($jumlahSelesai / $totalReservasi * 100, 2) : 0;

        // dd($antrian);
        return view('admin.antrian.index', [
            'antrian' => $antrian,
            'tgl' => $tgl,
            'jumlah_antri' => $jumlah_antri,
            'jumlah_tunggu' => $jumlah_tunggu,
            'jumlah_proses' => $jumlah_proses,
            'jumlah_belum_bayar' => $jumlah_belum_bayar,
            'jumlah_selesai' => $jumlah_selesai,
            'persenAntriDariReservasi' => $persenAntriDariReservasi,
            'persenTungguDariReservasi' => $persenTungguDariReservasi,
            'persenProsesDariTunggu' => $persenProsesDariTunggu,
            'persenBelumBayarDariMasuk' => $persenBelumBayarDariMasuk,
            'persenSelesaiDariReservasi' => $persenSelesaiDariReservasi,
        ]);
    }

    public function read_filter($tgl)
    {
        date_default_timezone_set('Asia/Jakarta');

        // Validasi format tanggal
        try {
            $date = Carbon::createFromFormat('Y-m-d', $tgl);
            $formattedDate = $date->format('l, d-m-Y');
        } catch (\Exception $e) {
            $formattedDate = $tgl;
        }

        // Query untuk mendapatkan data antrian berdasarkan tanggal
        $antrian = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->select('antrian.*', 'pasien.nama as nama_pasien', 'dokter.nama as nama_dokter')
            ->where('antrian.tgl', $formattedDate)
            ->orderBy('antrian.created_at', 'asc')
            ->get();

        // Hitung jumlah berdasarkan status
        $jumlah_antri = DB::table('antrian')
            ->where('tgl', $formattedDate)
            ->where('status', 'Antri')
            ->count();

        $jumlah_tunggu = DB::table('antrian')
            ->where('tgl', $formattedDate)
            ->where('status', 'Menunggu')
            ->count();

        $jumlah_proses = DB::table('antrian')
            ->where('tgl', $formattedDate)
            ->where('status', 'Proses')
            ->count();

        $jumlah_belum_bayar = DB::table('antrian')
            ->where('tgl', $formattedDate)
            ->where('status', 'Belum Bayar')
            ->count();

        $jumlah_selesai = DB::table('antrian')
            ->where('tgl', $formattedDate)
            ->where('status', 'Selesai')
            ->count();

        // Pisahkan data berdasarkan status
        $data_antri = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->where('antrian.status', 'Antri')
            ->where('antrian.tgl', $formattedDate)
            ->orderBy('antrian.id', 'DESC')
            ->get();

        $data_tunggu = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->where('antrian.status', 'Menunggu')
            ->where('antrian.tgl', $formattedDate)
            ->orderBy('antrian.id', 'DESC')
            ->get();

        $data_proses = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->where('antrian.status', 'Proses')
            ->where('antrian.tgl', $formattedDate)
            ->orderBy('antrian.id', 'DESC')
            ->get();

        $data_belum_bayar = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->where('antrian.status', 'Belum Bayar')
            ->where('antrian.tgl', $formattedDate)
            ->orderBy('antrian.id', 'DESC')
            ->get();

        $data_selesai = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->where('antrian.status', 'Selesai')
            ->where('antrian.tgl', $formattedDate)
            ->orderBy('antrian.id', 'DESC')
            ->get();

        // Hitung persentase
        $totalReservasi = $jumlah_tunggu + $jumlah_proses + $jumlah_selesai;
        $totalMasuk = $jumlah_belum_bayar + $jumlah_selesai;

        $persenAntriDariReservasi = $totalReservasi > 0 ? round($jumlah_antri / $totalReservasi * 100, 2) : 0;
        $persenTungguDariReservasi = $totalReservasi > 0 ? round($jumlah_tunggu / $totalReservasi * 100, 2) : 0;
        $persenProsesDariTunggu = $jumlah_tunggu > 0 ? round($jumlah_proses / $jumlah_tunggu * 100, 2) : 0;
        $persenBelumBayarDariMasuk = $totalMasuk > 0 ? round($jumlah_belum_bayar / $totalMasuk * 100, 2) : 0;
        $persenSelesaiDariReservasi = $totalReservasi > 0 ? round($jumlah_selesai / $totalReservasi * 100, 2) : 0;

        return view('admin.antrian.index', [
            'antrian' => $antrian,
            'tgl' => $formattedDate,
            'jumlah_antri' => $jumlah_antri,
            'jumlah_tunggu' => $jumlah_tunggu,
            'jumlah_proses' => $jumlah_proses,
            'jumlah_belum_bayar' => $jumlah_belum_bayar,
            'jumlah_selesai' => $jumlah_selesai,
            'persenAntriDariReservasi' => $persenAntriDariReservasi,
            'persenTungguDariReservasi' => $persenTungguDariReservasi,
            'persenProsesDariTunggu' => $persenProsesDariTunggu,
            'persenBelumBayarDariMasuk' => $persenBelumBayarDariMasuk,
            'persenSelesaiDariReservasi' => $persenSelesaiDariReservasi,
            'data_antri' => $data_antri,
            'data_tunggu' => $data_tunggu,
            'data_proses' => $data_proses,
            'data_belum_bayar' => $data_belum_bayar,
            'data_selesai' => $data_selesai,
        ]);
    }

    public function add()
    {
        $antrian = DB::table('antrian')->orderBy('id', 'DESC')->first();
        $pasien = DB::table('pasien')->orderBy('id', 'DESC')->get();
        return view('admin.antrian.tambah', [
            'antrian' => $antrian,
            'pasien' => $pasien,
        ]);
    }

    public function cek(Request $request)
    {
        $user = Auth::user();
        $id_pasien = $request->id_pasien;
        $pasien = DB::table('pasien')->where('id', $id_pasien)->first();
        $antrian = DB::table('antrian')
            ->where('antrian.id_pasien', $id_pasien)
            ->select(
                'antrian.*',
            );

        $dokter_login = DB::table('dokter')
            ->where('id_user', $user->id)
            ->first();
        $antrian = $antrian->limit(100)->get();

        $dokter = DB::table('dokter')->orderBy('id', 'DESC')->get();
        $tanggal = Carbon::now()->format('Y-m-d');
        $jam = Carbon::now('Asia/Jakarta')->format('H:i');

        return view('admin.antrian.cek', [
            'antrian' => $antrian,
            'dokter' => $dokter,
            'pasien' => $pasien,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'dokter_login' => $dokter_login,
        ]);
    }

    public function create(Request $request)
    {
        $formattedDate = date('l, d-m-Y', strtotime($request->tgl));

        DB::table('antrian')->insert([
            'id_pasien' => $request->id_pasien,
            'tgl' => $formattedDate,
            'waktu_kedatangan' => $request->waktu_kedatangan,
            'id_dokter' => $request->id_dokter,
            'status' => 'Antri',
            'keluhan' => $request->keluhan,
        ]);

        return redirect('/admin/antrian')->with("success", "Data Berhasil Ditambahkan!");
    }

    public function detail($id_pasien)
    {
        $pasien = DB::table('pasien')
            ->where('id_pasien', $id_pasien)
            ->first();

        $rekap_medis = DB::table('rekap_medis')
            ->join('dokter', 'rekap_medis.id_dokter', '=', 'dokter.id')
            ->join('price', 'rekap_medis.id_price', '=', 'price.id')
            ->where('rekap_medis.id_pasien', $id_pasien)
            ->select(
                'rekap_medis.*',
                'dokter.nama as nama_dokter',
                'price.detail as therapy'
            )
            ->orderBy('rekap_medis.tgl', 'asc')
            ->get();

        return view('admin.antrian.detail', [
            'rekap_medis' => $rekap_medis,
            'pasien' => $pasien,
        ]);
    }

    public function antri()
    {
        $user = Auth::user();
        $antrian_query = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->select(
                'antrian.*',
                'pasien.nama as nama_pasien',
                'dokter.nama as nama_dokter',
            )
            ->where('antrian.status', 'Antri')
            ->orderBy('id', 'DESC');

        if ($user->level == 2) {
            $antrian_query->where('id_user', $user->id);
        }

        $antrian = $antrian_query->get();
        return view('admin.antrian.antri', [
            'antrian' => $antrian
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();

        $antrian = DB::table('antrian')->where('id', $id)->first();
        $statusBaru = $antrian->status;

        if (in_array($user->level, [1, 2, 3])) {
            if ($antrian->status == 'Antri') {
                $statusBaru = 'Menunggu';
            } elseif ($antrian->status == 'Menunggu') {
                if ($user->level == 2 || $user->level == 1) {
                    $id_pasien = $antrian->id_pasien;
                    return redirect()->route('admin.antrian.rekamMedisIndex', ['id_pasien' => $id_pasien]);
                } else {
                    $statusBaru = 'Proses';
                }
            } elseif ($antrian->status == 'Proses') {
                $statusBaru = 'Belum Bayar';
            } elseif ($antrian->status == 'Belum Bayar') {
                $statusBaru = 'Selesai';
            }
        }

        if ($statusBaru !== $antrian->status) {
            DB::table('antrian')->where('id', $id)->update([
                'status' => $statusBaru,
                'id_metode' => $request->id_metode,
            ]);
        }

        return redirect()->route('admin.antrian.read')->with('success', 'Status antrian diperbarui menjadi ' . $statusBaru);
    }

    public function tunggu()
    {
        $user = Auth::user();
        $antrian_query = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->select(
                'antrian.*',
                'pasien.nama as nama_pasien',
                'dokter.nama as nama_dokter',
            )
            ->where('antrian.status', 'Menunggu')
            ->orderBy('id', 'DESC');

        if ($user->level == 2) {
            $antrian_query->where('id_user', $user->id);
        }

        $antrian = $antrian_query->get();
        return view('admin.antrian.antri', [
            'antrian' => $antrian
        ]);
    }

    public function selesai(Request $request)
    {
        $antrian = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->join('metode_pembayaran', 'antrian.id_metode', '=', 'metode_pembayaran.id')
            ->where('antrian.status', 'Selesai');

        $antrian = $antrian
            ->select(
                'antrian.id',
                'antrian.keluhan',
                'antrian.keterangan',
                'antrian.tgl',
                'antrian.waktu_kedatangan',
                'antrian.status',
                'antrian.id_metode',
                'pasien.nama as nama_pasien',
                'dokter.nama as nama_dokter',
                'metode_pembayaran.nama as metode_pembayaran'
            )
            ->orderBy('antrian.id', 'DESC')
            ->get();

        return view('admin.antrian.selesai', [
            'antrian' => $antrian,
        ]);
    }

    public function belum_bayar(Request $request)
    {
        $antrian = DB::table('antrian')
            ->join('pasien', 'antrian.id_pasien', '=', 'pasien.id')
            ->join('dokter', 'antrian.id_dokter', '=', 'dokter.id')
            ->leftJoin('rekap_medis', 'antrian.id_pasien', '=', 'rekap_medis.id_pasien')
            ->leftJoin('price', 'rekap_medis.id_price', '=', 'price.id')
            ->where('antrian.status', 'Belum Bayar');

        $metode_pembayaran = DB::table('metode_pembayaran')->orderBy('id', 'DESC')->get();

        $antrian = $antrian
            ->select(
                'antrian.id',
                'antrian.id_pasien',
                'antrian.keluhan',
                'antrian.keterangan',
                'antrian.tgl',
                'antrian.waktu_kedatangan',
                'antrian.status',
                'pasien.nama as nama_pasien',
                'dokter.nama as nama_dokter',
                DB::raw('SUM(price.harga) as total_bayar')
            )
            ->groupBy(
                'antrian.id',
                'antrian.keluhan',
                'antrian.keterangan',
                'antrian.tgl',
                'antrian.waktu_kedatangan',
                'antrian.status',
                'pasien.nama',
                'dokter.nama'
            )
            ->orderBy('antrian.id', 'DESC')
            ->get();

        return view('admin.antrian.belum_bayar', [
            'antrian' => $antrian,
            'metode_pembayaran' => $metode_pembayaran,
        ]);
    }

    public function rekamMedisIndex($id_pasien)
    {
        $user = Auth::user();
        $dokter = DB::table('dokter')->orderBy('id', 'DESC')->get();
        $dokter_login = DB::table('dokter')
            ->where('id_user', $user->id)
            ->select('id', 'nama')
            ->first();
        $price = DB::table('price')
            ->join('jenis', 'price.id_jenis', '=', 'jenis.id')
            ->select('price.*', 'jenis.jenis as nama_jenis')
            ->orderBy('id', 'DESC')->get();
        $pasien = DB::table('pasien')->where('id', $id_pasien)->first();
        $pilih_dokter = DB::table('rekap_medis')->orderBy('id', 'DESC')->first();

        $antrian = DB::table('antrian')
            ->where('id_pasien', $id_pasien)
            ->where('status', 'Proses')
            ->orderBy('id', 'desc')
            ->first();

        $total_bayar = 0;
        $rekap_medis = collect();

        if ($antrian) {
            $total_bayar = DB::table('rekap_medis')
                ->join('price', 'rekap_medis.id_price', '=', 'price.id')
                ->where('rekap_medis.id_pasien', $id_pasien)
                ->where('rekap_medis.id_antrian', $antrian->id)
                ->sum('price.harga');

            $rekap_medis = DB::table('rekap_medis')
                ->join('dokter', 'rekap_medis.id_dokter', '=', 'dokter.id')
                ->join('price', 'rekap_medis.id_price', '=', 'price.id')
                ->where('rekap_medis.id_antrian', $antrian->id)
                ->select(
                    'rekap_medis.id',
                    'rekap_medis.tgl',
                    'rekap_medis.anamnesia',
                    'rekap_medis.diagnosa',
                    'dokter.nama as nama_dokter',
                    'price.detail as jenis_therapy',
                    'price.harga'
                )
                ->orderBy('rekap_medis.tgl', 'desc')
                ->get();
        }

        return view('admin.antrian.rekam_medis', compact(
            'id_pasien',
            'dokter_login',
            'total_bayar',
            'rekap_medis',
            'dokter',
            'price',
            'antrian',
            'pasien',
            'pilih_dokter',
        ));
    }

    public function create_rekam(Request $request)
    {
        $antrian = DB::table('antrian')
            ->where('id_pasien', $request->id_pasien)
            ->where('status', 'Proses')
            ->orderBy('id', 'desc')
            ->first();

        if (!$antrian) {
            $antrian = DB::table('antrian')
                ->where('id_pasien', $request->id_pasien)
                ->where('status', 'Menunggu')
                ->orderBy('id', 'desc')
                ->first();

            if ($antrian) {
                DB::table('antrian')
                    ->where('id', $antrian->id)
                    ->update(['status' => 'Proses']);
            }
        }

        DB::table('rekap_medis')->insert([
            'id_pasien'  => $request->id_pasien,
            'id_antrian' => $antrian ? $antrian->id : null,
            'tgl'        => $request->tgl,
            'id_dokter'  => $request->id_dokter,
            'anamnesia'  => $request->anamnesia,
            'diagnosa'   => $request->diagnosa,
            'id_price'   => $request->id_price,
        ]);

        return redirect()->back()->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function pembayaran(Request $request, $id)
    {
        $status = DB::table('antrian')->where('id', $id)->update([
            'status' => 'Selesai',
            'id_metode' => $request->id_metode,
        ]);
        DB::table('pembayaran')->insert([
            'id_antrian' => $request->id_antrian,
            'id_metode' => $request->id_metode,
            'id_pasien' => $request->id_pasien,
            'total' => $request->total,
            'status' => 'Selesai',
            'created_at' => now()
        ]);

        return redirect('/admin/antrian')->with("success", "Pembayaran Berhasil Diselesaikan!");
    }
}

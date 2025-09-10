<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataRekamMedisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $rekam_medis = DB::table('rekap_medis')
            ->join('pasien', 'rekap_medis.id_pasien', '=', 'pasien.id')
            ->select('pasien.*', DB::raw('COUNT(rekap_medis.id) as jumlah_kontrol'))
            ->groupBy('pasien.id')
            ->get();

        return view('admin.rekam_medis.index', [
            'rekam_medis' => $rekam_medis
        ]);
    }

    public function add($id_pasien)
    {
        $user = Auth::user();
        $dokter = DB::table('dokter')->where('id_admin', $user->id_admin)->get();
        $price = DB::table('price')->select('id_price', 'detail', 'harga')->get();
        return view('admin.rekam_medis.tambah', [
            'dokter' => $dokter,
            'price' => $price,
            'id_pasien' => $id_pasien,
        ]);
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        DB::table('rekap_medis')->insert([
            'id_pasien' => $request->id_pasien,
            'id_admin' => $user->id_admin,
            'tgl' => $request->tgl,
            'id_dokter' => $request->id_dokter,
            'anamnesia' => $request->anamnesia,
            'diagnosa' => $request->diagnosa,
            'id_price' => $request->id_price,
        ]);
        return redirect('/admin/rekam_medis')->with("success", "Data Berhasil Ditambahkan !");
    }

    public function detail($id)
    {
        $pasien = DB::table('pasien')
            ->where('id', $id)
            ->first();

        $rekam_medis = DB::table('rekap_medis')
            ->join('dokter', 'rekap_medis.id_dokter', '=', 'dokter.id')
            ->join('price', 'rekap_medis.id_price', '=', 'price.id')
            ->join('jenis', 'price.id_jenis', '=', 'jenis.id')
            ->select(
                'rekap_medis.tgl',
                'rekap_medis.anamnesia',
                'rekap_medis.diagnosa',
                'dokter.nama as nama_dokter',
                'price.detail',
                'jenis.jenis as nama_jenis',
            )
            ->where('rekap_medis.id_pasien', $id)
            ->get();

        return view('admin.rekam_medis.detail', [
            'pasien' => $pasien,
            'rekam_medis' => $rekam_medis,
        ]);
    }

    public function delete($id)
    {
        DB::table('pasien')->where('id', $id)->delete();

        return redirect('/admin/rekam_medis')->with("success", "Data Berhasil Dihapus !");
    }
}

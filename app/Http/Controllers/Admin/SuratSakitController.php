<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratSakitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $surat_sakit = DB::table('surat_sakit')
            ->join('dokter', 'surat_sakit.id_dokter', '=', 'dokter.id')
            ->join('pasien', 'surat_sakit.id_pasien', '=', 'pasien.id')
            ->select(
                'surat_sakit.*',
                'pasien.nama as nama_pasien',
                'dokter.nama as nama_dokter',
                'pasien.contact as no_wa'
            )
            ->get();

        return view('admin.surat.surat_sakit.index', [
            'surat_sakit' => $surat_sakit
        ]);
    }

    public function add()
    {
        $user = Auth::user();
        $dokter = DB::table('dokter')->orderBy('id', 'DESC')->get();
        $pasien = DB::table('pasien')->orderBy('id', 'DESC')->get();
        $surat_sakit = DB::table('surat_sakit')->orderBy('id', 'DESC')->first();
        return view('admin.surat.surat_sakit.tambah', [
            'dokter' => $dokter,
            'pasien' => $pasien,
            'surat_sakit' => $surat_sakit,
        ]);
    }

    public function create(Request $request)
    {
        DB::table('surat_sakit')->insert([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'nomor' => $request->nomor,
            'tgl' => $request->tgl,
            'umur' => $request->umur,
            'jekel' => $request->jekel,
            'diagnosa' => $request->diagnosa,
            'pekerjaan' => $request->pekerjaan,
            'waktu_istirahat' => $request->waktu_istirahat,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_berakhir' => $request->waktu_berakhir,
            'alamat' => $request->alamat,
        ]);

        return redirect('/admin/surat/surat_sakit')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $pasien = DB::table('pasien')
            ->where('id', $id)
            ->first();

        $pilih_pasien = DB::table('pasien')->orderBy('id', 'DESC')->get();
        $pilih_dokter = DB::table('dokter')->orderBy('id', 'DESC')->get();
        $surat_sakit = DB::table('surat_sakit')
            ->where('id', $id)
            ->first();
        return view('admin.surat.surat_sakit.edit', [
            'pasien' => $pasien,
            'surat_sakit' => $surat_sakit,
            'pilih_pasien' => $pilih_pasien,
            'pilih_dokter' => $pilih_dokter,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::table('surat_sakit')
            ->where('id', $id)
            ->update([
                'id_pasien' => $request->id_pasien,
                'id_dokter' => $request->id_dokter,
                'nomor' => $request->nomor,
                'tgl' => $request->tgl,
                'umur' => $request->umur,
                'jekel' => $request->jekel,
                'diagnosa' => $request->diagnosa,
                'pekerjaan' => $request->pekerjaan,
                'waktu_istirahat' => $request->waktu_istirahat,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_berakhir' => $request->waktu_berakhir,
                'alamat' => $request->alamat,
            ]);
        return redirect('/admin/surat/surat_sakit')->with("success", "Data Berhasil Diupdate !");
    }

    public function delete($id)
    {
        DB::table('surat_sakit')->where('id', $id)->delete();

        return redirect('/admin/surat/surat_sakit')->with("success", "Data Berhasil Dihapus !");
    }

    public function cetak($id_pasien)
    {
        $pasien = DB::table('pasien')
            ->where('id', $id_pasien)
            ->first();
        $dokter = DB::table('dokter')->select('nama')->first();
        $surat_sakit = DB::table('surat_sakit')
            ->where('id_pasien', $id_pasien)
            ->first();

        $pdf = Pdf::loadView('admin.surat.surat_sakit.surat', [
            'surat_sakit' => $surat_sakit,
            'pasien' => $pasien,
            'dokter' => $dokter,
        ]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('surat_sakit.pdf');
    }
}

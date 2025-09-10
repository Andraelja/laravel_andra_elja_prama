<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratPengantarRontgenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $pengantar_rontgen = DB::table('pengantar_rontgen')
            ->join('dokter', 'pengantar_rontgen.id_dokter', '=', 'dokter.id')
            ->join('pasien', 'pengantar_rontgen.id_pasien', '=', 'pasien.id')
            ->select(
                'pengantar_rontgen.*',
                'pasien.nama as nama_pasien',
                'dokter.nama as nama_dokter',
            )
            ->get();

        return view('admin.surat.pengantar_rontgen.index', [
            'pengantar_rontgen' => $pengantar_rontgen
        ]);
    }

    public function add()
    {
        $user = Auth::user();
        $dokter = DB::table('dokter')->orderBy('id', 'DESC')->get();
        $pasien = DB::table('pasien')->orderBy('id', 'DESC')->get();
        $pengantar_rontgen = DB::table('pengantar_rontgen')->orderBy('id', 'DESC')->first();
        return view('admin.surat.pengantar_rontgen.tambah', [
            'dokter' => $dokter,
            'pasien' => $pasien,
            'pengantar_rontgen' => $pengantar_rontgen,
        ]);
    }

    public function create(Request $request)
    {
        DB::table('pengantar_rontgen')->insert([
            'nomor' => $request->nomor,
            'tgl' => $request->tgl,
            'umur' => $request->umur,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'tempat' => $request->tempat,
            'diagnosa' => $request->diagnosa,
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter
        ]);

        return redirect('/admin/surat/pengantar_rontgen')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $pasien = DB::table('pasien')
            ->where('id', $id)
            ->first();

        $pilih_pasien = DB::table('pasien')->orderBy('id', 'DESC')->get();
        $pilih_dokter = DB::table('dokter')->orderBy('id', 'DESC')->get();
        $pengantar_rontgen = DB::table('pengantar_rontgen')
            ->where('id', $id)
            ->first();
        return view('admin.surat.pengantar_rontgen.edit', [
            'pasien' => $pasien,
            'pengantar_rontgen' => $pengantar_rontgen,
            'pilih_pasien' => $pilih_pasien,
            'pilih_dokter' => $pilih_dokter,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::table('pengantar_rontgen')
            ->where('id', $id)
            ->update([
                'nomor' => $request->nomor,
                'tgl' => $request->tgl,
                'umur' => $request->umur,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'tempat' => $request->tempat,
                'diagnosa' => $request->diagnosa,
                'id_pasien' => $request->id_pasien,
                'id_dokter' => $request->id_dokter
            ]);
        return redirect('/admin/surat/pengantar_rontgen')->with("success", "Data Berhasil Diupdate !");
    }

    public function delete($id)
    {
        DB::table('pengantar_rontgen')->where('id', $id)->delete();

        return redirect('/admin/surat/pengantar_rontgen')->with("success", "Data Berhasil Dihapus !");
    }

    public function cetak($id_pasien)
    {
        $pasien = DB::table('pasien')
            ->where('id', $id_pasien)
            ->first();
        $dokter = DB::table('dokter')->select('nama')->first();
        $pengantar_rontgen = DB::table('pengantar_rontgen')
            ->where('id_pasien', $id_pasien)
            ->first();

        $pdf = Pdf::loadView('admin.surat.pengantar_rontgen.surat', [
            'pengantar_rontgen' => $pengantar_rontgen,
            'pasien' => $pasien,
            'dokter' => $dokter,
        ]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('pengantar_rontgen.pdf');
    }
}

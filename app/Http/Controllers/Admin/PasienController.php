<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $pasien = DB::table('pasien')
            ->join('rumah_sakit', 'pasien.id_rumah_sakit', '=', 'rumah_sakit.id')
            ->select('pasien.*', 'rumah_sakit.nama_rumah_sakit')
            ->orderBy('pasien.id', 'DESC')
            ->get();

        $rumah_sakit = DB::table('rumah_sakit')->orderBy('nama_rumah_sakit')->get();

        return view('admin.pasien.index', ['pasien' => $pasien, 'rumah_sakit' => $rumah_sakit]);
    }

    public function add()
    {
        $rumah_sakit = DB::table('rumah_sakit')->orderBy('id', 'DESC')->get();
        return view('admin.pasien.tambah', ['rumah_sakit' => $rumah_sakit]);
    }

    public function create(Request $request)
    {
        DB::table('pasien')->insert([
            'nama_pasien' => $request->nama_pasien,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_rumah_sakit' => $request->id_rumah_sakit,
        ]);

        return redirect('/admin/pasien')->with("success", "Data berhasil ditambahkan !");
    }

    public function edit($id)
    {
        $pasien = DB::table('pasien')->find($id);
        $rumah_sakit = DB::table('rumah_sakit')->orderBy('id', 'DESC')->get();

        return view('admin.pasien.edit', ['pasien' => $pasien, 'rumah_sakit' => $rumah_sakit]);
    }

    public function update(Request $request, $id)
    {
        DB::table('pasien')->where('id', $id)->update([
            'nama_pasien' => $request->nama_pasien,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_rumah_sakit' => $request->id_rumah_sakit,
        ]);

        return redirect('/admin/pasien')->with("success", "Data berhasil diperbarui !");
    }

    public function delete($id)
    {
        try {
            DB::table('pasien')->where('id', $id)->delete();
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data!']);
        }
    }

    public function filter($id_rumah_sakit)
    {
        try {
            if ($id_rumah_sakit == 'all') {
                $pasien = DB::table('pasien')
                    ->join('rumah_sakit', 'pasien.id_rumah_sakit', '=', 'rumah_sakit.id')
                    ->select('pasien.*', 'rumah_sakit.nama_rumah_sakit')
                    ->get();
            } else {
                $pasien = DB::table('pasien')
                    ->join('rumah_sakit', 'pasien.id_rumah_sakit', '=', 'rumah_sakit.id')
                    ->where('pasien.id_rumah_sakit', $id_rumah_sakit)
                    ->select('pasien.*', 'rumah_sakit.nama_rumah_sakit')
                    ->get();
            }

            return response()->json([
                'status' => 'success',
                'data'   => $pasien
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data!'
            ]);
        }
    }
}

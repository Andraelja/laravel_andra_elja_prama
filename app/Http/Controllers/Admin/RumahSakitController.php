<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RumahSakitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $rumah_sakit = DB::table('rumah_sakit')->orderBy('id', 'DESC')->get();
        return view('admin.rumah_sakit.index', ['rumah_sakit' => $rumah_sakit]);
    }

    public function add()
    {
        return view('admin.rumah_sakit.tambah');
    }

    public function create(Request $request)
    {
        DB::table('rumah_sakit')->insert([
            'nama_rumah_sakit' => $request->nama_rumah_sakit,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
        ]);

        return redirect('/admin/rumah_sakit')->with("success", "Data berhasil ditambahkan !");
    }

    public function edit($id)
    {
        $rumah_sakit = DB::table('rumah_sakit')->find($id);
        return view('admin.rumah_sakit.edit', ['rumah_sakit' => $rumah_sakit]);
    }

    public function update(Request $request, $id)
    {
        DB::table('rumah_sakit')->where('id', $id)->update([
            'nama_rumah_sakit' => $request->nama_rumah_sakit,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
        ]);

        return redirect('/admin/rumah_sakit')->with("success", "Data berhasil diperbarui !");
    }

    public function delete($id)
    {
        try {
            DB::table('rumah_sakit')->where('id', $id)->delete();
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
        } catch (Exception) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data!']);
        }
    }
}

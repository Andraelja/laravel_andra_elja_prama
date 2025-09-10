<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataPengeluaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $pengeluaran = DB::table('pengeluaran')->orderBy('id', 'DESC')
            ->join('kategori_pengeluaran', 'pengeluaran.id_kategori', '=', 'kategori_pengeluaran.id')
            ->select('pengeluaran.*', 'kategori_pengeluaran.kategori')
            ->get();

        return view('admin.pengeluaran.index', [
            'pengeluaran' => $pengeluaran,
        ]);
    }

    public function add()
    {
        $kategori = DB::table('kategori_pengeluaran')->orderBy('id', 'DESC')->get();
        $pengeluaran = DB::table('pengeluaran')->orderBy('id', 'DESC')->get();

        return view('admin.pengeluaran.tambah', [
            'kategori' => $kategori,
            'pengeluaran' => $pengeluaran,
        ]);
    }

    public function create(Request $request)
    {
        $harga = preg_replace('/\D/', '', $request->harga);

        DB::table('pengeluaran')->insert([
            'tgl' => $request->tgl,
            'id_kategori' => $request->id_kategori,
            'deskripsi' => $request->deskripsi,
            'harga' => $harga,
        ]);

        return redirect('admin/pengeluaran')->with("success", "Data Berhasil Ditambahkan!");
    }

    public function edit($id)
    {
        $kategori = DB::table('kategori_pengeluaran')->orderBy('id', 'DESC')->get();
        $pengeluaran = DB::table('pengeluaran')->where('id', $id)->first();

        return view('admin.pengeluaran.edit', [
            'kategori' => $kategori,
            'pengeluaran' => $pengeluaran,
        ]);
    }

    public function update(Request $request, $id)
    {
        $harga = preg_replace('/\D/', '', $request->harga);

        DB::table('pengeluaran')
            ->where('id', $id)
            ->update([
                'tgl' => $request->tgl,
                'id_kategori' => $request->id_kategori,
                'deskripsi' => $request->deskripsi,
                'harga' => $harga,
            ]);

        return redirect('/admin/pengeluaran')->with("success", "Data Berhasil Diupdate !");
    }

    public function delete($id)
    {
        DB::table('pengeluaran')->where('id', $id)->delete();

        return redirect('/admin/pengeluaran')->with("success", "Data Berhasil Dihapus !");
    }
}

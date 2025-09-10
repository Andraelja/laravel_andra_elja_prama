<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriPengeluaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $kategori = DB::table('kategori_pengeluaran')->orderBy('id', 'DESC')->get();

        return view('admin.kategori.index', ['kategori' => $kategori]);
    }

    public function add()
    {
        return view('admin.kategori.tambah');
    }

    public function create(Request $request)
    {
        DB::table('kategori_pengeluaran')->insert([
            'kategori' => $request->kategori
        ]);

        return redirect('/admin/kategori')->with("success", "Data Berhasil Ditambah !");
    }

    public function edit($id)
    {
        $kategori = DB::table('kategori_pengeluaran')->where('id', $id)->first();

        return view('admin.kategori.edit', ['kategori' => $kategori]);
    }

    public function update(Request $request, $id)
    {
        DB::table('kategori_pengeluaran')
            ->where('id', $id)
            ->update([
                'kategori' => $request->kategori
            ]);

        return redirect('/admin/kategori')->with("success", "Data Berhasil Diupdate !");
    }

    public function delete($id)
    {
        DB::table('kategori_pengeluaran')->where('id', $id)->delete();

        return redirect('/admin/kategori')->with("success", "Data Berhasil Dihapus !");
    }
}

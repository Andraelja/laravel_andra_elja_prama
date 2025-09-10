<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PriceListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $price = DB::table('price')
            ->join('jenis', 'price.id_jenis', '=', 'jenis.id')
            ->orderBy('price.id', 'DESC')
            ->select('price.*', 'jenis.jenis as jenis')
            ->get();

        return view('admin.price.index', [
            'price' => $price
        ]);
    }

    public function add()
    {
        $jenis = DB::table('jenis')->orderBy('jenis')->get();

        return view('admin.price.tambah', [
            'jenis' => $jenis
        ]);
    }

    public function create(Request $request)
    {
        $harga = preg_replace('/\D/', '', $request->harga);

        DB::table('price')->insert([
            'id_jenis' => $request->id_jenis,
            'detail' => $request->detail,
            'harga' => $harga,
            'waktu_pengerjaan' => $request->waktu_pengerjaan,
        ]);

        return redirect('/admin/price')->with("success", "Data Berhasil Ditambah !");
    }

    public function edit($id)
    {
        $price = DB::table('price')
            ->where('price.id', $id)
            ->join('jenis', 'price.id_jenis', '=', 'jenis.id')
            ->select('price.*', 'jenis.jenis as jenis')
            ->first();

        $jenis = DB::table('jenis')->orderBy('id', 'DESC')->get();

        return view('admin.price.edit', [
            'jenis' => $jenis,
            'price' => $price,
        ]);
    }

    public function update(Request $request, $id)
    {
        $harga = preg_replace('/\D/', '', $request->harga);

        DB::table('price')->where('id', $id)->update([
            'id_jenis' => $request->id_jenis,
            'detail' => $request->detail,
            'harga' => $harga,
            'waktu_pengerjaan' => $request->waktu_pengerjaan,
        ]);

        return redirect('/admin/price')->with("success", "Data Berhasil Diupdate !");
    }

    public function delete($id)
    {
        DB::table('price')->where('id', $id)->delete();

        return redirect('/admin/price')->with("success", "Data Berhasil Dihapus !");
    }
}

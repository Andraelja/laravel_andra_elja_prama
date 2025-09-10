<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepsionisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $resepsionis = DB::table('users')
            ->orderBy('id', 'DESC')
            ->where('level', 3)
            ->get();

        return view('admin.resepsionis.index', [
            'resepsionis' => $resepsionis
        ]);
    }

    public function add()
    {
        return view('admin.resepsionis.tambah');
    }

    public function create(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'status' => 1,
            'password' => bcrypt($request->password),
            'level' => 3
        ]);

        return redirect('admin/resepsionis')->with("success", "Data Berhasil Ditambahkan!");
    }

    public function updateStatus($id)
    {
        $resepsionis = DB::table('users')->where('id', $id)->first();
        $newStatus = $resepsionis->status == '1' ? '0' : '1';
        DB::table('users')->where('id', $id)->update(['status' => $newStatus]);

        return redirect('admin/resepsionis')->with("success", "Status Akun berhasil diubah menjadi " . ucfirst($newStatus) . "!");
    }

    public function edit($id)
    {
        $resepsionis = DB::table('users')->where('id', $id)->first();
        return view('admin.resepsionis.edit', ['resepsionis' => $resepsionis]);
    }

    public function update(Request $request, $id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'username' => $request->username,
            ]);

        return redirect('/admin/resepsionis')->with("success", "Data Berhasil Diupdate !");
    }

    public function delete($id)
    {
        $resepsionis = DB::table('users')->where('id', $id)->first();
        if ($resepsionis) {
            DB::table('users')->where('id', $resepsionis->id)->delete();
        }

        return redirect('/admin/resepsionis')->with("success", "Data Berhasil Dihapus !");
    }

    public function resetPassword($id)
    {
        $resepsionis = DB::table('users')->where('id', $id)->first();

        DB::table('users')->where('id', $id)->update([
            'password' => bcrypt('123456'),
        ]);

        return redirect('/admin/resepsionis')->with("success", "Password Berhasil Direset!");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $dokter = DB::table('dokter')
            ->join('users', 'dokter.id_user', '=', 'users.id')
            ->select('dokter.*', 'users.status')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.dokter.index', [
            'dokter' => $dokter,
        ]);
    }

    public function add()
    {
        return view('admin.dokter.tambah');
    }

    public function create(Request $request)
    {
        $userId = DB::table('users')->insertGetId([
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'name' => $request->nama,
            'level' => 2,
            'status' => 1,
        ]);

        DB::table('dokter')->insert([
            'nama' => $request->nama,
            'contact' => $request->contact,
            'alamat' => $request->alamat,
            'gaji' => $request->gaji,
            'id_user' => $userId,
        ]);

        return redirect('admin/dokter')->with("success", "Data Berhasil Ditambahkan!");
    }

    public function updateStatus($id)
    {
        $dokter = DB::table('dokter')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $dokter->id_user)->first();

        $newStatus = $user->status == '1' ? '0' : '1';
        DB::table('users')->where('id', $dokter->id_user)->update(['status' => $newStatus]);

        return redirect('admin/dokter')->with("success", "Status Dokter berhasil diubah menjadi " . ($newStatus == '1' ? 'Aktif' : 'Nonaktif') . "!");
    }

    public function edit($id)
    {
        $dokter = DB::table('dokter')->where('id', $id)->first();

        if (Auth::user()->level == 2 && $dokter->id_admin != Auth::user()->id_admin) {
            return redirect('admin/dokter')->with('error', 'Anda tidak memiliki akses untuk mengedit data ini.');
        }

        return view('admin.dokter.edit', [
            'dokter' => $dokter,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::table('dokter')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama,
                'contact' => $request->contact,
                'alamat' => $request->alamat,
                'gaji' => $request->gaji,
            ]);

        return redirect('/admin/dokter')->with("success", "Data Berhasil Diupdate !");
    }

    public function delete($id)
    {
        $dokter = DB::table('dokter')->where('id', $id)->first();

        if (Auth::user()->level == 2 && $dokter->id_admin != Auth::user()->id_admin) {
            return redirect('admin_cabang/dokter')->with('error', 'Anda tidak memiliki akses untuk menghapus data ini.');
        }

        if ($dokter) {
            DB::table('users')->where('id', $dokter->id_user)->delete();

            DB::table('dokter')->where('id', $id)->delete();

            return redirect('/admin/dokter')->with("success", "Data Berhasil Dihapus!");
        }
    }

    public function resetPassword($id)
    {
        $dokter = DB::table('dokter')->where('id', $id)->first();

        if (Auth::user()->level == 2 && $dokter->id_admin != Auth::user()->id_admin) {
            return redirect('admin/dokter')->with('error', 'Anda tidak memiliki akses untuk mereset password data ini.');
        }

        DB::table('users')->where('id', $dokter->id_user)->update([
            'password' => bcrypt('123456'),
        ]);

        return redirect('/admin/dokter')->with("success", "Password Berhasil Direset!");
    }
}

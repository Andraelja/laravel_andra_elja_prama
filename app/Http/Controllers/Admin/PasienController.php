<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $pasien = DB::table('pasien')->orderBy('id', 'DESC')->get();

        return view('admin.pasien.index', [
            'pasien' => $pasien
        ]);
    }

    public function add()
    {
        $provinsi = DB::table('provinces')->get();
        return view('admin.pasien.tambah', [
            'provinsi' => $provinsi,
        ]);
    }

    public function create(Request $request)
    {
        // Validasi NIK harus tepat 16 digit
        $validator = Validator::make($request->all(), [
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                'unique:pasien,nik'
            ],
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'umur' => 'required|numeric|min:0|max:150',
            'alamat' => 'required|string',
            'contact' => 'required|string|max:20',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
        ], [
            'nik.required' => 'NIK harus diisi',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.digits' => 'NIK harus tepat 16 digit',
            'nik.unique' => 'NIK sudah terdaftar dalam sistem',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('pasien')->insert([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
            'contact' => $request->contact,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
        ]);
        
        return redirect('/admin/pasien')->with("success", "Data Berhasil Ditambahkan!");
    }

    public function edit($id)
    {
        $pasien = DB::table('pasien')->find($id);
        $provinsi = DB::table('provinces')->get();

        return view('admin.pasien.edit', [
            'pasien' => $pasien,
            'provinsi' => $provinsi,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                'unique:pasien,nik,' . $id
            ],
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'umur' => 'required|numeric|min:0|max:150',
            'alamat' => 'required|string',
            'contact' => 'required|string|max:20',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
        ], [
            'nik.required' => 'NIK harus diisi',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.digits' => 'NIK harus tepat 16 digit',
            'nik.unique' => 'NIK sudah terdaftar dalam sistem',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('pasien')->where('id', $id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
            'contact' => $request->contact,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan
        ]);
        
        return redirect('/admin/pasien')->with("success", "Data Berhasil Diperbarui!");
    }

    public function delete($id)
    {
        DB::table('pasien')->where('id', $id)->delete();

        return redirect('admin/pasien')->with("success", "Data Berhasil Dihapus!");
    }

    public function detail($id)
    {
        $pasien = DB::table('pasien')->where('id', $id)->first();
        $provinces = DB::table('provinces')->where('id', $pasien->provinsi)->first();

        return view('admin.rontgen.index', compact('pasien', 'provinces'));
    }

    public function getKabupaten(Request $request)
    {
        $kabupaten = DB::table('regencies')
            ->where('province_id', $request->province_id)
            ->pluck('name', 'id');

        return response()->json($kabupaten);
    }

    public function getKecamatan(Request $request)
    {
        $kecamatan = DB::table('districts')
            ->where('regency_id', $request->regency_id)
            ->pluck('name', 'id');

        return response()->json($kecamatan);
    }

    public function getKelurahan(Request $request)
    {
        $kelurahan = DB::table('villages')
            ->where('district_id', $request->district_id)
            ->pluck('name', 'id');

        return response()->json($kelurahan);
    }
}
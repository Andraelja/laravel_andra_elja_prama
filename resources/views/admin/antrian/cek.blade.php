@extends('admin.layouts.app', [
    'activePage' => 'antrian',
    'subactivePage' => '',
])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-7 mb-4">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-add-to-queue me-2"></i> Tambah Data Reservasi Antrian
                        </h4>
                        <a href="{{ url('/admin/antrian') }}" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">

                    <form action="{{ url('/admin/antrian/cek') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="mb-1">Pilih Dokter</label>
                            @if (Auth::user()->level == 1 || Auth::user()->level == 3)
                                <select name="id_dokter" class="form-control" required>
                                    <option value="">-- Pilih Dokter --</option>
                                    @foreach ($dokter as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select name="id_dokter" class="form-control" required>
                                    <option value="{{ $dokter_login->id }}">{{ $dokter_login->nama }}</option>
                                </select>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label class="mb-1">Tanggal</label>
                            <input type="date" name="tgl" class="form-control" value="{{ $tanggal }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="mb-1">Jam Kedatangan</label>
                            <input type="time" name="waktu_kedatangan" value="{{ $jam }}" class="form-control"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="mb-1">Keluhan</label>
                            <input type="text" class="form-control" name="keluhan" placeholder="Masukkan Keluhan...">
                        </div>
                        <input type="hidden" name="id_pasien" value="{{ $pasien->id }}">

                        <button type="submit" class="btn btn-primary mt-2">
                            <i class="bx bx-save fs-5 me-2"></i> Tambah Data
                        </button>
                    </form>
                </div>
            </div>

            <!-- Data Pasien -->
            <div class="col-md-5 mb-4">
                <div class="card p-4">
                    <h5 class="text-primary mb-4"><i class="bx bx-user me-2"></i> Data Pasien</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>ID Pasien</strong></td>
                                <td>: {{ $pasien->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>NIK</strong></td>
                                <td>: {{ $pasien->nik }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Lengkap</strong></td>
                                <td>: {{ $pasien->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Umur</strong></td>
                                <td>: {{ $pasien->umur }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>: {{ strtoupper($pasien->jenis_kelamin) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Contact</strong></td>
                                <td>: {{ $pasien->contact }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>: {{ $pasien->alamat }}</td>
                            </tr>
                            <tr>
                                <td><strong>Provinsi</strong></td>
                                <td>: {{ $provinces->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kabupaten/Kota</strong></td>
                                <td>: {{ $pasien->nama_kabupaten ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kecamatan</strong></td>
                                <td>: {{ $pasien->nama_kecamatan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kelurahan</strong></td>
                                <td>: {{ $pasien->nama_kelurahan ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    @endpush
@endsection

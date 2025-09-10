@extends('admin.layouts.app', [
    'activePage' => 'antrian',
    'subactivePage' => '',
])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-7 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Rekap Medis
                        </h4>
                        <a href="{{ url('/admin/antrian') }}" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">
                    <div class="table-responsive text-nowrap">
                        <table id="dataTable" class="table table-bordered table-hover table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center py-2">#</th>
                                    <th class="py-2">Tanggal</th>
                                    <th class="py-2">Dokter</th>
                                    <th class="py-2">Anamnesia</th>
                                    <th class="py-2">Diagnosa</th>
                                    <th class="py-2">Therapy</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekap_medis as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-wrap">{{ \Carbon\Carbon::parse($data->tgl)->format('d M Y') }}</td>
                                        <td class="text-wrap">{{ $data->nama_dokter }}</td>
                                        <td class="text-wrap">{{ $data->anamnesia ?? '-' }}</td>
                                        <td class="text-wrap">{{ $data->diagnosa ?? '-' }}</td>
                                        <td class="text-wrap">{{ $data->therapy ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Data Pasien -->
            <div class="col-md-5 mb-4 order-1">
                <div class="card p-4">
                    <h5 class="text-primary mb-4"><i class="bx bx-user me-2"></i> Data Pasien</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>ID Pasien</strong></td>
                                <td>: {{ $pasien->id_pasien }}</td>
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
                                <td>: {{ $pasien->umur }} Tahun</td>
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
@endsection

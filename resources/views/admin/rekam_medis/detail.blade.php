@extends('admin.layouts.app', [
    'activePage' => 'rekam_medis',
    'subactivePage' => '',
])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Detail Data Rekam Medis
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/admin/rekam_medis">Rekam Medis</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ url('/admin/rekam_medis') }}" class="btn btn-primary btn-sm d-flex align-items-center">
                <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
            </a>
        </div>

        <div class="row">
            <div class="col-md-7 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Rekam Medis
                        </h4>
                    </div>
                    <hr class="mt-0">
                    <div class="table-responsive text-nowrap">
                        <table id="dataTable" class="table table-bordered table-hover table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="py-2 text-wrap text-start">Tanggal</th>
                                    <th class="py-2 text-wrap text-start">Dokter</th>
                                    <th class="py-2 text-wrap text-start">Anamnesia</th>
                                    <th class="py-2 text-wrap text-start">Diagnosa</th>
                                    <th class="py-2 text-wrap text-start">Therapy</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekam_medis as $data)
                                    <tr>
                                        <td class="py-2 text-wrap">
                                            {{ \Carbon\Carbon::parse($data->tgl)->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="py-2 text-wrap text-start">{{ $data->nama_dokter }}</td>
                                        <td class="py-2 text-wrap text-start">{{ $data->anamnesia }}</td>
                                        <td class="py-2 text-wrap text-start">{{ $data->diagnosa }}</td>
                                        <td class="py-2 text-wrap text-start">{{ $data->nama_jenis }}</td>
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

@extends('admin.layouts.app', [
    'activePage' => 'antrian',
    'subactivePage' => 'rekam_medis',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Master
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/dokter/rekam_medis">Rekap Medis</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Rekap Medis</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7 mb-4 order-0">
                <div class="card p-4" style="height: 100%">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-add-to-queue me-2"></i> Tambah Data Rekap Medis
                        </h4>
                        <a href="/admin/antrian/tunggu/" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">
                    <form action="/admin/antrian/rekam_medis/create" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <input type="hidden" name="id_pasien" value="{{ $id_pasien }}">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Tanggal Rekap Medis</label>
                                    <input type="date" autofocus name="tgl" required class="form-control"
                                        placeholder="Masukkan Tanggal ....." value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_dokter" class="form-label">Dokter Yang Menangani</label>
                                    @if (Auth::user()->level == 1 || Auth::user()->level == 3)
                                        <select class="form-control select2" name="id_dokter" required>
                                            <option value="">-- Pilih Dokter --</option>
                                            @foreach ($dokter as $data)
                                                <option value="{{ $data->id }}"
                                                    @if ($pilih_dokter && $data->id === $pilih_dokter->id_dokter) selected @endif>
                                                    {{ $data->nama }}
                                                </option>
                                            @endforeach
                                        @else
                                            <input type="text" class="form-control" value="{{ $dokter_login->nama }}"
                                                readonly>
                                            <input type="hidden" name="id_dokter" value="{{ $dokter_login->id }}">
                                    @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Anamnesia</label>
                                    <input type="text" autofocus name="anamnesia" required class="form-control"
                                        placeholder="Masukkan Anamnesia .....">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Diagnosa</label>
                                    <input type="text" autofocus name="diagnosa" required class="form-control"
                                        placeholder="Masukkan Diagnosa .....">
                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Jenis Therapy</label>
                                    <select name="id_price" class="form-select" required>
                                        <option value="" disabled selected>-- Pilih Jenis --</option>
                                        @foreach ($price as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->nama_jenis }} | Harga Minimal |Rp
                                                {{ number_format($data->harga, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-10"><i class="bx bx-save fs-5 me-2"></i> Tambah
                            Data</button>
                    </form>
                </div>
            </div>
            <div class="col-md-5 mb-4 order-1">
                <div class="card text-center p-3 shadow mb-5">
                    <h4 class="fw-bold mb-0 d-flex align-items-center">
                        <i class="bx bx-money fs-3 me-2"></i> Total Bayar
                    </h4>
                    <div class="card-body">
                        <h3 class="card-text mb-3 fw-bold">
                            Rp {{ number_format($total_bayar, 0, ',', '.') }}
                        </h3>
                        @if (isset($antrian) && $antrian)
                            <form action="{{ route('admin.antrian.updateStatus', $antrian->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" title="Selesaikan Antrian">
                                    <i class="bx bx-check"></i>Selesaikan Antrian
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4 order-0">
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
                                <th class="py-2 text-wrap text-start">Dokter Yang Menangani</th>
                                <th class="py-2 text-wrap text-start">Anamnesia</th>
                                <th class="py-2 text-wrap text-start">Diagnosa</th>
                                <th class="py-2 text-wrap text-start">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekap_medis as $data)
                                <tr>
                                    <td class="py-2 text-wrap text-start">{{ $data->nama_dokter }}</td>
                                    <td class="py-2 text-wrap text-start">{{ $data->anamnesia }}</td>
                                    <td class="py-2 text-wrap text-start">{{ $data->diagnosa }}</td>
                                    <td class="py-2 text-wrap text-start">Rp
                                        {{ number_format($data->harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

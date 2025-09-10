@extends('admin.layouts.app', [
    'activePage' => 'rekam_medis',
    'subactivePage' => '',
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

        <!-- List Data Jenis -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-add-to-queue me-2"></i> Tambah Data Rekap Medis
                        </h4>
                        <a href="/admin/rekam_medis/" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">
                    <form action="/admin/rekam_medis/create" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <input type="hidden" name="id_pasien" value="{{ $id_pasien }}">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Tanggal Rekap Medis</label>
                                    <input type="date" autofocus name="tgl" required class="form-control"
                                        placeholder="Masukkan Tanggal .....">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Dokter Yang Menangani</label>
                                    <select name="id_dokter" class="form-select" required>
                                        <option value="" disabled selected>-- Pilih Dokter --</option>
                                        @foreach ($dokter as $data)
                                            <option value="{{ $data->id_dokter }}">{{ $data->nama }}</option>
                                        @endforeach
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
                                            <option value="{{ $data->id_price }}">
                                                {{ $data->detail }} | Rp {{ number_format($data->harga, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5"><i class="bx bx-save fs-5 me-2"></i> Tambah
                            Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

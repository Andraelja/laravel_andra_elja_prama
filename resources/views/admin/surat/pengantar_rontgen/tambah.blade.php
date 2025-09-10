@extends('admin.layouts.app', [
    'activePage' => 'surat',
    'subactivePage' => 'pengantar_rontgen',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Surat Menyurat
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Data Surat Pengantar Rontgen</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data banner -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-add-to-queue me-4"></i> Tambah Data Surat Pengantar Rontgen
                        </h4>
                        <a href="/admin/surat/pengantar_rontgen/" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">

                    <form action="/admin/surat/pengantar_rontgen/create" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor" class="mb-1">Nomor Surat</label>
                                    <input type="text" class="form-control" id="nomor" name="nomor" autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Tanggal</label>
                                    <input type="date" name="tgl" required class="form-control"
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Umur</label>
                                    <input type="text" name="umur" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label for="id_pasien" class="mb-1">Nama Pasien</label>
                                    <select class="form-control select2" name="id_pasien" required>
                                        <option value="">-- Pilih Pasien --</option>
                                        @foreach ($pasien as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($pengantar_rontgen && $data->id === $pengantar_rontgen->id_pasien) selected @endif>
                                                {{ $data->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Tujuan</label>
                                    <input type="text" name="tempat" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label for="id_dokter" class="mb-1">Dokter Yang Menangani</label>
                                    <select class="form-control select2" name="id_dokter" required>
                                        <option value="">-- Pilih Dokter --</option>
                                        @foreach ($dokter as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($pengantar_rontgen && $data->id === $pengantar_rontgen->id_dokter) selected @endif>
                                                {{ $data->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Alamat</label>
                                    <input type="text" name="alamat" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Diagnosa</label>
                                    <input type="text" name="diagnosa" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5">
                            <i class="bx bx-save fs-5 me-2"></i> Tambah Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

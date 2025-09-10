@extends('admin.layouts.app', [
    'activePage' => 'master',
    'subactivePage' => 'metode_pembayaran',
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
                        <li class="breadcrumb-item"><a href="/admin/metode_pembayaran">Metode Pembayaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Metode Pembayaran</li>
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
                            <i class="bx bx-add-to-queue me-2"></i> Edit Data Metode Pembayaran
                        </h4>
                        <a href="/admin/metode_pembayaran" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">
                    <form action="/admin/metode_pembayaran/update/{{ $metode_pembayaran->id }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Nama</label>
                                    <input type="text" autofocus name="nama" required class="form-control"
                                        placeholder="Masukkan Nama ....." value="{{ $metode_pembayaran->nama }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Nomor Rekening</label>
                                    <input type="text" autofocus name="nomor_rekening" required class="form-control"
                                        placeholder="Masukkan Nomor Rekening ....."
                                        value="{{ $metode_pembayaran->nomor_rekening }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mt-5">Atas Nama</label>
                                    <input type="text" autofocus name="atas_nama" required class="form-control"
                                        placeholder="Masukkan Atas Nama ....." value="{{ $metode_pembayaran->atas_nama }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5"><i class="bx bx-save fs-5 me-2"></i> Update
                            Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

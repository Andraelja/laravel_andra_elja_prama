@extends('admin.layouts.app', [
    'activePage' => 'master',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Rumah Sakit
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/admin/rumah_sakit">Rumah Sakit</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data Rumah Sakit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-add-to-queue me-2"></i> Edit Data Rumah Sakit
                        </h4>
                        <a href="/admin/rumah_sakit" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">
                    <form action="/admin/rumah_sakit/update/{{ $rumah_sakit->id }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Nama Rumah Sakit</label>
                                    <input type="text" autofocus name="nama_rumah_sakit" required class="form-control"
                                        placeholder="Masukkan Nama Rumah Sakit ....."
                                        value="{{ $rumah_sakit->nama_rumah_sakit }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Alamat</label>
                                    <input type="text" name="alamat" required class="form-control"
                                        placeholder="Masukkan Alamat Rumah Sakit ....." value="{{ $rumah_sakit->alamat }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Email</label>
                                    <input type="email" name="email" required class="form-control"
                                        placeholder="Masukkan Email Rumah Sakit ....." value="{{ $rumah_sakit->email }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Telepon</label>
                                    <input type="number" name="no_telp" required class="form-control"
                                        placeholder="Masukkan Telepon Rumah Sakit ....." value="{{ $rumah_sakit->no_telp }}">
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

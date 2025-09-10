@extends('admin.layouts.app', [
    'activePage' => 'account',
    'subactivePage' => 'resepsionis',
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
                        <li class="breadcrumb-item"><a href="/admin/resepsionis">Resepsionis</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Resepsionis</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data resepsionis -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-add-to-queue me-2"></i> Tambah Data Resepsionis
                        </h4>
                        @if(Auth::user()->level == 1)
                        <a href="/admin/resepsionis" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                        @endif
                    </div>
                    <hr class="mt-0">

                    @if(Auth::user()->level == 1)
                    <form action="/admin/resepsionis/create" method="POST" enctype="multipart/form-data">
                        @endif
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Nama Lengkap</label>
                                    <input type="text" autofocus name="name" required class="form-control"
                                        placeholder="Masukkan Nama Resepsionis .....">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Username</label>
                                    <input type="text" autofocus name="username" required class="form-control"
                                        placeholder="Masukkan Username Resepsionis .....">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Email</label>
                                    <input type="email" autofocus name="email" required class="form-control"
                                        placeholder="Masukkan Email Resepsionis .....">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Password</label>
                                    <input type="password" autofocus name="password" required class="form-control"
                                        placeholder="Masukkan Password Resepsionis .....">
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

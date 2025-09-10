@extends('admin.layouts.app', [
    'activePage' => 'account',
    'subactivePage' => 'dokter',
])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Account
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Data Account</li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/admin/dokter">Dokter</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data Dokter -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Dokter
                        </h4>
                        @if (Auth::user()->level == 1)
                            <a href="/admin/dokter/add" class="btn btn-primary btn-sm d-flex align-items-center">
                                <i class="bx bx-add-to-queue fs-6 me-2"></i> Tambah Data
                            </a>
                        @endif
                    </div>
                    <hr class="mt-0">

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive text-nowrap">
                        <table id="dataTable" class="table table-bordered table-hover table-striped">
                            <thead class="bg-primary">
                                <tr>
                                    <th width="5%" class="fs-6 text-center py-2 align-middle">#</th>
                                    <th class="fs-6 text-center py-2 text-wrap">Nama Dokter</th>
                                    <th class="fs-6 text-center py-2 align-middle">Gaji</th>
                                    <th class="fs-6 text-center py-2 align-middle">Status</th>
                                    @if (Auth::user()->level == 1)
                                        <th class="fs-6 text-center py-2 align-middle" width="5%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokter as $index => $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $loop->iteration }}</td>
                                        <td class="text-start text-break text-wrap py-2 fs-6">{{ $data->nama }}</td>
                                        <td class="text-start text-break text-wrap py-2 fs-6">Rp {{ $data->gaji }}</td>
                                        <td class="text-center" width="15%">
                                            @if ($data->status == '1')
                                                <button type="button" class="btn btn-success btn-xs" data-bs-toggle="modal"
                                                    data-bs-target="#statusModal-{{ $data->id }}">
                                                    Aktif
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal"
                                                    data-bs-target="#statusModal-{{ $data->id }}">
                                                    Nonaktif
                                                </button>
                                            @endif

                                            @if (Auth::user()->level == 1)
                                                <!-- Modal Status -->
                                                <div class="modal fade" id="statusModal-{{ $data->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <h5>Apakah Anda yakin ingin mengubah status dokter ini?</h5>
                                                                <hr>
                                                                <p><strong>Nama Dokter:</strong> {{ $data->nama }}</p>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-6">
                                                                        @if (Auth::user()->level == 1)
                                                                            <form
                                                                                action="{{ url('/admin/dokter/updateStatus/' . $data->id) }}"
                                                                                method="POST">
                                                                        @endif
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-primary w-100">Ya</button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <button type="button" class="btn btn-danger w-100"
                                                                            data-bs-dismiss="modal">Tidak</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        @if (Auth::user()->level == 1)
                                            <td class="text-center py-2">
                                                <button class="btn btn-primary btn-sm" title="Reset Password"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#resetPasswordModal-{{ $data->id }}">
                                                    <i class='bx bx-sync'></i>
                                                </button>
                                                @if (Auth::user()->level == 1)
                                                    <a href="/admin/dokter/edit/{{ $data->id }}"
                                                        class="btn btn-success btn-sm" title="Edit Data">
                                                        <i class='bx bx-edit'></i>
                                                    </a>
                                                @endif
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#data-{{ $data->id }}" title="Delete Data">
                                                    <i class='bx bxs-trash'></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($dokter as $data)
        <!-- Modal Delete -->
        <div class="modal fade" id="data-{{ $data->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apakah Anda Yakin Menghapus Data Ini?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr class="mb-0">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-1">Nama Dokter</label>
                            <input class="form-control" value="{{ $data->nama }}" readonly
                                style="background-color: white; pointer-events: none;">
                        </div>
                        <div class="row mt-6">
                            <div class="col-md-6">
                                @if (Auth::user()->level == 1)
                                    <a href="/admin/dokter/delete/{{ $data->id }}" style="text-decoration: none;">
                                        <button type="button" class="btn btn-primary w-100">Ya</button>
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger w-100"
                                    data-bs-dismiss="modal">Tidak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Reset Password -->
        <div class="modal fade" id="resetPasswordModal-{{ $data->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                @if (Auth::user()->level == 1)
                    <form action="{{ url('/admin/dokter/resetPassword/' . $data->id) }}" method="POST">
                @endif
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <hr class="mb-0">
                    <div class="modal-body text-center">
                        <p>Apakah Anda yakin ingin me-reset password akun berikut?</p>
                        <p><strong>Nama Dokter:</strong> {{ $data->nama }}</p>
                        <p class="text-danger">Password akan direset ke <strong>123456</strong></p>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary w-100">Ya, Reset</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger w-100"
                                    data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

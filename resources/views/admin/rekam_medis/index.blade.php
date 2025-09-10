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
                    <i class="bx bx-book-content me-2"></i> Data Rekam Medis
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Data Rekam Medis</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data rekam_medis -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Rekam Medis
                        </h4>
                    </div>
                    <hr class="mt-0">
                    <!-- Alert Messages -->
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
                                    <th class="fs-6 text-center py-2 text-wrap align-middle">NIK</th>
                                    <th class="fs-6 text-center py-2 text-wrap align-middle">Nama Pasien</th>
                                    <th class="fs-6 text-center py-2 text-wrap align-middle">Umur</th>
                                    <th class="fs-6 text-center py-2 text-wrap align-middle">Jenis Kelamin</th>
                                    <th class="fs-6 text-center py-2 text-wrap align-middle">Contact</th>
                                    <th class="fs-6 text-center py-2 text-wrap align-middle">Alamat</th>
                                    <th class="fs-6 text-center py-2 text-wrap align-middle">Jumlah Kontrol</th>
                                    <th class="fs-6 text-center py-2  text-wrap align-middle" width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekam_medis as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $data->nik ?? '-' }}</td>
                                        <td class="py-2 text-wrap">{{ $data->nama }}</td>
                                        <td class="py-2">{{ $data->umur }}</td>
                                        <td class="py-2 text-wrap">{{ $data->jenis_kelamin ?? '-' }}</td>
                                        <td class="py-2 text-wrap">{{ $data->contact }}</td>
                                        <td class="py-2 text-wrap">{{ $data->alamat }}</td>
                                        <td class="py-2 text-wrap text-center">{{ $data->jumlah_kontrol }}</td>
                                        <td class="text-center py-2 ">
                                            <a href="/admin/rekam_medis/detail/{{ $data->id }}"
                                                class="btn btn-success btn-sm" title="Detail">
                                                <i class='bx bx-id-card'></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#data-{{ $data->id }}" title="Delete Data">
                                                <i class='bx bxs-trash'></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($rekam_medis as $data)
        <div class="modal fade" id="data-{{ $data->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Apakah Anda Yakin Menghapus Data Ini ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr class="mb-0">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-1">NIK Pasien</label>
                            <input class="form-control" value="{{ $data->nik }}" readonly
                                style="background-color: white;pointer-events: none;">
                        </div>
                        <div class="form-group mt-5">
                            <label class="mb-1">Nama Pasien</label>
                            <input class="form-control" value="{{ $data->nama }}" readonly
                                style="background-color: white;pointer-events: none;">
                        </div>
                        <div class="form-group mt-5">
                            <label class="mb-1">Contact</label>
                            <input class="form-control" value="{{ $data->contact }}" readonly
                                style="background-color: white;pointer-events: none;">
                        </div>
                        <div class="form-group mt-5">
                            <label class="mb-1">Alamat</label>
                            <input class="form-control" value="{{ $data->alamat }}" readonly
                                style="background-color: white;pointer-events: none;">
                        </div>
                        <div class="row mt-6 mt-5">
                            <div class="col-md-6">
                                <a href="/admin/rekam_medis/delete/{{ $data->id }}" style="text-decoration: none;">
                                    <button type="button" class="btn btn-primary w-100">Ya</button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger w-100" data-dismiss="modal"
                                    aria-label="Close">Tidak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

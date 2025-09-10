@extends('admin.layouts.app', [
    'activePage' => 'master',
    'subactivePage' => 'price',
]);
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
                        <li class="breadcrumb-item">Data Master</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ url('admin/price') }}">Price List</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data Price -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Price
                        </h4>
                        @if (Auth::user()->level == 1)
                            <a href="{{ url('admin/price/add') }}" class="btn btn-primary btn-sm d-flex align-items-center">
                                <i class="bx bx-add-to-queue fs-6 me-2"></i> Tambah Data
                            </a>
                        @endif
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
                                    <th width="5%" class="fs-6 text-center py-2 align-middle">#</th>
                                    <th class="fs-6 text-center py-2 text-wrap align-middle">Nama Treatment</th>
                                    <th class="fs-6 text-center py-2 text-wrap align-middle">Keterangan</th>
                                    <th class="fs-6 text-center py-2 align-middle">Harga</th>
                                    <th class="fs-6 text-center py-2 text-wrap">Waktu Pengerjaan</th>
                                    @if (Auth::user()->level == 1)
                                        <th class="fs-6 text-center py-2" width="5%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($price as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $no++ }}</td>
                                        <td class="py-2 text-wrap">{{ $data->jenis }}</td>
                                        <td class="py-2 text-wrap">{{ $data->detail }}</td>
                                        <td>{{ 'Rp ' . number_format($data->harga, 0, ',', '.') }}</td>
                                        <td class="py-2">{{ $data->waktu_pengerjaan }} Menit</td>
                                        @if (Auth::user()->level == 1)
                                            <td class="text-center py-2">
                                                <a href="{{ url('admin/price/edit/' . $data->id) }}"
                                                    class="btn btn-success btn-sm" title="Edit Data">
                                                    <i class='bx bx-edit'></i>
                                                </a>
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

    @foreach ($price as $data)
        <div class="modal fade" id="data-{{ $data->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apakah Anda Yakin Menghapus Data Ini?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr class="mb-0">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mt-3">Nama Treatment</label>
                                    <input class="form-control" value="{{ $data->jenis }}" readonly
                                        style="background-color: white; pointer-events: none;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mt-3">Rincian</label>
                                    <input class="form-control" value="{{ $data->detail }}" readonly
                                        style="background-color: white; pointer-events: none;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mt-3">Harga</label>
                                    <input class="form-control" value="{{ 'Rp ' . number_format($data->harga, 0, ',', '.') }}" readonly
                                        style="background-color: white; pointer-events: none;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mt-3">Waktu Pengerjaan</label>
                                    <input class="form-control" value="{{ $data->waktu_pengerjaan }} Menit" readonly
                                        style="background-color: white; pointer-events: none;">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-md-6">
                                <a href="{{ url('admin/price/delete/' . $data->id) }}" style="text-decoration: none;">
                                    <button type="button" class="btn btn-primary w-100">Ya</button>
                                </a>
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
    @endforeach
@endsection

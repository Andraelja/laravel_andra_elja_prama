@extends('admin.layouts.app', [
    'activePage' => 'antrian',
    'subactivePage' => 'menunggu',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Menunggu
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Data Menunggu</li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/admin/antrian">Data Menunggu</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Menunggu
                        </h4>
                        <a href="/admin/antrian/" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
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
                                    <th class="fs-6 text-center py-2 text-wrap">Nama Pasien</th>
                                    <th class="fs-6 text-center py-2 align-middle">Keluhan</th>
                                    <th class="fs-6 text-center py-2 align-middle">Nama Dokter</th>
                                    <th class="fs-6 text-center py-2 text-wrap">Jam Kedatangan</th>
                                    <th class="fs-6 text-center py-2 align-middle">Keterangan</th>
                                    <th class="fs-6 text-center py-2 align-middle">Status</th>
                                    <th class="fs-6 text-center py-2 align-middle" width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($antrian as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $no++ }}</td>
                                        <td class="py-2 text-wrap">{{ $data->nama_pasien }}</td>
                                        <td class="py-2 text-wrap">{{ $data->keluhan ?? '-' }}</td>
                                        <td class="py-2 text-wrap">{{ $data->nama_dokter ?? '-' }}</td>
                                        <td class="py-2 text-wrap">{{ $data->jam ?? '-' }}</td>
                                        <td class="py-2 text-wrap">{{ $data->keterangan ?? '-' }}</td>
                                        <td class="py-2 "><span class="badge bg-primary">{{ $data->status }}</span></td>
                                        <td class="text-center py-2">
                                            <form action="{{ route('admin.antrian.updateStatus', $data->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Ubah Status">
                                                    <i class="bx bx-check"></i>
                                                </button>
                                            </form>
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
@endsection

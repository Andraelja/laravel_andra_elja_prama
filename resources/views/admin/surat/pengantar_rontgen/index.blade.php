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
                        <li class="breadcrumb-item">Data Surat Menyurat</li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/admin/surat/pengantar_rontgen">Surat
                                Pengantar Rontegen</a></li>
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
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Surat Pengantar Rontegen
                        </h4>
                        <a href="/admin/surat/pengantar_rontgen/add"
                            class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bx-add-to-queue fs-6 me-2"></i> Tambah Data
                        </a>
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
                                    <th width="5%" class="fs-6 text-center py-2">#</th>
                                    <th class="fs-6 text-center py-2 align-middle text-wrap">Tanggal</th>
                                    <th class="fs-6 text-center py-2 align-middle">Nomor Surat</th>
                                    <th class="fs-6 text-center py-2 align-middle">Nama Lengkap</th>
                                    <th class="fs-6 text-center py-2 align-middle">Dokter Yang Menangani</th>
                                    <th class="fs-6 text-center py-2 align-middle">Diagnosa</th>
                                    <th class="fs-6 text-center py-2 align-middle">Tujuan</th>
                                    <th class="fs-6 text-center py-2 align-middle" width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengantar_rontgen as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $loop->iteration }}</td>
                                        <td class="text-start text-break text-wrap py-2 fs-6">
                                            {{ \Carbon\Carbon::parse($data->tgl)->format('d M Y') }}</td>
                                        <td class="text-start text-break text-wrap py-2 fs-6">{{ $data->nomor }}</td>
                                        <td class="text-start text-break text-wrap py-2 fs-6">{{ $data->nama_pasien }}</td>
                                        <td class="text-start text-break text-wrap py-2 fs-6">{{ $data->nama_dokter }}</td>
                                        <td class="text-start text-break text-wrap py-2 fs-6">{{ $data->diagnosa }}</td>
                                        <td class="text-start text-break text-wrap py-2 fs-6">{{ $data->tempat }}</td>
                                        <td class="text-center py-2">
                                            <form
                                                action="{{ url('admin/surat/pengantar_rontgen/cetak/' . $data->id_pasien) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm" title="Download">
                                                    <i class="bx bx-printer"></i>
                                                </button>
                                            </form>
                                            <a href="{{ url('admin/surat/pengantar_rontgen/edit/' . $data->id) }}"
                                                class="btn btn-success btn-sm" title="Edit Data">
                                                <i class='bx bx-edit'></i>
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

    @foreach ($pengantar_rontgen as $data)
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
                            <label class="mb-1">Nomor Surat</label>
                            <input class="form-control" value="{{ $data->nomor }}" readonly
                                style="background-color: white; pointer-events: none;">
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Tanggal</label>
                            <input class="form-control" value="{{ $data->tgl }}" readonly
                                style="background-color: white; pointer-events: none;">
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Nama Pasien</label>
                            <input class="form-control" value="{{ $data->nama_pasien }}" readonly
                                style="background-color: white; pointer-events: none;">
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Nama Dokter</label>
                            <input class="form-control" value="{{ $data->nama_dokter }}" readonly
                                style="background-color: white; pointer-events: none;">
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Diagnosa</label>
                            <input class="form-control" value="{{ $data->diagnosa }}" readonly
                                style="background-color: white; pointer-events: none;">
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Tujuan</label>
                            <input class="form-control" value="{{ $data->tempat }}" readonly
                                style="background-color: white; pointer-events: none;">
                        </div>
                        <div class="row mt-6">
                            <div class="col-md-6">
                                <a href="{{ url('admin/surat/pengantar_rontgen/delete/' . $data->id) }}"
                                    style="text-decoration: none;">
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

@extends('admin.layouts.app', [
    'activePage' => 'pasien',
    'subactivePage' => '',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Pasien
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Data Pasien</li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/admin/pasien">Data Pasien</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data Pasien -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Pasien
                        </h4>
                        @if(Auth::user()->level == 1 || Auth::user()->level == 3)
                        <a href="/admin/pasien/add" class="btn btn-primary btn-sm d-flex align-items-center">
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
                                    <th class="text-center py-2">No</th>
                                    <th class="text-center py-2">NIK</th>
                                    <th class="text-center py-2">Nama Pasien</th>
                                    <th class="text-center py-2">Umur</th>
                                    <th class="text-center py-2">Kontak</th>
                                    <th class="text-center py-2">Alamat</th>
                                    @if(Auth::user()->level == 1 || Auth::user()->level == 3)
                                    <th class="text-center py-2" width="5%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($pasien as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $no++ }}</td>
                                        <td class="text-center py-2">{{ $data->nik }}</td>
                                        <td class="text-center py-2">{{ $data->nama }}</td>
                                        <td class="text-center py-2">{{ $data->umur }}</td>
                                        <td class="text-center py-2">{{ $data->contact }}</td>
                                        <td class="text-center py-2">{{ $data->alamat }}</td>
                                        @if(Auth::user()->level == 1 || Auth::user()->level == 3)
                                        <td class="text-center py-2">
                                            <a href="/admin/pasien/edit/{{ $data->id }}" class="btn btn-success btn-sm"
                                                title="Edit Data">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#data-{{ $data->id }}" title="Delete Data">
                                                <i class='bx bxs-trash'></i>
                                            </button>
                                            {{-- <a href="/admin/pasien/rontgen/{{ $data->id }}" class="btn btn-dark btn-sm"
                                                title="Data Rontgen">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <a href="/admin/pasien/gigi/{{ $data->id }}" class="btn btn-info btn-sm"
                                                title="Data Gigi">
                                                <i class='bx bx-edit'></i>
                                            </a> --}}
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
    @foreach ($pasien as $data)
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
                            <label class="mb-1">NIK</label>
                            <input class="form-control" value="{{ $data->nik }}" readonly
                                style="background-color: white;pointer-events: none;">
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Nama</label>
                            <input class="form-control" value="{{ $data->nama }}" readonly
                                style="background-color: white;pointer-events: none;">
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Alamat</label>
                            <input class="form-control" value="{{ $data->contact }}" readonly
                                style="background-color: white;pointer-events: none;">
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Kontak</label>
                            <input class="form-control" value="{{ $data->contact }}" readonly
                                style="background-color: white;pointer-events: none;">
                        </div>
                        <div class="row mt-6">
                            <div class="col-md-6">
                                <a href="/admin/pasien/delete/{{ $data->id }}" style="text-decoration: none;">
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

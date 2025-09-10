@extends('admin.layouts.app', [
    'activePage' => 'antrian',
    'subactivePage' => '',
])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="bg-light rounded p-4 mb-4" style="background-color: transparent !important;">
            <div class="d-flex justify-content-between align-items-start flex-wrap">
                <div>
                    {{-- <h4 class="fw-bold">Data Master</h4>
                    <p class="text-muted">Data Antrian</p> --}}
                </div>
                <div>
                    <input type="date" id="filterTanggal" class="form-control" style="background-color: white;"
                        onchange="location = '/admin/antrian/filter/'+this.value;" max="{{ date('Y-m-d') }}" name="tgl"
                        value="{{ date('Y-m-d', strtotime($tgl)) }}">
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-6 mb-4">
                    <a href="{{ url('admin/antrian/antri') }}" class="text-white text-decoration-none d-block">
                        <div class="d-flex align-items-center text-white p-4 rounded shadow"
                            style="background-color: skyblue;">
                            <img src="{{ asset('assets-admin/img/illustrations/people2.svg') }}" alt="Ilustrasi"
                                class="img-fluid me-3" style="height: 150px;">
                            <div>
                                <h3 class="text-white">{{ $jumlah_antri }} Orang</h3>
                                <span class="text-muted">Reservasi Antrian</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ url('admin/antrian/tunggu') }}" class="text-white text-decoration-none d-block">
                                <div class="bg-warning text-white p-3 rounded">
                                    <h5 class="mb-1">Antrian Tunggu</h5>
                                    <p class="fs-4 fw-bold mb-0">{{ $jumlah_tunggu }} Orang</p>
                                    <small>{{ $persenTungguDariReservasi }}% (Dari Antrian Reservasi)</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ url('admin/antrian/proses') }}">
                                <div class="bg-secondary text-white p-3 rounded">
                                    <h5 class="mb-1">Antrian Sedang Proses</h5>
                                    <p class="fs-4 fw-bold mb-0">{{ $jumlah_proses }} Orang</p>
                                    <small>{{ $persenProsesDariTunggu }}% (Dari Antrian Tunggu)</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ url('admin/antrian/belum_bayar') }}">
                                <div class="bg-danger text-white p-3 rounded">
                                    <h5 class="mb-1">Antrian Belum Bayar</h5>
                                    <p class="fs-4 fw-bold mb-0">{{ $jumlah_belum_bayar }} Orang</p>
                                    <small>{{ $persenBelumBayarDariMasuk }}% (Dari Antrian Masuk)</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ url('admin/antrian/selesai') }}">
                                <div class="bg-success text-white p-3 rounded text-center">
                                    <h5 class="mb-1">Antrian Selesai</h5>
                                    <p class="fs-4 fw-bold mb-0">{{ $jumlah_selesai }} Orang</p>
                                    <small>{{ $persenSelesaiDariReservasi }}% (Dari Antrian Reservasi)</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Tabel Antrian --}}
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Antrian
                        </h4>
                        @if(Auth::user()->level == 1 || Auth::user()->level == 3)
                        <a href="{{ url('/admin/antrian/add') }}" class="btn btn-primary btn-sm">
                            <i class="bx bx-add-to-queue fs-6 me-2"></i> Tambah Data
                        </a>
                        @endif
                    </div>
                    <hr class="mt-0">

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive text-nowrap">
                        <table id="dataTable" class="table table-bordered table-hover table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th class="text-center fs-6">Nama Pasien</th>
                                    <th class="text-center fs-6">Pilih Dokter</th>
                                    <th class="text-center fs-6">Keluhan</th>
                                    <th class="text-center fs-6">Status</th>
                                    {{-- <th class="text-center fs-6" width="5%">Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($antrian as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $no++ }}</td>
                                        <td class="py-2">{{ $data->nama_pasien }}</td>
                                        <td class="py-2">{{ $data->nama_dokter }}</td>
                                        <td class="py-2">{{ $data->keluhan }}</td>
                                        <td class="py-2 text-center">
                                            @if ($data->status == 'Antri')
                                                <span class="badge bg-primary">Antri</span>
                                            @elseif($data->status == 'Menunggu')
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                            @elseif($data->status == 'Proses')
                                                <span class="badge bg-info text-dark">Proses</span>
                                            @elseif($data->status == 'Belum Bayar')
                                                <span class="badge bg-danger">Belum Bayar</span>
                                            @elseif($data->status == 'Selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak Diketahui</span>
                                            @endif
                                        </td> {{-- <td class="text-center py-2 ">
                                            <a href="/admin/antrian/edit/{{ $data->id }}"
                                                class="btn btn-success btn-sm" title="Edit Data">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#data-{{ $data->id }}" title="Delete Data">
                                                <i class='bx bxs-trash'></i>
                                            </button>
                                        </td> --}}
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

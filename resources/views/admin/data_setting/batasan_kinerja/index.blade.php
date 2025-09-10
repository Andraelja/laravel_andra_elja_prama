@extends('admin.layouts.app', [
    'activePage' => 'data_setting',
    'subactivePage' => 'batasan_kinerja',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Batasan Kinerja
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Data Batasan Kinerja</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data -->
        <div class="row">
            <div class="col-xxl-12 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Batasan Kinerja
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
                                    <th class="fs-7 text-start text-wrap py-2 align-middle">#</th>
                                    <th class="fs-7 text-start text-wrap py-2 align-middle">Nama Dokter</th>
                                    <th class="fs-7 text-start text-wrap py-2 align-middle">Rata-rata Menangani Pasien</th>
                                    <th class="fs-7 text-start text-wrap py-2 align-middle">Rata-rata Total Pemasukan</th>
                                    <th class="fs-7 text-start text-wrap py-2 align-middle">Rata-rata Waktu Tindakan</th>
                                    <th class="fs-7 text-start text-wrap py-2 align-middle">Target Bulanan</th>
                                    <th class="fs-7 text-start text-wrap py-2 align-middle">Persentase Bonus</th>
                                    <th class="fs-7 text-start text-wrap py-2 align-middle">Tanggal Kontrak</th>
                                    <th class="fs-7 text-center py-2 align-middle" width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batasan_kinerja as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $loop->iteration }}</td>
                                        <td class="text-start fs-7 text-wrap py-2">{{ $data->nama }}</td>
                                        <td class="text-start fs-7 text-wrap py-2">{{ $data->total_pasien }}</td>
                                        <td class="text-start fs-7 text-wrap py-2">
                                            {{ 'Rp ' . number_format($data->total_pemasukan, 0, ',', '.') }}</td>
                                        <td class="text-start fs-7 text-wrap py-2">{{ $data->waktu_tindakan }}</td>
                                        <td class="text-start fs-7 text-wrap py-2">
                                            {{ 'Rp ' . number_format($data->target_bulanan, 0, ',', '.') }}</td>
                                        <td class="text-start fs-7 text-wrap py-2">{{ $data->persentase_bonus }}%</td>
                                        <td class="text-start fs-7 text-wrap py-2">
                                            {{ \Carbon\Carbon::parse($data->tgl_kontrak)->format('d M Y') }}</td>
                                        <td class="text-center py-2">
                                            <button class="btn btn-success btn-xs" data-bs-toggle="modal"
                                                data-bs-target="#editModal-{{ $data->id }}" title="Hapus Data">
                                                <i class='bx bxs-pencil'></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @foreach ($batasan_kinerja as $data)
                        <div class="modal fade" id="editModal-{{ $data->id }}" tabindex="-1"
                            aria-labelledby="modalLabel-{{ $data->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ url('/admin/data_setting/batasan_kinerja/update/') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-header">
                                            <h5 class="modal-title text-success" id="modalLabel-{{ $data->id }}">Edit
                                                Data Batasan Kinerja</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Dokter</label>
                                                <input type="text" class="form-control" value="{{ $data->nama }}"
                                                    readonly>
                                                <input type="hidden" name="id_dokter" value="{{ $data->id_dokter }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Rata-rata Menangani Pasien</label>
                                                <input type="number" name="total_pasien" class="form-control"
                                                    value="{{ $data->total_pasien }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Rata-rata Total Pemasukan</label>
                                                <input type="number" name="total_pemasukan" class="form-control"
                                                    value="{{ $data->total_pemasukan }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Rata-rata Waktu Tindakan</label>
                                                <input type="text" name="waktu_tindakan" class="form-control"
                                                    value="{{ $data->waktu_tindakan }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Target Bulanan</label>
                                                <input type="number" name="target_bulanan" class="form-control"
                                                    value="{{ $data->target_bulanan }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Persentase Bonus (%)</label>
                                                <input type="number" name="persentase_bonus" class="form-control"
                                                    value="{{ $data->persentase_bonus }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Kontrak</label>
                                                <input type="date" name="tgl_kontrak" class="form-control"
                                                    value="{{ $data->tgl_kontrak }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Update Data</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

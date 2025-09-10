@extends('admin.layouts.app', [
    'activePage' => 'accounting',
    'subactivePage' => 'pengeluaran',
])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Accounting
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Data Account</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="/admin/pengeluaran">Data Pengeluaran</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data Pengeluaran -->
        <div class="row">
            <div class="col-xxl-8 mb-4">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Pengeluaran
                        </h4>
                        @if (Auth::user()->level == 1 || Auth::user()->level == 3)
                            <a href="/admin/pengeluaran/add" class="btn btn-primary btn-sm d-flex align-items-center">
                                <i class="bx bx-add-to-queue fs-6 me-2"></i> Tambah Data
                            </a>
                        @endif
                    </div>
                    <hr class="mt-0">

                    <!-- Alert -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="table-responsive text-nowrap">
                        <table id="dataTable" class="table table-bordered table-hover table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%" class="text-start align-middle">#</th>
                                    <th class="text-start text-wrap align-middle fs-6">Tanggal</th>
                                    <th class="text-start text-wrap align-middle fs-6">Kategori</th>
                                    <th class="text-start text-wrap align-middle fs-6">Deskripsi</th>
                                    <th class="text-start text-wrap align-middle fs-6">Total Biaya</th>
                                    @if (Auth::user()->level == 1 || Auth::user()->level == 3)
                                        <th class="text-start text-wrap align-middle fs-6" width="5%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengeluaran as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $loop->iteration }}</td>
                                        <td class="py-2">{{ \Carbon\Carbon::parse($data->tgl)->format('d M Y') }}</td>
                                        <td class="text-start text-wrap text-wrap py-2 fs-6">{{ $data->kategori }}</td>
                                        <td class="text-start text-wrap text-wrap py-2 fs-6">{{ $data->deskripsi }}</td>
                                        <td class="text-start text-wrap py-2 fs-6">
                                            Rp {{ number_format($data->harga, 0, ',', '.') }}
                                        </td>
                                        @if (Auth::user()->level == 1 || Auth::user()->level == 3)
                                            <td class="text-center py-2 ">
                                                <a href="/admin/pengeluaran/edit/{{ $data->id }}"
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

                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="data-{{ $data->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Apakah Anda Yakin Menghapus Data Ini?</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <hr class="mb-0">
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="mb-1">Deskripsi Pengeluaran</label>
                                                            <input type="text" name="deskripsi" required
                                                                class="form-control" placeholder="Masukkan Deskripsi ....."
                                                                value="{{ $data->deskripsi }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-5">
                                                        <div class="form-group">
                                                            <label class="mb-1">Total Biaya</label>
                                                            <input type="text" name="harga" required
                                                                class="form-control" placeholder="Masukkan Harga ....."
                                                                value="{{ $data->harga }}" oninput="formatNumber(this)"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-md-6">
                                                            <a href="/admin/pengeluaran/delete/{{ $data->id }}"
                                                                class="btn btn-primary w-100">Ya</a>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatNumber(input) {
            // Menghapus semua karakter kecuali angka
            let value = input.value.replace(/\D/g, '');

            // Menambahkan format pemisah ribuan
            input.value = new Intl.NumberFormat().format(value);
        }
    </script>
@endsection

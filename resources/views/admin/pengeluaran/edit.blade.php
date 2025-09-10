@extends('admin.layouts.app', [
    'activePage' => 'accounting',
    'subactivePage' => 'pengeluaran',
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
                        <li class="breadcrumb-item"><a href="/admin/pengeluaran">Data Pengeluaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data Pengeluaran</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data Jenis -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-add-to-queue me-2"></i> Edit Data Pengeluaran
                        </h4>
                        <a href="/admin/pengeluaran" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">
                    <form action="/admin/pengeluaran/update/{{ $pengeluaran->id }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Tanggal</label>
                                    <input type="date" name="tgl" required class="form-control"
                                        value="{{ $pengeluaran->tgl }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Kategori Pengeluaran</label>
                                    <select class="form-control" name="id_kategori" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategori as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($data->id == $pengeluaran->id_kategori) selected @endif>
                                                {{ $data->kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Deskripsi Pengeluaran</label>
                                    <input type="text" name="deskripsi" required class="form-control"
                                        placeholder="Masukkan Deskripsi ....." value="{{ $pengeluaran->deskripsi }}">
                                </div>
                            </div>

                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Total Biaya</label>
                                    <input type="text" name="harga" required class="form-control"
                                        placeholder="Masukkan Harga ....." value="{{ $pengeluaran->harga }}"
                                        oninput="formatNumber(this)">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5"><i class="bx bx-save fs-5 me-2"></i> Update
                            Data</button>
                    </form>
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

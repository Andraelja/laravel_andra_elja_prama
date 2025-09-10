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
                    <i class="bx bx-book-content me-2"></i> Data Master
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/admin/dokter">Dokter</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Dokter</li>
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
                            <i class="bx bx-add-to-queue me-2"></i> Edit Data Dokter
                        </h4>
                        @if (Auth::user()->level == 1)
                            <a href="/admin/dokter" class="btn btn-primary btn-sm d-flex align-items-center">
                                <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                            </a>
                        @endif
                    </div>
                    <hr class="mt-0">
                    @if (Auth::user()->level == 1)
                        <form action="/admin/dokter/update/{{ $dokter->id }}" method="POST"
                            enctype="multipart/form-data">
                    @endif
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mb-1">Nama Dokter</label>
                                <input type="text" autofocus name="nama" required class="form-control"
                                    placeholder="Masukkan Nama Dokter ....." value="{{ $dokter->nama }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mb-1">Kontak</label>
                                <input type="text" autofocus name="contact" required class="form-control"
                                    placeholder="Masukkan contact Dokter ....." value="{{ $dokter->contact }}">
                            </div>
                        </div>
                        <div class="col-md-6 mt-5">
                            <div class="form-group">
                                <label class="mb-1">Alamat</label>
                                <input type="text" autofocus name="alamat" required class="form-control"
                                    placeholder="Masukkan alamat Dokter ....." value="{{ $dokter->alamat }}">
                            </div>
                        </div>
                        <div class="col-md-6 mt-5">
                            <div class="form-group">
                                <label class="mb-1">Gaji</label>
                                <input type="text" name="gaji" required class="form-control"
                                    placeholder="Masukkan Gaji ....." oninput="formatNumber(this)"
                                    value="{{ $dokter->gaji }}">
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

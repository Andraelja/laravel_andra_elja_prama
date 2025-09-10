@extends('admin.layouts.app', [
    'activePage' => 'master',
    'subactivePage' => 'price',
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
                        <li class="breadcrumb-item"><a href="/admin/price">Price List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Price List</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data price -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-add-to-queue me-2"></i> Edit Data Price List
                        </h4>
                        <a href="/admin/price" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">
                        <form action="/admin/price/update/{{ $price->id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-1">Nama Treatment</label>
                                    <select name="id_jenis" class="form-control" required>
                                        <option value="" disabled selected>-- Pilih Nama Treatment --</option>
                                        @foreach ($jenis as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $data->id == $price->id_jenis ? 'selected' : '' }}>
                                                {{ $data->jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Rincian</label>
                                    <input type="text" name="detail" required class="form-control"
                                        placeholder="Masukkan Rincian ....." value="{{ $price->detail }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Harga</label>
                                    <input type="text" name="harga" required class="form-control"
                                        placeholder="Masukkan Harga ....." value="{{ $price->harga }}"
                                        oninput="formatNumber(this)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Waktu Pengerjaan</label>
                                    <input type="text" name="waktu_pengerjaan" required class="form-control"
                                        placeholder="Masukkan Waktu Pengerjaan ....."
                                        value="{{ $price->waktu_pengerjaan }}">
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

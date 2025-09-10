@extends('admin.layouts.app', [
    'activePage' => 'antrian',
    'subactivePage' => '',
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
                        <li class="breadcrumb-item"><a href="/admin/antrian">Data Antrian</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Antrian</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data banner -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-add-to-queue me-2"></i> Tambah Data Reservasi Antrian
                        </h4>
                        <a href="/admin/antrian" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">

                    <form action="/admin/antrian/cek" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-sm">Nama Pasien</label>
                                    <select class="form-control select2" name="id_pasien" required>
                                        <option value="">-- Pilih Pasien --</option>
                                        @foreach ($pasien as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($antrian && $data->id === $antrian->id_pasien) selected @endif>
                                                {{ $data->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5">
                            <i class="bx bx-user-check fs-5 me-2"></i> Cek Data Pasien
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

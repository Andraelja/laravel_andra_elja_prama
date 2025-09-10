@extends('admin.layouts.app', [
    'activePage' => 'surat',
    'subactivePage' => 'surat_sakit',
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
                        <li class="breadcrumb-item"><a href="/admin/surat/surat_sakit">Surat Sakit</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Surat Sakit</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data Surat Sakit -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-add-to-queue me-2"></i> Edit Data Surat Sakit
                        </h4>
                        <a href="/admin/surat/surat_sakit" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">

                    <form action="/admin/surat/surat_sakit/update/{{ $surat_sakit->id }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor" class="mb-1">Nomor Surat</label>
                                    <input type="text" autofocus class="form-control" id="nomor" name="nomor"
                                        placeholder="Masukkan Nomor Surat ....." value="{{ $surat_sakit->nomor ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Tanggal</label>
                                    <input type="date" name="tgl" required class="form-control"
                                        value="{{ $surat_sakit->tgl ?? \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label for="id_pasien" class="mb-1">Nama Pasien</label>
                                    <select class="form-control select2" name="id_pasien" required>
                                        <option value="">-- Pilih Pasien --</option>
                                        @foreach ($pilih_pasien as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($data->id == $surat_sakit->id_pasien) selected @endif>
                                                {{ $data->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label for="id_dokter" class="mb-1">Dokter Yang Menangani</label>
                                    <select class="form-control select2" name="id_dokter" required>
                                        <option value="">-- Pilih Dokter --</option>
                                        @foreach ($pilih_dokter as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($data->id == $surat_sakit->id_dokter) selected @endif>
                                                {{ $data->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Umur</label>
                                    <input type="text" name="umur" required class="form-control"
                                        placeholder="Masukkan Umur ....." value="{{ $surat_sakit->umur ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1" for="jekel">Jenis Kelamin*</label>
                                    <select name="jekel" id="jekel" class="form-control" required>
                                        <option value="" disabled {{ !isset($surat_sakit->jekel) ? 'selected' : '' }}>
                                            -- Pilih Jenis
                                            Kelamin
                                            --</option>
                                        <option value="LAKI-LAKI"
                                            {{ ($surat_sakit->jekel ?? '') == 'LAKI-LAKI' ? 'selected' : '' }}>
                                            LAKI-LAKI</option>
                                        <option value="PEREMPUAN"
                                            {{ ($surat_sakit->jekel ?? '') == 'PEREMPUAN' ? 'selected' : '' }}>
                                            PEREMPUAN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" required class="form-control"
                                        placeholder="Masukkan Pekerjaan ....." value="{{ $surat_sakit->pekerjaan ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Diagnosa</label>
                                    <input type="text" name="diagnosa" required class="form-control"
                                        placeholder="Masukkan Diagnosa ....." value="{{ $surat_sakit->diagnosa ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Alamat</label>
                                    <input type="text" name="alamat" required class="form-control"
                                        placeholder="Masukkan Alamat ....." value="{{ $surat_sakit->alamat ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Tanggal Mulai</label>
                                    <input type="date" name="waktu_mulai" required class="form-control"
                                        value="{{ $surat_sakit->waktu_mulai ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Tanggal Berakhir</label>
                                    <input type="date" name="waktu_berakhir" required class="form-control"
                                        value="{{ $surat_sakit->waktu_berakhir ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Waktu Istirahat (Hari)</label>
                                    <input type="text" name="waktu_istirahat" required class="form-control"
                                        placeholder="Masukkan Lama Istirahat ....."
                                        value="{{ $surat_sakit->waktu_istirahat ?? '' }}">
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
    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#id').select2({
                    placeholder: "-- Pilih Nama Pasien --",
                    ajax: {
                        url: "/admin/surat/surat_sakit/add",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.id,
                                        text: `${item.id_pasien} | ${item.nama} | (${item.contact})`
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
                $('#dokter').select2({
                    placeholder: "-- Pilih Nama Dokter --",
                    ajax: {
                        url: "/admin/surat/surat_sakit/addDokter",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.id,
                                        text: `${item.nama}`
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
            });
        </script>
    @endpush
@endsection

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
                    <i class="bx bx-book-content me-2"></i> Data Master
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/admin/pasien">Pasien</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Pasien</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Form Edit Pasien -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-add-to-queue me-2"></i> Edit Data Pasien
                        </h4>
                        <a href="/admin/pasien" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">
                    <form action="/admin/pasien/update/{{ $pasien->id }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">NIK</label>
                                    <input type="text" name="nik" required class="form-control"
                                        placeholder="Masukkan NIK pasien ....." value="{{ $pasien->nik }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Nama Pasien</label>
                                    <input type="text" name="nama" required class="form-control"
                                        placeholder="Masukkan Nama pasien ....." value="{{ $pasien->nama }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label class="mb-1">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" required class="form-control"
                                        value="{{ $pasien->tanggal_lahir }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label class="mb-1">Jenis Kelamin*</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                                        <option value="LAKI-LAKI"
                                            {{ $pasien->jenis_kelamin == 'LAKI-LAKI' ? 'selected' : '' }}>LAKI-LAKI
                                        </option>
                                        <option value="PEREMPUAN"
                                            {{ $pasien->jenis_kelamin == 'PEREMPUAN' ? 'selected' : '' }}>PEREMPUAN
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label class="mb-1">Umur</label>
                                    <input type="number" name="umur" required class="form-control"
                                        value="{{ $pasien->umur }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label class="mb-1">Alamat</label>
                                    <input type="text" name="alamat" required class="form-control"
                                        value="{{ $pasien->alamat }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label class="mb-1">Kontak</label>
                                    <input type="text" name="contact" required class="form-control"
                                        value="{{ $pasien->contact }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label class="mb-1">Provinsi</label>
                                    <select name="provinsi" id="provinsi" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label class="mb-1">Kabupaten/Kota</label>
                                    <select name="kabupaten" id="kabupaten" class="form-control" disabled>
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label class="mb-1">Kecamatan</label>
                                    <select name="kecamatan" id="kecamatan" class="form-control" disabled>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="form-group">
                                    <label class="mb-1">Kelurahan</label>
                                    <select name="kelurahan" id="kelurahan" class="form-control" disabled>
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">
                            <i class="bx bx-save fs-5 me-2"></i> Update Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadKabupaten(provinceID, selectedKabupaten = null) {
                $('#kabupaten').html('<option value="">Pilih Kabupaten</option>').prop('disabled', true);
                $('#kecamatan').html('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

                if (provinceID) {
                    $.get('/admin/pasien/kabupaten', {
                        province_id: provinceID
                    }, function(data) {
                        $('#kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');
                        $.each(data, function(id, name) {
                            $('#kabupaten').append('<option value="' + id + '">' + name +
                                '</option>');
                        });
                        $('#kabupaten').prop('disabled', false);
                        if (selectedKabupaten) {
                            $('#kabupaten').val(selectedKabupaten).trigger('change');
                        }
                    });
                }
            }

            function loadKecamatan(regencyID, selectedKecamatan = null) {
                $('#kecamatan').html('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

                if (regencyID) {
                    $.get('/admin/pasien/kecamatan', {
                        regency_id: regencyID
                    }, function(data) {
                        $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
                        $.each(data, function(id, name) {
                            $('#kecamatan').append('<option value="' + id + '">' + name +
                                '</option>');
                        });
                        $('#kecamatan').prop('disabled', false);
                        if (selectedKecamatan) {
                            $('#kecamatan').val(selectedKecamatan).trigger('change');
                        }
                    });
                }
            }

            function loadKelurahan(districtID, selectedKelurahan = null) {
                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

                if (districtID) {
                    $.get('/admin/pasien/kelurahan', {
                        district_id: districtID
                    }, function(data) {
                        $('#kelurahan').empty().append('<option value="">Pilih Kelurahan</option>');
                        $.each(data, function(id, name) {
                            $('#kelurahan').append('<option value="' + id + '">' + name +
                                '</option>');
                        });
                        $('#kelurahan').prop('disabled', false);
                        if (selectedKelurahan) {
                            $('#kelurahan').val(selectedKelurahan);
                        }
                    });
                }
            }

            $('#provinsi').on('change', function() {
                const provinceID = $(this).val();
                loadKabupaten(provinceID);
            });

            $('#kabupaten').on('change', function() {
                const regencyID = $(this).val();
                loadKecamatan(regencyID);
            });

            $('#kecamatan').on('change', function() {
                const districtID = $(this).val();
                loadKelurahan(districtID);
            });
        });
    </script>
@endsection

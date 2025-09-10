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
                        <li class="breadcrumb-item active" aria-current="page">Tambah Pasien</li>
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
                            <i class="bx bx-add-to-queue me-2"></i> Tambah Data Pasien
                        </h4>
                        <a href="/admin/pasien" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
                    </div>
                    <hr class="mt-0">

                    <form action="/admin/pasien/create" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">NIK <span class="text-danger">*</span></label>
                                    <input type="text" autofocus name="nik" required
                                        class="form-control @error('nik') is-invalid @enderror"
                                        placeholder="Masukkan NIK 16 digit....." value="{{ old('nik') }}" maxlength="16"
                                        minlength="16" pattern="[0-9]{16}" id="nikInput">
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        NIK harus tepat 16 digit angka.
                                        <span id="nikCounter" class="text-info">0/16</span>
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">Nama Pasien</label>
                                    <input type="text" autofocus name="nama" required class="form-control"
                                        placeholder="Masukkan Nama pasien .....">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1" for="jenis_kelamin">Jenis Kelamin*</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                        <option value="LAKI-LAKI">LAKI-LAKI</option>
                                        <option value="PEREMPUAN">PEREMPUAN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Umur</label>
                                    <input type="number" name="umur" required class="form-control"
                                        placeholder="Masukkan umur pasien .....">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Alamat</label>
                                    <input type="text" name="alamat" required class="form-control"
                                        placeholder="Masukkan alamat pasien .....">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1">Kontak</label>
                                    <input type="text" name="contact" required class="form-control"
                                        placeholder="Masukkan kontak pasien .....">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1" for="provinsi">Provinsi</label>
                                    <select name="provinsi" id="provinsi" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1" for="kabupaten">Kabupaten/Kota</label>
                                    <select name="kabupaten" id="kabupaten" class="form-control" disabled>
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group">
                                    <label class="mb-1" for="kecamatan">Kecamatan</label>
                                    <select name="kecamatan" id="kecamatan" class="form-control" disabled>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                                <div class="form-group">
                                    <label class="mb-1" for="kelurahan">Kelurahan</label>
                                    <select name="kelurahan" id="kelurahan" class="form-control" disabled>
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5">
                            <i class="bx bx-save fs-5 me-2"></i> Tambah Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            const rolePrefix = 'admin';

            $('#nikInput').on('input', function() {
                let value = $(this).val();

                value = value.replace(/[^0-9]/g, '');

                if (value.length > 16) {
                    value = value.substring(0, 16);
                }

                $(this).val(value);

                const count = value.length;
                $('#nikCounter').text(count + '/16');

                if (count === 16) {
                    $('#nikCounter').removeClass('text-info text-warning text-danger').addClass(
                        'text-success');
                } else if (count > 10) {
                    $('#nikCounter').removeClass('text-info text-success text-danger').addClass(
                        'text-warning');
                } else if (count > 0) {
                    $('#nikCounter').removeClass('text-success text-warning text-danger').addClass(
                        'text-info');
                } else {
                    $('#nikCounter').removeClass('text-success text-warning text-danger').addClass(
                        'text-info');
                }

                if (count === 16) {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                } else if (count > 0) {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-valid is-invalid');
                }
            });

            $('#formPasien').on('submit', function(e) {
                const nikValue = $('#nikInput').val();

                if (nikValue.length !== 16) {
                    e.preventDefault();
                    alert('NIK harus tepat 16 digit!');
                    $('#nikInput').focus();
                    return false;
                }

                if (!/^[0-9]{16}$/.test(nikValue)) {
                    e.preventDefault();
                    alert('NIK harus berupa 16 digit angka!');
                    $('#nikInput').focus();
                    return false;
                }
            });

            $('#provinsi').on('change', function() {
                var provinceID = $(this).val();
                $('#kabupaten').html('<option value="">Pilih Kabupaten</option>').prop('disabled', true);
                $('#kecamatan').html('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

                if (provinceID) {
                    $.get('/' + rolePrefix + '/pasien/kabupaten', {
                        province_id: provinceID
                    }, function(data) {
                        $('#kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');
                        $.each(data, function(id, name) {
                            $('#kabupaten').append('<option value="' + id + '">' + name +
                                '</option>');
                        });
                        $('#kabupaten').prop('disabled', false);
                    });
                }
            });

            $('#kabupaten').on('change', function() {
                var regencyID = $(this).val();
                $('#kecamatan').html('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

                if (regencyID) {
                    $.get('/' + rolePrefix + '/pasien/kecamatan', {
                        regency_id: regencyID
                    }, function(data) {
                        $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
                        $.each(data, function(id, name) {
                            $('#kecamatan').append('<option value="' + id + '">' + name +
                                '</option>');
                        });
                        $('#kecamatan').prop('disabled', false);
                    });
                }
            });

            $('#kecamatan').on('change', function() {
                var districtID = $(this).val();
                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

                if (districtID) {
                    $.get('/' + rolePrefix + '/pasien/kelurahan', {
                        district_id: districtID
                    }, function(data) {
                        $('#kelurahan').empty().append('<option value="">Pilih Kelurahan</option>');
                        $.each(data, function(id, name) {
                            $('#kelurahan').append('<option value="' + id + '">' + name +
                                '</option>');
                        });
                        $('#kelurahan').prop('disabled', false);
                    });
                }
            });

            if ($('#provinsi').val()) {
                $('#provinsi').trigger('change');
            }
        });
    </script>
@endsection

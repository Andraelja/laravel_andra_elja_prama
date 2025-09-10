@extends('admin.layouts.app', [
    'activePage' => 'setting',
    'subactivePage' => 'batasan_antrian',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Batasan Antrian
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Data Batasan Antrian</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Data batasanTanggal -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Batasan Reservasi Antrian Tanggal Tertentu
                        </h4>
                        @if (Auth::user()->level == 1)
                            <button type="button" class="btn btn-primary btn-sm d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#modalTambahDataBawaan">
                                <i class="bx bx-add-to-queue fs-6 me-2"></i> Tambah Data
                            </button>
                        @endif
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
                        <table id="dataTableTanggal" class="table table-bordered table-hover table-striped">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="fs-6 text-start py-2 text-wrap align-middle">#</th>
                                    <th class="fs-6 text-start py-2 text-wrap align-middle">Nama Cabang</th>
                                    <th class="fs-6 text-start py-2 text-wrap align-middle">Tanggal</th>
                                    <th class="fs-6 text-start py-2 text-wrap align-middle">Limit Reservasi Antrian Perjam
                                    </th>
                                    @if (Auth::user()->level == 1)
                                        <th class="fs-6 text-center py-2  text-wrap align-middle" width="5%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batasanTanggal as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $loop->iteration }}</td>
                                        <td class="py-2 text-wrap">{{ $data->nama_cabang }}</td>
                                        <td class="py-2 text-wrap">
                                            {{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                                        <td class="py-2 text-wrap">{{ $data->batasan }}</td>
                                        @if (Auth::user()->level == 1)
                                            <td class="text-center py-2 ">
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModalBawaan-{{ $data->id_batasan }}"
                                                    title="Edit Data">
                                                    <i class='bx bx-edit'></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#data-{{ $data->id_batasan }}" title="Delete Data">
                                                    <i class='bx bxs-trash'></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- List Data batasanHari -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Batasan Reservasi Antrian Hari Tertentu
                        </h4>
                        @if (Auth::user()->level == 1)
                            <button type="button" class="btn btn-primary btn-sm d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#modalTambahDataBawaan">
                                <i class="bx bx-add-to-queue fs-6 me-2"></i> Tambah Data
                            </button>
                        @endif
                    </div>
                    <hr class="mt-0">
                    <div class="table-responsive text-nowrap">
                        <table id="dataTableHari" class="table table-bordered table-hover table-striped">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="fs-6 text-start py-2 text-wrap align-middle">#</th>
                                    <th class="fs-6 text-start py-2 text-wrap align-middle">Nama Cabang</th>
                                    <th class="fs-6 text-start py-2 text-wrap align-middle">Hari</th>
                                    <th class="fs-6 text-start py-2 text-wrap align-middle">Limit Reservasi Antrian Perjam
                                    </th>
                                    @if (Auth::user()->level == 1)
                                        <th class="fs-6 text-center py-2  text-wrap align-middle" width="5%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batasanHari as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $loop->iteration }}</td>
                                        <td class="py-2 text-wrap">{{ $data->nama_cabang }}</td>
                                        <td class="py-2 text-wrap">{{ $data->isi }}</td>
                                        <td class="py-2 text-wrap">{{ $data->batasan }}</td>
                                        @if (Auth::user()->level == 1)
                                            <td class="text-center py-2 ">
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModalBawaan-{{ $data->id_batasan }}"
                                                    title="Edit Data">
                                                    <i class='bx bx-edit'></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#data-{{ $data->id_batasan }}" title="Delete Data">
                                                    <i class='bx bxs-trash'></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- List Data batasanBawaan -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Batasan Reservasi Antrian Bawaan
                        </h4>
                        @if (Auth::user()->level == 1)
                            <button type="button" class="btn btn-primary btn-sm d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#modalTambahDataBawaan">
                                <i class="bx bx-add-to-queue fs-6 me-2"></i> Tambah Data
                            </button>
                        @endif
                    </div>
                    <hr class="mt-0">
                    <div class="table-responsive text-nowrap">
                        <table id="dataTableBawaan" class="table table-bordered table-hover table-striped">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="fs-6 text-start py-2 text-wrap align-middle">#</th>
                                    <th class="fs-6 text-start py-2 text-wrap align-middle">Nama Cabang</th>
                                    <th class="fs-6 text-start py-2 text-wrap align-middle">Limit Reservasi Antrian Perjam
                                    </th>
                                    @if (Auth::user()->level == 1)
                                        <th class="fs-6 text-center py-2  text-wrap align-middle" width="5%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batasanBawaan as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $loop->iteration }}</td>
                                        <td class="py-2 text-wrap">{{ $data->nama_cabang }}</td>
                                        <td class="py-2 text-wrap">{{ $data->batasan }}</td>
                                        @if (Auth::user()->level == 1)
                                            <td class="text-center py-2 ">
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModalBawaan-{{ $data->id_batasan }}"
                                                    title="Edit Data">
                                                    <i class='bx bx-edit'></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#data-{{ $data->id_batasan }}" title="Delete Data">
                                                    <i class='bx bxs-trash'></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data Tanggal Tertentu -->
    <div class="modal fade" id="modalTambahDataTanggal" tabindex="-1" aria-labelledby="modalTambahDataTanggalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-m">
            @if (Auth::user()->level == 1)
                <form action="{{ url('admin/data_setting/batasan_antrian/create') }}" method="POST">
                @elseif(Auth::user()->level == 2)
                    <form action="{{ url('admin_cabang/data_setting/batasan_antrian/create') }}" method="POST">
            @endif
            @csrf
            <input type="hidden" name="type" value="tanggal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="modalTambahDataTanggalLabel">Tambah Data Batasan Antrian
                        Tanggal Tertentu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Cabang</label>
                        @if(Auth::user()->level == 2)
                        <input type="text" class="form-control" value="{{ $adminCabangLogin->nama }}" readonly>
                        @else
                        <select name="id_admin" id="id_admin_tanggal" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Cabang --</option>
                            @foreach ($cabang as $data)
                                <option value="{{ $data->id_admin }}">{{ $data->nama_cabang }}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="mb-1">Tanggal</label>
                        <input type="date" name="created_at" required class="form-control"
                            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label for="batasan_tanggal" class="form-label">Limit Reservasi Antrian Per Jam</label>
                        <input type="number" name="batasan" id="batasan_tanggal" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Data Hari Tertentu -->
    <div class="modal fade" id="modalTambahDataHari" tabindex="-1" aria-labelledby="modalTambahDataHariLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-m">
            @if (Auth::user()->level == 1)
                <form action="{{ url('admin/data_setting/batasan_antrian/create') }}" method="POST">
                @elseif(Auth::user()->level == 2)
                    <form action="{{ url('admin_cabang/data_setting/batasan_antrian/create') }}" method="POST">
            @endif
            @csrf
            <input type="hidden" name="type" value="hari">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="modalTambahDataHariLabel">Tambah Data Batasan Antrian
                        Hari Tertentu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Field -->
                    <div class="mb-3">
                        <label>Cabang</label>
                        @if(Auth::user()->level == 2)
                        <input type="text" class="form-control" value="{{ $adminCabangLogin->nama }}" readonly>
                        @else
                        <select name="id_admin" id="id_admin_tanggal" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Cabang --</option>
                            @foreach ($cabang as $data)
                                <option value="{{ $data->id_admin }}">{{ $data->nama_cabang }}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="mb-1">Hari</label>
                        <select name="isi" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Hari --</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="batasan" class="form-label">Limit Reservasi Antrian Per Jam</label>
                        <input type="number" name="batasan" id="batasan_hari" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Data Bawaan -->
    <div class="modal fade" id="modalTambahDataBawaan" tabindex="-1" aria-labelledby="modalTambahDataBawaanLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-m">
            <form action="{{ url('admin/data_setting/batasan_antrian/create') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="bawaan">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="modalTambahDataBawaanLabel">Tambah Data Batasan Antrian
                            Bawaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Field -->
                        <div class="mb-3">
                            <label for="id_admin_bawaan" class="form-label">Nama Cabang</label>
                            <select name="id_admin" id="id_admin_bawaan" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Cabang --</option>
                                @foreach ($cabang as $data)
                                    <option value="{{ $data->id_admin }}">{{ $data->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="batasan_bawaan" class="form-label">Limit Reservasi Antrian Per Jam</label>
                            <input type="number" name="batasan" id="batasan_bawaan" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal edit for batasanTanggal --}}
    @foreach ($batasanTanggal as $data)
        <!-- Modal Edit -->
        <div class="modal fade" id="editModalTanggal-{{ $data->id_batasan }}" tabindex="-1"
            aria-labelledby="editModalLabel-{{ $data->id_batasan }}" aria-hidden="true">
            <div class="modal-dialog">
                @if (Auth::user()->level == 1)
                    <form action="{{ url('admin/data_setting/batasan_antrian/update/' . $data->id_batasan) }}"
                        method="POST">
                    @elseif(Auth::user()->level == 2)
                        <form action="{{ url('admin_cabang/data_setting/batasan_antrian/update/' . $data->id_batasan) }}"
                            method="POST">
                @endif
                @csrf
                @method('POST')
                <input type="hidden" name="type" value="tanggal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="editModalLabel-{{ $data->id_batasan }}">
                            Edit Batasan Antrian
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="id_admin" class="form-label">Nama Cabang</label>
                        
                            @if(Auth::user()->level == 1)
                                <select name="id_admin" class="form-control" required>
                                    <option value="">-- Pilih Cabang --</option>
                                    @foreach ($cabang as $c)
                                        <option value="{{ $c->id_admin }}" {{ $c->id_admin == $data->id_admin ? 'selected' : '' }}>
                                            {{ $c->nama_cabang }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <input type="hidden" name="id_admin" value="{{ $data->id_admin }}">
                                <input type="text" class="form-control" value="{{ $data->nama_cabang }}" disabled>
                            @endif
                        </div>    
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="created_at" class="form-control"
                                value="{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="batasan" class="form-label">Limit Reservasi Per Jam</label>
                            <input type="number" name="batasan" class="form-control" value="{{ $data->batasan }}"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- Modal edit for batasanHari --}}
    @foreach ($batasanHari as $data)
        <!-- Modal Edit -->
        <div class="modal fade" id="editModal-{{ $data->id_batasan }}" tabindex="-1"
            aria-labelledby="editModalLabel-{{ $data->id_batasan }}" aria-hidden="true">
            <div class="modal-dialog">
                @if(Auth::user()->level == 1)
                <form action="{{ url('admin/data_setting/batasan_antrian/update/' . $data->id_batasan) }}" method="POST">
                @elseif(Auth::user()->level == 2)
                <form action="{{ url('admin_cabang/data_setting/batasan_antrian/update/' . $data->id_batasan) }}" method="POST">
                @endif
                    @csrf
                    @method('POST')
                    <input type="hidden" name="type" value="hari">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="editModalLabel-{{ $data->id_batasan }}">
                                Edit Batasan Antrian
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_admin" class="form-label">Nama Cabang</label>
                            
                                @if(Auth::user()->level == 1)
                                    <select name="id_admin" class="form-control" required>
                                        <option value="">-- Pilih Cabang --</option>
                                        @foreach ($cabang as $c)
                                            <option value="{{ $c->id_admin }}" {{ $c->id_admin == $data->id_admin ? 'selected' : '' }}>
                                                {{ $c->nama_cabang }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="hidden" name="id_admin" value="{{ $data->id_admin }}">
                                    <input type="text" class="form-control" value="{{ $data->nama_cabang }}" disabled>
                                @endif
                            </div>                            
                            <div class="mb-3">
                                <label class="mb-1">Hari</label>
                                <select name="isi" class="form-select" required>
                                    <option disabled selected>-- Pilih Hari --</option>
                                    <option value="Senin" {{ $data->isi == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ $data->isi == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ $data->isi == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ $data->isi == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ $data->isi == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ $data->isi == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                    <option value="Minggu" {{ $data->isi == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="batasan" class="form-label">Limit Reservasi Per Jam</label>
                                <input type="number" name="batasan" class="form-control" value="{{ $data->batasan }}"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- Modal edit for batasanBawaan --}}
    @foreach ($batasanBawaan as $data)
        <!-- Modal Edit -->
        <div class="modal fade" id="editModalBawaan-{{ $data->id_batasan }}" tabindex="-1"
            aria-labelledby="editModalBawaanLabel-{{ $data->id_batasan }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ url('admin/data_setting/batasan_antrian/update/' . $data->id_batasan) }}"
                    method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="type" value="bawaan">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="editModalBawaanLabel-{{ $data->id_batasan }}">
                                Edit Batasan Antrian Bawaan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_admin_bawaan" class="form-label">Nama Cabang</label>
                                <select name="id_admin" id="id_admin_bawaan" class="form-select" required>
                                    <option disabled selected>-- Pilih Cabang --</option>
                                    @foreach ($cabang as $c)
                                        <option value="{{ $c->id_admin }}"
                                            {{ $c->id_admin == $data->id_admin ? 'selected' : '' }}>
                                            {{ $c->nama_cabang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="batasan_bawaan" class="form-label">Limit Reservasi Per Jam</label>
                                <input type="number" name="batasan" id="batasan_bawaan" class="form-control"
                                    value="{{ $data->batasan }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    @foreach ($batasanTanggal as $data)
        <!-- Modal Hapus -->
        <div class="modal fade" id="data-{{ $data->id_batasan }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apakah Anda Yakin Menghapus Data Ini?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <hr class="mb-0">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Nama Cabang</label>
                            <input class="form-control" value="{{ $data->nama_cabang }}" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label>Tanggal</label>
                            <input class="form-control"
                                value="{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d') }}" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="batasan" class="form-label">Limit Reservasi Per Jam</label>
                            <input type="number" name="batasan" class="form-control" value="{{ $data->batasan }}"
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @if (Auth::user()->level == 1)
                                    <a href="/admin/data_setting/batasan_antrian/delete/{{ $data->id_batasan }}"
                                        class="btn btn-primary w-100">Ya</a>
                                @elseif(Auth::user()->level == 2)
                                    <a href="/admin_cabang/data_setting/batasan_antrian/delete/{{ $data->id_batasan }}"
                                        class="btn btn-primary w-100">Ya</a>
                                @endif
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

    @foreach ($batasanHari as $data)
        <!-- Modal Hapus -->
        <div class="modal fade" id="data-{{ $data->id_batasan }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apakah Anda Yakin Menghapus Data Ini?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <hr class="mb-0">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Nama Cabang</label>
                            <input class="form-control" value="{{ $data->nama_cabang }}" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label>Hari</label>
                            <input class="form-control" value="{{ $data->isi }}" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="batasan" class="form-label">Limit Reservasi Per Jam</label>
                            <input type="number" name="batasan" class="form-control" value="{{ $data->batasan }}"
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @if (Auth::user()->level == 1)
                                    <a href="/admin/data_setting/batasan_antrian/delete/{{ $data->id_batasan }}"
                                        class="btn btn-primary w-100">Ya</a>
                                @elseif(Auth::user()->level == 2)
                                    <a href="/admin_cabang/data_setting/batasan_antrian/delete/{{ $data->id_batasan }}"
                                        class="btn btn-primary w-100">Ya</a>
                                @endif
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

    @foreach ($batasanBawaan as $data)
        <!-- Modal Hapus -->
        <div class="modal fade" id="data-{{ $data->id_batasan }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apakah Anda Yakin Menghapus Data Ini?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <hr class="mb-0">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Nama Cabang</label>
                            <input class="form-control" value="{{ $data->nama_cabang }}" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="batasan" class="form-label">Limit Reservasi Per Jam</label>
                            <input type="number" name="batasan" class="form-control" value="{{ $data->batasan }}"
                                readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="/admin/data_setting/batasan_antrian/delete/{{ $data->id_batasan }}"
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
@endsection

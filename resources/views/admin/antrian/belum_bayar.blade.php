@extends('admin.layouts.app', [
    'activePage' => 'antrian',
    'subactivePage' => 'belum_bayar',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Belum Bayar
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Data Belum Bayar</li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/admin/antrian">Data Belum Bayar</a>
                        </li>
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
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Belum Bayar
                        </h4>
                        <a href="/admin/antrian/" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
                        </a>
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
                                    <th width="5%" class="fs-6 text-center py-2">#</th>
                                    <th class="fs-6 text-center py-2">Nama Pasien</th>
                                    <th class="fs-6 text-center py-2">Keluhan</th>
                                    <th class="fs-6 text-center py-2">Nama Dokter</th>
                                    <th class="fs-6 text-center py-2">Total Bayar</th>
                                    <th class="fs-6 text-center py-2">Status</th>
                                    <th class="fs-6 text-center py-2" width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($antrian as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $no++ }}</td>
                                        <td class="py-2 text-wrap">{{ $data->nama_pasien }}</td>
                                        <td class="py-2 text-wrap">{{ $data->keluhan ?? '-' }}</td>
                                        <td class="py-2 text-wrap">{{ $data->nama_dokter ?? '-' }}</td>
                                        <td class="py-2 text-wrap">Rp {{ number_format($data->total_bayar, 0, ',', '.') }}
                                        </td>
                                        <td class="py-2 "><span class="badge bg-danger">{{ $data->status }}</span></td>
                                        <td class="text-center py-2">
                                            <form action="{{ route('admin.antrian.updateStatus', $data->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalBayar{{ $data->id }}">
                                                    <i class="bx bx-wallet"></i>
                                                </button>
                                                <a href="{{ route('admin.antrian.rekamMedisIndex', ['id_pasien' => $data->id_pasien]) }}"
                                                    class="btn btn-success btn-sm me-1" title="Rekam Medis">
                                                    <i class="bx bx-id-card"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($antrian as $item)
        <div class="modal fade" id="modalBayar{{ $item->id }}" tabindex="-1"
            aria-labelledby="modalBayarLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.antrian.pembayaran', $item->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_antrian" value="{{ $item->id }}">
                        <input type="hidden" name="id_pasien" value="{{ $item->id_pasien }}">
                        <input type="hidden" name="total" value="{{ $item->total_bayar }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalBayarLabel{{ $item->id }}">Pilih Metode Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-1">Nama Pasien</label>
                                            <input class="form-control" value="{{ $item->nama_pasien }}" readonly
                                                style="background-color: white; pointer-events: none;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-1">Total Bayar</label>
                                            <input id="totalBayar" type="text" class="form-control"
                                                value="{{ $item->total_bayar }}" readonly
                                                style="background-color: white; pointer-events: none;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-5">
                                            <label class="mb-1">Metode Pembayaran</label>
                                            <select name="id_metode" class="form-control" required>
                                                <option value="">-- Pilih Metode --</option>
                                                @foreach ($metode_pembayaran as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nama }} | {{ $item->nomor_rekening }} |
                                                        {{ $item->atas_nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-5">
                                            <label class="mb-1">Uang Bayar</label>
                                            <input type="text" id="uangBayar{{ $item->id }}" class="form-control"
                                                placeholder="Masukkan Uang Bayar..."
                                                oninput="formatAndHitung(this, {{ $item->id }})">
                                            <small id="warning{{ $item->id }}" class="text-danger d-none">Uang anda
                                                belum cukup!</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-5">
                                            <label class="mb-1">Kembalian</label>
                                            <input type="text" id="kembalian" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" id="btnBayar{{ $item->id }}" class="btn btn-primary"
                                disabled>Konfirmasi Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function formatNumber(input) {
            // Menghapus semua karakter kecuali angka
            let value = input.value.replace(/\D/g, '');

            // Menambahkan format pemisah ribuan
            input.value = new Intl.NumberFormat().format(value);
        }
    </script>

    <script>
        function formatAndHitung(input, id) {
            let value = input.value.replace(/\D/g, '');
            if (value) {
                input.value = new Intl.NumberFormat('id-ID').format(value);
            } else {
                input.value = '';
            }

            const totalBayarInput = document.getElementById('totalBayar');
            const kembalianInput = document.getElementById('kembalian');
            const warning = document.getElementById('warning' + id);
            const btnBayar = document.getElementById('btnBayar' + id);

            const uangBayar = parseInt(value) || 0;
            const totalBayar = parseInt(totalBayarInput.value) || 0;

            let kembalian = uangBayar - totalBayar;
            if (kembalian < 0) kembalian = 0;

            kembalianInput.value = 'Rp ' + kembalian.toLocaleString('id-ID');

            if (uangBayar < totalBayar) {
                warning.classList.remove('d-none');
                btnBayar.disabled = true;
            } else {
                warning.classList.add('d-none');
                btnBayar.disabled = false;
            }
        }
    </script>
@endsection

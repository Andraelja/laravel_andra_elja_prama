@extends('admin.layouts.app', [
    'activePage' => 'rumah_sakit',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Rumah Sakit
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Data Rumah Sakit</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="/admin/rumah_sakit">Data Rumah Sakit</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Rumah Sakit
                        </h4>
                        <a href="/admin/rumah_sakit/add" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bx bx-add-to-queue fs-6 me-2"></i> Tambah Data
                        </a>
                    </div>
                    <hr class="mt-0">
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
                                    <th class="fs-6 text-center py-2">Nama Rumah Sakit</th>
                                    <th class="fs-6 text-center py-2">Alamat</th>
                                    <th class="fs-6 text-center py-2">Email</th>
                                    <th class="fs-6 text-center py-2">Telepon</th>
                                    <th class="fs-6 text-center py-2" width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($rumah_sakit as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $no++ }}</td>
                                        <td class="py-2">{{ $data->nama_rumah_sakit }}</td>
                                        <td class="py-2">{{ $data->alamat }}</td>
                                        <td class="py-2">{{ $data->email }}</td>
                                        <td class="py-2">{{ $data->no_telp }}</td>
                                        <td class="text-center py-2">
                                            <a href="/admin/rumah_sakit/edit/{{ $data->id }}"
                                                class="btn btn-success btn-sm" title="Edit Data">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <button type="button" 
                                                class="btn btn-danger btn-sm btn-delete"
                                                data-id="{{ $data->id }}" 
                                                title="Delete Data">
                                                <i class='bx bxs-trash'></i>
                                            </button>
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.btn-delete').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    let id = this.getAttribute('data-id');

                    if (confirm('Yakin ingin menghapus data ini?')) {
                        fetch(`/admin/rumah_sakit/delete/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                alert(data.message);
                                location.reload();
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(() => alert('Terjadi kesalahan, coba lagi!'));
                    }
                });
            });
        });
    </script>
@endsection

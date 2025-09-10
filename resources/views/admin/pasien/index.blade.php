@extends('admin.layouts.app', [
    'activePage' => 'pasien',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Pasien
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Data Pasien</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="/admin/pasien">Data Pasien</a>
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
                            <i class="bx bx-list-ul fs-3 me-2"></i> List Data Pasien
                        </h4>
                        <a href="/admin/pasien/add" class="btn btn-primary btn-sm d-flex align-items-center">
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
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="filterRumahSakit" class="form-label">Filter Rumah Sakit</label>
                            <select id="filterRumahSakit" class="form-select">
                                <option value="all">Semua Rumah Sakit</option>
                                @foreach ($rumah_sakit as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_rumah_sakit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table id="dataTable" class="table table-bordered table-hover table-striped">
                            <thead class="bg-primary">
                                <tr>
                                    <th width="5%" class="fs-6 text-center py-2">#</th>
                                    <th class="fs-6 text-center py-2">Nama Pasien</th>
                                    <th class="fs-6 text-center py-2">Alamat</th>
                                    <th class="fs-6 text-center py-2">Telepon</th>
                                    <th class="fs-6 text-center py-2">Rumah Sakit</th>
                                    <th class="fs-6 text-center py-2" width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($pasien as $data)
                                    <tr>
                                        <td class="text-center py-2">{{ $no++ }}</td>
                                        <td class="py-2">{{ $data->nama_pasien }}</td>
                                        <td class="py-2">{{ $data->alamat }}</td>
                                        <td class="py-2">{{ $data->no_telp }}</td>
                                        <td class="py-2">{{ $data->nama_rumah_sakit }}</td>
                                        <td class="text-center py-2">
                                            <a href="/admin/pasien/edit/{{ $data->id }}" class="btn btn-success btn-sm"
                                                title="Edit Data">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                data-id="{{ $data->id }}" title="Delete Data">
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
        document.addEventListener("click", e => {
            if (e.target.closest(".btn-delete")) {
                let id = e.target.closest(".btn-delete").dataset.id;
                if (confirm("Yakin hapus data ini?")) {
                    fetch(`/admin/pasien/delete/${id}`, {
                            method: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(r => r.json())
                        .then(res => {
                            alert(res.message);
                            if (res.status === 'success') location.reload();
                        });
                }
            }
        });

        document.getElementById("filterRumahSakit").addEventListener("change", function() {
            fetch(`/admin/pasien/filter/${this.value}`)
                .then(r => r.json())
                .then(res => {
                    let tbody = document.querySelector("#dataTable tbody");
                    tbody.innerHTML = "";
                    if (res.status === "success" && res.data.length) {
                        res.data.forEach((p, i) => {
                            tbody.innerHTML += `
                            <tr>
                                <td class="text-center">${i+1}</td>
                                <td>${p.nama_pasien}</td>
                                <td>${p.alamat}</td>
                                <td>${p.no_telp}</td>
                                <td>${p.nama_rumah_sakit}</td>
                                <td class="text-center">
                                    <a href="/admin/pasien/edit/${p.id}" class="btn btn-success btn-sm"><i class="bx bx-edit"></i></a>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="${p.id}"><i class="bx bxs-trash"></i></button>
                                </td>
                            </tr>`;
                        });
                    } else {
                        tbody.innerHTML = `<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>`;
                    }
                });
        });
    </script>
@endsection

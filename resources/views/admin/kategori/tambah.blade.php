@extends('admin.layouts.app', [
'activePage' => 'master', 'subactivePage' => 'kategori',
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
               <li class="breadcrumb-item"><a href="/admin/kategori">Kategori Pengeluaran</a></li>
               <li class="breadcrumb-item active" aria-current="page">Kategori Pengeluaran</li>
            </ol>
         </nav>
      </div>
   </div>

   <!-- List Data kategori -->
   <div class="row">
      <div class="col-xxl-8 mb-4 order-0">
         <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
               <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                  <i class="bx bx-add-to-queue me-2"></i> Tambah Data Kategori Pengeluaran
               </h4>
               <a href="/admin/kategori" class="btn btn-primary btn-sm d-flex align-items-center">
                  <i class="bx bxs-chevrons-left fs-6 me-2"></i> Back
               </a>
            </div>
            <hr class="mt-0">
            <form action="/admin/kategori/create" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label class="mb-1">Kategori Pengeluaran</label>
                     <input type="text" autofocus name="kategori" required class="form-control" placeholder="Masukkan Kategori Pengeluaran .....">
                  </div>
               </div>
            </div>
            <button type="submit" class="btn btn-primary mt-5"><i class="bx bx-save fs-5 me-2"></i> Tambah Data</button>               
         </form>
         </div>
      </div>
   </div>
</div>
@endsection
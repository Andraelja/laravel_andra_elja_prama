@extends('admin.layouts.app', [
    'activePage' => 'dashboard',
    'subactivePage' => '',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-home-smile me-2"></i> Dashboard
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="/admin/home">Dashboard</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <h5 class="mb-1 text-dark d-flex align-items-center">
                Selamat datang, {{ $user_login->name }} !
            </h5>
        </div>
    </div>
@endsection

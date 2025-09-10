@auth
    <!doctype html>

    <html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="{{ url('assets-admin') }}/"
        data-template="vertical-menu-template-free">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>Parktek Dokter Gigi Betri Sari</title>

        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ url('assets-admin') }}/img/favicon/logo-baru.png" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet" />

        <link rel="stylesheet" href="{{ url('assets-admin') }}/vendor/fonts/iconify-icons.css" />

        <!-- Core CSS -->
        <!-- build:css assets/vendor/css/theme.css  -->

        <link rel="stylesheet" href="{{ url('assets-admin') }}/vendor/css/core.css" />
        <link rel="stylesheet" href="{{ url('assets-admin') }}/css/demo.css" />

        <!-- Vendors CSS -->

        <link rel="stylesheet" href="{{ url('assets-admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

        <!-- endbuild -->

        <link rel="stylesheet" href="{{ url('assets-admin') }}/vendor/libs/apex-charts/apex-charts.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

        <!-- Page CSS -->

        <!-- Helpers -->
        <script src="{{ url('assets-admin') }}/vendor/js/helpers.js"></script>
        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

        <script src="{{ url('assets-admin') }}/js/config.js"></script>

        <!-- CSS DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <style>
            th {
                text-transform: none !important;
                color: white !important;
                font-weight: bold;
            }
        </style>

    </head>

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->

                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    <div class="app-brand demo">
                        <a href="/" class="app-brand-link">
                            <a href="/" class="app-brand-link gap-2">
                                <img src="{{ url('assets-admin/img/betri-sari.png') }}" width="100%">
                            </a>
                        </a>

                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                            <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
                        </a>
                    </div>

                    <div class="menu-divider mt-0"></div>

                    <div class="menu-inner-shadow"></div>

                    @if (Auth::user()->level == 1)
                        <ul class="menu-inner py-1">
                            <!-- Dashboards -->
                            <li class="menu-item @if ($activePage == 'dashboard') active @endif">
                                <a href="/admin/home" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-home-smile"></i>
                                    <div class="text-truncate" data-i18n="Basic">Dashboards</div>
                                </a>
                            </li>
                            <!-- Data Master -->
                            <li class="menu-item @if ($activePage == 'master') active open @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-book-content"></i>
                                    <div class="text-truncate" data-i18n="Layouts">Data Master</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item @if ($subactivePage == 'jenis') active @endif">
                                        <a href="/admin/jenis" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without menu">Jenis Therapi</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'price') active @endif">
                                        <a href="/admin/price" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without navbar">Price List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'kategori') active @endif">
                                        <a href="/admin/kategori" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Kategori Pengeluaran</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'metode_pembayaran') active @endif">
                                        <a href="/admin/metode_pembayaran" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Metode Pembayaran</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- Data Account --}}
                            <li class="menu-item @if ($activePage == 'account') active open @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-user"></i>
                                    <div class="text-truncate" data-i18n="Layouts">Data Account</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item @if ($subactivePage == 'dokter') active @endif">
                                        <a href="/admin/dokter" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without menu">Dokter</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'resepsionis') active @endif">
                                        <a href="/admin/resepsionis" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without menu">Resepsionis</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- Data Pengeluaran --}}
                            <li class="menu-item @if ($activePage == 'accounting') active open @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-coin-stack"></i>
                                    <div class="text-truncate" data-i18n="Layouts">Data Accounting</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item @if ($subactivePage == 'pengeluaran') active @endif">
                                        <a href="/admin/pengeluaran" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without menu">Data Pengeluaran</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item @if ($activePage == 'pasien') active @endif">
                                <a href="/admin/pasien" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-card"></i>
                                    <div class="text-truncate" data-i18n="Basic">Data Pasien</div>
                                </a>
                            </li>
                            <li class="menu-item @if ($activePage == 'antrian') active @endif">
                                <a href="/admin/antrian" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-group"></i>
                                    <div class="text-truncate" data-i18n="Basic">Data Antrian</div>
                                </a>
                            </li>
                            <li class="menu-item @if ($activePage == 'rekam_medis') active @endif">
                                <a href="/admin/rekam_medis" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-heart-circle"></i>
                                    <div class="text-truncate" data-i18n="Basic">Data Rekam Medis</div>
                                </a>
                            </li>
                            <li class="menu-item @if ($activePage == 'surat') active open @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-envelope"></i>
                                    <div class="text-truncate" data-i18n="Layouts">Data Surat Menyurat</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item @if ($subactivePage == 'surat_sakit') active @endif">
                                        <a href="/admin/surat/surat_sakit" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Surat Sakit</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'pengantar_rontgen') active @endif">
                                        <a href="/admin/surat/pengantar_rontgen" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Surat Pengantar Rontgen</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @elseif(Auth::user()->level == 2)
                        <ul class="menu-inner py-1">
                            <li class="menu-item @if ($activePage == 'dashboard') active @endif">
                                <a href="/admin/home" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-home-smile"></i>
                                    <div class="text-truncate" data-i18n="Basic">Dashboards</div>
                                </a>
                            </li>
                            <!-- Data Master -->
                            <li class="menu-item @if ($activePage == 'master') active open @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-book-content"></i>
                                    <div class="text-truncate" data-i18n="Layouts">Data Master</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item @if ($subactivePage == 'jenis') active @endif">
                                        <a href="/admin/jenis" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without menu">Jenis Therapi</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'price') active @endif">
                                        <a href="/admin/price" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without navbar">Price List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'kategori') active @endif">
                                        <a href="/admin/kategori" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Kategori Pengeluaran</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'metode_pembayaran') active @endif">
                                        <a href="/admin/metode_pembayaran" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Metode Pembayaran</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item @if ($activePage == 'account') active open @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-user"></i>
                                    <div class="text-truncate" data-i18n="Layouts">Data Account</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item @if ($subactivePage == 'dokter') active @endif">
                                        <a href="/admin/dokter" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without menu">Dokter</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'resepsionis') active @endif">
                                        <a href="/admin/resepsionis" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without menu">Resepsionis</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item @if ($activePage == 'antrian') active @endif">
                                <a href="/admin/antrian" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-group"></i>
                                    <div class="text-truncate" data-i18n="Basic">Data Antrian</div>
                                </a>
                            </li>
                            <li class="menu-item @if ($activePage == 'pasien') active @endif">
                                <a href="/admin/pasien" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-card"></i>
                                    <div class="text-truncate" data-i18n="Basic">Data Pasien</div>
                                </a>
                            </li>
                            <li class="menu-item @if ($activePage == 'surat') active open @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-envelope"></i>
                                    <div class="text-truncate" data-i18n="Layouts">Data Surat Menyurat</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item @if ($subactivePage == 'surat_sakit') active @endif">
                                        <a href="/admin/surat/surat_sakit" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Surat Sakit</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'pengantar_rontgen') active @endif">
                                        <a href="/admin/surat/pengantar_rontgen" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Surat Pengantar Rontgen</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item @if ($activePage == 'rekam_medis') active @endif">
                                <a href="/admin/rekam_medis" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-heart-circle"></i>
                                    <div class="text-truncate" data-i18n="Basic">Data Rekam Medis</div>
                                </a>
                            </li>
                        </ul>
                    @elseif(Auth::user()->level == 3)
                        <ul class="menu-inner py-1">
                            <li class="menu-item @if ($activePage == 'dashboard') active @endif">
                                <a href="/admin/home" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-home-smile"></i>
                                    <div class="text-truncate" data-i18n="Basic">Dashboards</div>
                                </a>
                            </li>
                            <!-- Data Master -->
                            <li class="menu-item @if ($activePage == 'master') active open @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-book-content"></i>
                                    <div class="text-truncate" data-i18n="Layouts">Data Master</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item @if ($subactivePage == 'jenis') active @endif">
                                        <a href="/admin/jenis" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without menu">Jenis Therapi</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'price') active @endif">
                                        <a href="/admin/price" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without navbar">Price List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'kategori') active @endif">
                                        <a href="/admin/kategori" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Kategori Pengeluaran</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'metode_pembayaran') active @endif">
                                        <a href="/admin/metode_pembayaran" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Metode Pembayaran</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item @if ($activePage == 'account') active open @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-user"></i>
                                    <div class="text-truncate" data-i18n="Layouts">Data Account</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item @if ($subactivePage == 'dokter') active @endif">
                                        <a href="/admin/dokter" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without menu">Dokter</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'resepsionis') active @endif">
                                        <a href="/admin/resepsionis" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without menu">Resepsionis</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- Data Accounting --}}
                            <li class="menu-item @if ($activePage == 'accounting') active open @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-dollar"></i>
                                    <div class="text-truncate" data-i18n="Layouts">Data Accounting</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item @if ($subactivePage == 'pengeluaran') active @endif">
                                        <a href="/admin/pengeluaran" class="menu-link">
                                            <div class="text-truncate" data-i18n="Without menu">Data Pengeluaran</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item @if ($activePage == 'pasien') active @endif">
                                <a href="/admin/pasien" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-card"></i>
                                    <div class="text-truncate" data-i18n="Basic">Data Pasien</div>
                                </a>
                            </li>
                            <li class="menu-item @if ($activePage == 'antrian') active @endif">
                                <a href="/admin/antrian" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-group"></i>
                                    <div class="text-truncate" data-i18n="Basic">Data Antrian</div>
                                </a>
                            </li>
                            <li class="menu-item @if ($activePage == 'rekam_medis') active @endif">
                                <a href="/admin/rekam_medis" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-heart-circle"></i>
                                    <div class="text-truncate" data-i18n="Basic">Data Rekam Medis</div>
                                </a>
                            </li>
                            <li class="menu-item @if ($activePage == 'surat') active open @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-envelope"></i>
                                    <div class="text-truncate" data-i18n="Layouts">Data Surat Menyurat</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item @if ($subactivePage == 'surat_sakit') active @endif">
                                        <a href="/admin/surat/surat_sakit" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Surat Sakit</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($subactivePage == 'pengantar_rontgen') active @endif">
                                        <a href="/admin/surat/pengantar_rontgen" class="menu-link">
                                            <div class="text-truncate" data-i18n="Fluid">Surat Pengantar Rontgen</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endif
                </aside>
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->

                    <nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                        id="layout-navbar">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                            <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                                <i class="icon-base bx bx-menu icon-md"></i>
                            </a>
                        </div>

                        <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
                            <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                                <!-- User -->
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                        data-bs-toggle="dropdown">
                                        <div class="avatar avatar-online">
                                            <img src="{{ url('assets-admin') }}/img/avatars/1.png" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar avatar-online">
                                                            <img src="{{ url('assets-admin') }}/img/avatars/1.png" alt
                                                                class="w-px-40 h-auto rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0">{{ Auth::user()->username }}</h6>
                                                        <small class="text-body-secondary">
                                                            @if (Auth::user()->level == 1)
                                                                Admin
                                                            @elseif(Auth::user()->level == 2)
                                                                Dokter
                                                            @elseif(Auth::user()->level == 3)
                                                                Resepsionis
                                                            @else
                                                                -
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider my-1"></div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="icon-base bx bx-cog icon-md me-3"></i><span>Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <span class="d-flex align-items-center align-middle">
                                                    <i
                                                        class="flex-shrink-0 icon-base bx bx-credit-card icon-md me-3"></i><span
                                                        class="flex-grow-1 align-middle">Billing Plan</span>
                                                    <span class="flex-shrink-0 badge rounded-pill bg-danger">4</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider my-1"></div>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="mx-5 dropdown-item"
                                                    style="border:none; background:none; padding:0; width:100%; text-align:left;">
                                                    <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log
                                                        Out</span>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <!--/ User -->
                            </ul>
                        </div>
                    </nav>

                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->
                        @yield('content')
                        <!-- / Content -->

                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div class="container-xxl">
                                <div
                                    class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column text-white">
                                    <div class="mb-2 mb-md-0 footer-link">
                                        ©
                                        <script>
                                            document.write(new Date().getFullYear());
                                        </script>
                                        , made with ❤️ by
                                        <a href="https://portoandra.vercel.app" target="_blank" class="footer-link">Andra
                                            Elja
                                            Prama</a>
                                    </div>
                                </div>
                            </div>
                        </footer>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <!-- Core JS -->

        <script src="{{ url('assets-admin') }}/vendor/libs/jquery/jquery.js"></script>

        <script src="{{ url('assets-admin') }}/vendor/libs/popper/popper.js"></script>
        <script src="{{ url('assets-admin') }}/vendor/js/bootstrap.js"></script>

        <script src="{{ url('assets-admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="{{ url('assets-admin') }}/vendor/js/menu.js"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ url('assets-admin') }}/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->

        <script src="{{ url('assets-admin') }}/js/main.js"></script>

        <!-- Page JS -->
        <script src="{{ url('assets-admin') }}/js/dashboards-analytics.js"></script>

        <!-- Place this tag before closing body tag for github widget button. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>

        <!-- JS DataTables -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    "paging": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Tidak ada data yang ditemukan",
                        "info": "Menampilkan _PAGE_ dari _PAGES_ halaman",
                        "infoEmpty": "Tidak ada data tersedia",
                        "infoFiltered": "(disaring dari _MAX_ total data)",
                        "search": "Cari:",
                        "paginate": {
                            "next": ">",
                            "previous": "<"
                        }
                    }
                });
            });
        </script>
        <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 3000);
        </script>
    </body>

    </html>
@endauth
@guest
    <script>
        window.location = "/login";
    </script>
@endguest

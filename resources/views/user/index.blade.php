<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Shollu</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{url('assets-user')}}/img/favicon.png"/>
    <!-- Place favicon.ico in the root directory -->

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{url('assets-user')}}/css/bootstrap-5.0.0-alpha-2.min.css" />
    <link rel="stylesheet" href="{{url('assets-user')}}/css/LineIcons.2.0.css" />
    <link rel="stylesheet" href="{{url('assets-user')}}/css/animate.css" />
    <link rel="stylesheet" href="{{url('assets-user')}}/css/main.css" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        /* Hapus spinner di input number untuk browser webkit (Chrome, Safari, dll) */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Hapus spinner di input number untuk Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .dataTables_filter {
            margin-bottom: 15px; /* Menambahkan jarak antara kolom pencarian dan tabel */
        }
    </style>
  </head>
  <body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
      <div class="loader">
        <div class="ytp-spinner">
          <div class="ytp-spinner-container">
            <div class="ytp-spinner-rotator">
              <div class="ytp-spinner-left">
                <div class="ytp-spinner-circle"></div>
              </div>
              <div class="ytp-spinner-right">
                <div class="ytp-spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- preloader end -->
    

    <!-- ========================= header start ========================= -->
    <header class="header">
      <div class="navbar-area">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/">
                  <img src="{{url('assets-user')}}/img/logo/logo.svg" alt="Logo" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                  <ul id="nav" class="navbar-nav ml-auto">
                    <li class="nav-item">
                      <a class="page-scroll" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll" href="#register">Register</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll" href="#presensi">Presensi</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll" href="#testimonial">Testimonials</a>
                    </li>
                  </ul>
                </div>
                <!-- navbar collapse -->
              </nav>
              <!-- navbar -->
            </div>
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
      <!-- navbar area -->
    </header>
    <!-- ========================= header end ========================= -->

    <!-- ========================= hero-section start ========================= -->
    <section id="home" class="hero-section">
      <div class="hero-shape">
        <img src="{{url('assets-user')}}/img/hero/hero-shape.svg" alt="" class="shape">
      </div>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content">
              <h1 class="wow fadeInUp" data-wow-delay=".2s">Shollu <span>Solusi System Presensi Sholat</span> </h1>
              <p class="wow fadeInUp" style="text-align: justify;" data-wow-delay=".4s">
                Shollu adalah sistem presensi salat berbasis QR Code yang mencatat kehadiran jamaah secara real-time. Data tersimpan di server dan dapat diakses melalui aplikasi atau web dashboard.
              </p>
              <a href="#register" rel="nofollow" class="main-btn btn-hover wow fadeInUp" data-wow-delay=".6s">Daftar Sekarang</a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
              <img src="{{url('assets-user')}}/img/hero/hero-img.svg" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= hero-section end ========================= -->

    <!-- ========================= about-section start ========================= -->
    <section id="about" class="about-section pt-150">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="about-img wow fadeInUp" data-wow-delay=".5s">
              <img src="{{url('assets-user')}}/img/about/about-img.svg" alt="">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-content">
              <div class="section-title">
                <span class="wow fadeInUp" data-wow-delay=".2s">About Us</span>
                <h1 class="wow fadeInUp" data-wow-delay=".4s">Solusi Presensi Sholat Online Tebaik</h1>
                <p class="wow fadeInUp" data-wow-delay=".6s">Shollu membantu meningkatkan kedisiplinan ibadah, mengurangi kecurangan, dan memudahkan rekapitulasi kehadiran. 🚀</p>
              </div>
              <div class="rating-meta d-flex align-items-center wow fadeInUp" data-wow-delay=".65s">
                <h5>Rating 4.8</h5>
                <div class="rating">
                  <i class="lni lni-star-filled"></i>
                  <i class="lni lni-star-filled"></i>
                  <i class="lni lni-star-filled"></i>
                  <i class="lni lni-star-filled"></i>
                  <i class="lni lni-star-filled"></i>
                </div>
              </div>

              <div class="counter-up wow fadeInUp" data-wow-delay=".8s">
                <div class="single-counter">
                  <h3 id="secondo1" class="countup" cup-end="1" cup-append="M+">1 </h3>
                  <h5>Masjid</h5>
                </div>
                <div class="single-counter position-relative">
                  <h3 id="secondo2" class="countup" cup-end="234" cup-append="K+">234 </h3>
                  <h5>User</h5>
                </div>
                <div class="single-counter">
                  <h3 id="secondo3" class="countup" cup-end="34" cup-append="K+">34 </h3>
                  <h5>Reviews</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= about-section end ========================= -->

    <!-- ========================= delivery-section start ========================= -->
    <section id="register" class="delivery-section pt-150">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5">
            <div class="delivery-content">
              <div class="section-title">
                <span class="wow fadeInUp" data-wow-delay=".2s">Registrasi Peserta</span>
                <h1 class="mb-35 wow fadeInUp" data-wow-delay=".4s">Form Registrasi</h1>
                <form action="/register" method="POST" enctype="multipart/form-data" class="mb-35 wow fadeInUp" data-wow-delay=".6s">
                 {{ csrf_field() }}
                 <div class="row">
                    <div class="col-md-12 mb-3">
                       <div class="form-group">
                          <label>Nama Lengkap</label>
                          <input type="text" autofocus name="fullname" required class="form-control" placeholder="Masukkan Nama Lengkap .....">
                       </div>
                    </div>
                    <div class="col-md-12 mb-3">
                       <div class="form-group">
                          <label>Nomor Whatsapp</label>
                          <input type="number" name="contact" required class="form-control" placeholder="Masukkan Nomor Whatsapp .....">
                       </div>
                    </div>
                    <div class="col-md-12 mb-3">
                       <div class="form-group">
                          <label>Tanggal Lahir</label>
                          <input type="date" name="dob" required class="form-control" placeholder="Masukkan Tanggal Lahir .....">
                       </div>
                    </div>
                    <div class="col-md-12 mb-3">
                       <div class="form-group">
                          <label>Jenis Kelamin</label>
                          <select name="gender" class="form-control select2" autofocus required>
                             <option value="">--- Pilih Jenis Kelamin ---</option>
                             <option value="male">Laki-laki</option>
                             <option value="female">Perempuan</option>
                          </select>
                       </div>
                    </div>
                    <div class="col-md-12 mb-4">
                       <div class="form-group">
                          <label>Event</label>
                          <select name="id_event" class="form-control select2" autofocus required>
                             <option value="">--- Pilih Event ---</option>
                             @foreach($event as $data)
                             <option value="{{$data->id}}">{{$data->nama}}</option>
                             @endforeach
                          </select>
                       </div>
                    </div>
                 </div>
                 <button type="submit" class="main-btn btn-hover wow fadeInUp" data-wow-delay=".8s"><span class="fa fa-save"></span> Registrasi</button>               
              </form>
              </div>
            </div>
          </div>
          <div class="col-lg-7 order-first order-lg-last">
            <div class="delivery-img wow fadeInUp" data-wow-delay=".5s">
              <img src="{{url('assets-user')}}/img/delivery/delivery-img.svg" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= delivery-section end ========================= -->

    <!-- ========================= service-section start ========================= -->
    <section id="presensi" class="service-section pt-150">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-6 col-lg-8">
            <div class="section-title text-center mb-70">
              <span class="wow fadeInUp" data-wow-delay=".2s">Data Presensi</span>
              <h1 class="wow fadeInUp" data-wow-delay=".4s">Rekap Data Presensi</h1>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="table-responsive text-nowrap">
               <table id="absensiTable" class="table table-striped table-bordered data-table hover">
                  @php
                      use Carbon\Carbon;
                      use Carbon\CarbonImmutable;
                      
                      setlocale(LC_TIME, 'id_ID.utf8'); // Mengatur locale ke Indonesia
                      
                      $tahunBulan = explode('-', $bln);
                      $tahun = $tahunBulan[0];
                      $bulan = $tahunBulan[1];
                      $jumlahHari = Carbon::create($tahun, $bulan, 1)->daysInMonth;
                      $bulanIndonesia = CarbonImmutable::createFromFormat('Y-m', $bln)->locale('id')->isoFormat('MMMM Y');
                  @endphp

                  <thead class="text-white" style="background-color: #077364">
                      <tr>
                          <th rowspan="2" width="5%" class="align-middle text-center">#</th>
                          <th rowspan="2" class="align-middle text-center" style="width: 10%;">Foto</th>
                          <th rowspan="2" class="align-middle text-left" width="25%">Nama Peserta</th>
                          <th colspan="{{ $jumlahHari }}" class="align-middle text-center">{{ $bulanIndonesia }}</th>
                      </tr>
                      <tr>
                          @for ($i = 1; $i <= $jumlahHari; $i++)
                              <th class="text-center">{{ $i }}</th>
                          @endfor
                      </tr>
                  </thead>
                  <tbody>
                      <?php $no = 1; ?>
                      @foreach($peserta as $data)
                          <tr>
                              <td class="text-center">{{ $no++ }}</td>
                              <td class="text-center">
                                  <a href="{{ url('assets-admin/vendors/images/' . ($data->gender == 'male' ? 'man.png' : 'woman.png')) }}" target="_blank">
                                      <img src="{{ url('assets-admin/vendors/images/' . ($data->gender == 'male' ? 'man.png' : 'woman.png')) }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; object-position: center;">
                                  </a>
                              </td>
                              <td>{{ $data->fullname }}</td>
                              @for ($i = 1; $i <= $jumlahHari; $i++)
                                  <td class="text-center">
                                      @php
                                          $tanggal = sprintf('%s-%s-%02d', $tahun, $bulan, $i);
                                          $hadir = DB::table('absensi')->where('user_id', $data->id)->where('jam','LIKE',$tanggal.'%')->first();
                                      @endphp
                                      {{ $hadir ? '✓' : '-' }}
                                  </td>
                              @endfor
                          </tr>
                      @endforeach
                  </tbody>
               </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= service-section end ========================= -->
    
    <!-- ========================= testimonial-section start ========================= -->
    <section id="testimonial" class="testimonial-section img-bg pt-150 pb-40">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="section-title mb-60 text-center">
              <span class="wow fadeInUp" data-wow-delay=".2s">Testimonials</span>
              <h1 class="wow fadeInUp" data-wow-delay=".4s">What Our Users Says</h1>
            </div>
          </div>
        </div>

        <div class="row testimonial-wrapper">
          <div class="col-lg-4 col-md-6 -mt-30">
            <div class="single-testimonial wow fadeInUp" data-wow-delay=".2s">
              <div class="rating">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="content">
                <p>Lorem ipsum dolor sit amet onsetetur sadipscing elitr, sed diam non eirmod tempor invidunt ut labore etdo magna aliquyam erat, sed diam vero eos et accusam et justo duo dolores et ea rebum clita kasd gubergren.</p>
              </div>
              <div class="info">
                <div class="image">
                  <img src="{{url('assets-user')}}/img/testimonial/testimonial-1.png" alt="">
                </div>
                <div class="text">
                  <h5>Ena Shah</h5>
                  <p>Teacher at Abc School</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 -mt-60">
            <div class="single-testimonial wow fadeInUp" data-wow-delay=".4s">
              <div class="rating">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="content">
                <p>Lorem ipsum dolor sit amet onsetetur sadipscing elitr, sed diam non eirmod tempor invidunt ut labore etdo magna aliquyam erat, sed diam vero eos et accusam et justo duo dolores et ea rebum clita kasd gubergren.</p>
              </div>
              <div class="info">
                <div class="image">
                  <img src="{{url('assets-user')}}/img/testimonial/testimonial-2.png" alt="">
                </div>
                <div class="text">
                  <h5>Mrs. Gosh</h5>
                  <p>Actor</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="single-testimonial wow fadeInUp" data-wow-delay=".6s">
              <div class="rating">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="content">
                <p>Lorem ipsum dolor sit amet onsetetur sadipscing elitr, sed diam non eirmod tempor invidunt ut labore etdo magna aliquyam erat, sed diam vero eos et accusam et justo duo dolores et ea rebum clita kasd gubergren.</p>
              </div>
              <div class="info">
                <div class="image">
                  <img src="{{url('assets-user')}}/img/testimonial/testimonial-3.png" alt="">
                </div>
                <div class="text">
                  <h5>John Doe</h5>
                  <p>Model</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 -mt-30">
            <div class="single-testimonial wow fadeInUp" data-wow-delay=".2s">
              <div class="rating">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="content">
                <p>Lorem ipsum dolor sit amet onsetetur sadipscing elitr, sed diam non eirmod tempor invidunt ut labore etdo magna aliquyam erat, sed diam vero eos et accusam et justo duo dolores et ea rebum clita kasd gubergren.</p>
              </div>
              <div class="info">
                <div class="image">
                  <img src="{{url('assets-user')}}/img/testimonial/testimonial-4.png" alt="">
                </div>
                <div class="text">
                  <h5>Jonathan Smith</h5>
                  <p>Creative Designer</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 -mt-60">
            <div class="single-testimonial wow fadeInUp" data-wow-delay=".4s">
              <div class="rating">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="content">
                <p>Lorem ipsum dolor sit amet onsetetur sadipscing elitr, sed diam non eirmod tempor invidunt ut labore etdo magna aliquyam erat, sed diam vero eos et accusam et justo duo dolores et ea rebum clita kasd gubergren.</p>
              </div>
              <div class="info">
                <div class="image">
                  <img src="{{url('assets-user')}}/img/testimonial/testimonial-5.png" alt="">
                </div>
                <div class="text">
                  <h5>Sara A. K.</h5>
                  <p>Heroine</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="single-testimonial wow fadeInUp" data-wow-delay=".6s">
              <div class="rating">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="content">
                <p>Lorem ipsum dolor sit amet onsetetur sadipscing elitr, sed diam non eirmod tempor invidunt ut labore etdo magna aliquyam erat, sed diam vero eos et accusam et justo duo dolores et ea rebum clita kasd gubergren.</p>
              </div>
              <div class="info">
                <div class="image">
                  <img src="{{url('assets-user')}}/img/testimonial/testimonial-6.png" alt="">
                </div>
                <div class="text">
                  <h5>David Smith</h5>
                  <p>Businessman</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= testimonial-section end ========================= -->

    <!-- ========================= partners-section start ========================= -->
    <section id="partner" class="partner-section pt-60 pb-60">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="single-partner wow fadeInUp" data-wow-delay=".2s">
              <img src="{{url('assets-user')}}/img/partners/partner-1.png" alt="" width="80%">
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="single-partner wow fadeInUp" data-wow-delay=".4s">
              <img src="{{url('assets-user')}}/img/partners/partner-3.png" alt="" width="80%">
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="single-partner wow fadeInUp" data-wow-delay=".6s">
              <img src="{{url('assets-user')}}/img/partners/partner-2.png" alt="" width="80%">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= partners-section end ========================= -->

    <!-- ========================= footer start ========================= -->
    <footer id="footer" class="footer pt-20 pb-20">
      <div class="container">
          <div class="row">
              <p>Designed and Developed by <a href="https://shollu.site" style="color: #fff;" rel="nofollow">Shollu</a></p>
          </div>
      </div>
    </footer>
    <!-- ========================= footer end ========================= -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top btn-hover">
      <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{url('assets-user')}}/js/bootstrap.5.0.0.alpha-2-min.js"></script>
    <script src="{{url('assets-user')}}/js/count-up.min.js"></script>
    <script src="{{url('assets-user')}}/js/wow.min.js"></script>
    <script src="{{url('assets-user')}}/js/main.js"></script>

    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Inisialisasi DataTables -->
    <script>
    $(document).ready(function() {
        $('#absensiTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan _PAGE_ dari _PAGES_ halaman",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
    </script>
  </body>
</html>

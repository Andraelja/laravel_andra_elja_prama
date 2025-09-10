@guest
<!doctype html>

<html
  lang="en"
  class="layout-wide customizer-hide"
  data-assets-path="{{url('assets-admin')}}/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Betri Sari</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('assets-admin')}}/img/favicon/logo-baru.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{url('assets-admin')}}/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{url('assets-admin')}}/vendor/css/core.css" />
    <link rel="stylesheet" href="{{url('assets-admin')}}/css/demo.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{url('assets-admin')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{url('assets-admin')}}/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="{{url('assets-admin')}}/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <script src="{{url('assets-admin')}}/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card px-sm-6 px-0">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="/" class="app-brand-link gap-2">
                  <img src="{{url('assets-admin/img/betri-sari.png')}}" width="100%">
                </a>
              </div>
              <!-- /Logo -->
              @if (session('error'))
					      <div class="alert alert-danger alert-dismissible" role="alert">
                  {{ session('error')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
					    @endif
					    @if (session('success'))
					    	<div class="alert alert-success alert-dismissible" role="alert">
                  {{ session('success')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
					    @endif
             	<form method="POST" class="mb-6" action="{{ route('login') }}">
							   @csrf
							   <div class="mb-5">
							      <label for="email" class="form-label">Username</label>
							      <div class="input-group">
							         <span class="input-group-text" id="basic-addon11"><i class="bx bx-user"></i></span>
							         <input
							            type="text"
							            autofocus
							            requied
							            class="form-control"
							            name="username"
							            placeholder="Username"
							            aria-label="Username"
							            aria-describedby="basic-addon11" />
							      </div>
							   </div>
							   <div class="mb-9">
							      <div class="form-password-toggle">
								      <label class="form-label" for="basic-default-password12">Password</label>
								      <div class="input-group">
                        <span class="input-group-text" id="basic-addon11"><i class="bx bx-key"></i></span>
								         <input
								            type="password"
								            name="password"
								            class="form-control"
								            requied
								            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
								            aria-describedby="basic-default-password2" />
								         <span id="basic-default-password2" class="input-group-text cursor-pointer"
								            ><i class="icon-base bx bx-hide"></i
								            ></span>
								      </div>
								    </div>
							   </div>
							   <button class="btn btn-primary d-grid w-100 btn-lg" type="submit">Login</button>
							</form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->

    <script src="{{url('assets-admin')}}/vendor/libs/jquery/jquery.js"></script>

    <script src="{{url('assets-admin')}}/vendor/libs/popper/popper.js"></script>
    <script src="{{url('assets-admin')}}/vendor/js/bootstrap.js"></script>

    <script src="{{url('assets-admin')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{url('assets-admin')}}/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->

    <script src="{{url('assets-admin')}}/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 3000);
    </script>
  </body>
</html>

@endguest
@auth
  <script>window.location = "/admin/home";</script>
@endauth

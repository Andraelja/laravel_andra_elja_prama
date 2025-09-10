@guest
    <!doctype html>
    <html lang="en" class="layout-wide customizer-hide" data-assets-path="{{ url('assets-admin') }}/"
        data-template="vertical-menu-template-free">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <title>Ria Dental Care - OTP Verification</title>
        <link rel="icon" type="image/x-icon" href="{{ url('assets-admin') }}/img/favicon/favicon.ico" />
        <link rel="stylesheet" href="{{ url('assets-admin') }}/vendor/css/core.css" />
        <link rel="stylesheet" href="{{ url('assets-admin') }}/css/demo.css" />
        <link rel="stylesheet" href="{{ url('assets-admin') }}/vendor/css/pages/page-auth.css" />
        <script src="{{ url('assets-admin') }}/vendor/js/helpers.js"></script>
        <script src="{{ url('assets-admin') }}/js/config.js"></script>
        <style>
            .otp-input {
                width: 3rem;
                height: 3rem;
                text-align: center;
                font-size: 1.5rem;
                margin-right: 0.5rem;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
            }

            .otp-input:last-child {
                margin-right: 0;
            }
        </style>
    </head>

    <body>
        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner">
                    <div class="card px-sm-6 px-0">
                        <div class="card-body">
                            <div class="app-brand justify-content-center">
                                <a href="/" class="app-brand-link gap-2">
                                    <img src="{{url('assets-admin/img/betri-sari.png')}}    " width="100%">
                                </a>
                            </div>
                            <h4 class="text-center">Verifikasi Login</h4>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('otp.verify') }}" id="otp-form">
                                @csrf
                                <div class="mb-5 d-flex justify-content-center">
                                    <input type="text" name="otp[]" maxlength="1" class="otp-input" required autofocus
                                        pattern="[0-9]" inputmode="numeric" />
                                    <input type="text" name="otp[]" maxlength="1" class="otp-input" required
                                        pattern="[0-9]" inputmode="numeric" />
                                    <input type="text" name="otp[]" maxlength="1" class="otp-input" required
                                        pattern="[0-9]" inputmode="numeric" />
                                    <input type="text" name="otp[]" maxlength="1" class="otp-input" required
                                        pattern="[0-9]" inputmode="numeric" />
                                    <input type="text" name="otp[]" maxlength="1" class="otp-input" required
                                        pattern="[0-9]" inputmode="numeric" />
                                    <input type="text" name="otp[]" maxlength="1" class="otp-input" required
                                        pattern="[0-9]" inputmode="numeric" />
                                </div>
                                <button class="btn btn-primary d-grid w-100 btn-lg" type="submit">Cek Kode
                                    Verifikasi</button>
                            </form>
                            <p class="mt-3 text-center">
                                Belum mendapatkan kode? <a href="{{ route('otp.resend.get') }}">Kirim Kembali</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ url('assets-admin') }}/vendor/libs/jquery/jquery.js"></script>
        <script src="{{ url('assets-admin') }}/vendor/libs/popper/popper.js"></script>
        <script src="{{ url('assets-admin') }}/vendor/js/bootstrap.js"></script>
        <script src="{{ url('assets-admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="{{ url('assets-admin') }}/vendor/js/menu.js"></script>
        <script src="{{ url('assets-admin') }}/js/main.js"></script>
        <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 3000);

            // Auto move to next input
            const inputs = document.querySelectorAll('.otp-input');
            inputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    if (input.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value === '' && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });

            // On form submit, combine inputs into single hidden input
            const form = document.getElementById('otp-form');
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                let otpValue = '';
                inputs.forEach(input => {
                    otpValue += input.value;
                });
                // Create hidden input with combined OTP
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'otp';
                hiddenInput.value = otpValue;
                form.appendChild(hiddenInput);
                form.submit();
            });
        </script>
    </body>

    </html>
@endguest
@auth
    <script>
        window.location = "/admin/home";
    </script>
@endauth

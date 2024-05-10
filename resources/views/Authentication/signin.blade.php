<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Rapid Creator, A Product of ibexstack to help POD Business">
    <meta name="keywords" content="BootStrap,JavaScript,Laravel">
    <meta name="author" content="Tanveer Ahmed">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('SOFTWARE_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
</head>

<body class="app-blank">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px p-10">
                        @if (session('error') == 300)
                            <div class="alert alert-danger text-dark" role="alert">
                                <strong> Something went wrong! </strong> Credentails <b>are not
                                    matched</b> —with our records!
                            </div>
                        @endif
                            @if (session('error') == 400)
                                <div class="alert alert-danger text-dark" role="alert">
                                    <strong> Your </strong> Credentails <b>are Locked By Admin.
                                        </b>Please Contact!
                                </div>
                            @endif
                        @if (session('error') == 500)
                            <div class="alert alert-danger text-dark" role="alert">
                                <strong> Something went wrong! </strong> Your <b>are not
                                    elidigible</b> Because Login is the first Priority!
                            </div>
                        @endif
                        @php
                            $email_cookie = '';
                            $password_cookie = '';
                        @endphp
                        @if (Cookie::has('useremail') && Cookie::has('userpassword') && Cookie::has('remember'))
                            @php
                                $email_cookie = Cookie::get('useremail');
                                $password_cookie = Cookie::get('userpassword');
                                @$remember_cookie = Cookie::get('remember');
                            @endphp
                        @endif
                        @if (@$remember_cookie == 'on')
                            @php
                                $checked = 'checked';
                            @endphp
                        @else
                            @php
                                $checked = '';
                            @endphp
                        @endif
                        <form action="{{ route('authentication.login') }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                                <div class="text-gray-500 fw-semibold fs-6">To Continue to the Dashboard</div>
                            </div>

                            <div class="row g-3 mb-9">
                                <div class="col-md-6">
                                    <a href="{{ route('login.google') }}"
                                        class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo"
                                            src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}"
                                            class="h-15px me-3" />
                                        Sign in with Google
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('login.github') }}"
                                        class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <i class="fab fa-github theme-light-show h-15px me-3 fs-5 text-dark"></i>
{{--                                        <img alt="Logo"--}}
{{--                                            src="{{ asset('assets/media/svg/brand-logos/apple-black.svg') }}"--}}
{{--                                            class="theme-light-show h-15px me-3" />--}}
{{--                                        <img alt="Logo"--}}
{{--                                            src="{{ asset('assets/media/svg/brand-logos/apple-black-dark.svg') }}"--}}
{{--                                            class="theme-dark-show h-15px me-3" />--}}
                                        Sign in with Github
                                    </a>
                                </div>
                            </div>

                            <div class="separator separator-content my-14">
                                <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                            </div>

                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Email" name="email" value="{{ $email_cookie }}"
                                    autocomplete="off" class="form-control bg-transparent" required />
                                @error('email')
                                    <strong class="text-danger">{{ ucfirst($message) }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password-input">Password</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" class="form-control" required placeholder="Enter password" name="password" aria-label="Password" aria-describedby="password-addon" id="password-field">
                                    <button class="btn btn-light border-1" type="button" id="password-toggle-btn"><i class="fas fa-eye"></i></button>
                                </div>
                                @error('password')
                                <strong class="text-danger">{{ ucfirst($message) }}</strong>
                                @enderror
                            </div>
                            <div class="fv-row mb-8">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="rememberme"
                                        {{ $checked }} value="on" />
                                    <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">
                                        Remender me
                                    </span>
                                </label>
                            </div>
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <a href="{{ url('/forget') }}"
                                    class="link-primary">Forgot Password?</a>
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" id="insert" class="btn btn-primary">
                                    <span class="indicator-label">Sign In</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
                style="background-image: url(assets/media/misc/auth-bg.png)">
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <a href="{{ url('/') }}" class="mb-0 mb-lg-12">
                        <img alt="Logo" src="{{ asset(env('SOFTWARE_LOGO')) }}"
                            class="h-60px h-lg-50px" />
                    </a>
                    <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                        src="{{ asset('assets/media/misc/auth-screens.png') }}" alt="" />
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and
                        Productive</h1>
                    <div class="d-none d-lg-block text-white fs-base text-center">
                        In this kind of post, <a href="{{ url('/') }}"
                            class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>
                        introduces a person they’ve interviewed <br /> and provides some background information about
                        <a href="{{ url('/') }}" class="opacity-75-hover text-warning fw-bold me-1">the
                            interviewee</a> and their <br /> work following this is a transcript of the interview.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var hostUrl = "assets/";
    </script>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <script>
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        } else {
                            const button = document.getElementById("insert");
                            button.innerHTML =
                                "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...";
                            button.setAttribute('disabled', 'disabled');
                            setTimeout(time, 1000);
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var passwordField = document.getElementById("password-field");
            var passwordToggleBtn = document.getElementById("password-toggle-btn");

            passwordToggleBtn.addEventListener("click", function () {
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    passwordToggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    passwordField.type = "password";
                    passwordToggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });
    </script>
</body>

</html>

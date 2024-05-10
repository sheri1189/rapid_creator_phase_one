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
                    <form action="{{ route('authenticaion.update') }}" method="POST"
                          class="needs-validation" novalidate>
                        @csrf
                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">Update Password?</h1>
                        </div>
                        <div class="my-14 text-center">
                            <span class="w-125px text-gray-500 fw-semibold fs-6">Your Previous Password Must be Different from the Previos Used Password</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password-input">Password</label>
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" class="form-control" placeholder="Enter password" name="password" aria-label="Password" aria-describedby="password-addon" id="password-field">
                                <button class="btn btn-light border-1" type="button" id="password-toggle-btn"><i class="fas fa-eye"></i></button>
                            </div>
                            @error('password')
                            <strong class="text-danger">{{ ucfirst($message) }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="confirm-password-input">Confirm Password</label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" class="form-control" placeholder="Enter password" name="password_confirmation" aria-label="Password" aria-describedby="confirm-password-addon" id="confirm-password-field">
                                <button class="btn btn-light" type="button" id="confirm-password-addon"><i class="fas fa-eye"></i></button>
                            </div>
                            @error('password_confirmation')
                            <strong class="text-danger">{{ ucfirst($message) }}</strong>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary w-100" type="submit" id="insert">Reset
                                Password</button>
                        </div>
                    </form>
                    <div class="mt-5 text-center">
                        <p class="mb-0">Wait, I remember my password... <a
                                href="{{ route('authentication.signin') }}"
                                class="fw-semibold text-primary text-decoration-underline"> Click
                                here </a> </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
             style="background-image: url(assets/media/misc/auth-bg.png)">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100 bg-primary">
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var confirmPasswordField = document.getElementById("confirm-password-field");
        var confirmPasswordToggleBtn = document.getElementById("confirm-password-addon");

        confirmPasswordToggleBtn.addEventListener("click", function () {
            if (confirmPasswordField.type === "password") {
                confirmPasswordField.type = "text";
                confirmPasswordToggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                confirmPasswordField.type = "password";
                confirmPasswordToggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    });
</script>
</body>

</html>

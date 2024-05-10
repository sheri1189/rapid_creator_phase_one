<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Rapid Creator, A Product of ibexstack to help POD Business">
    <meta name="keywords" content="BootStrap,JavaScript,Laravel">
    <meta name="author" content="Tanveer Ahmed">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('ibex | Rapid Creator') }}</title>
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
                    <form id="installationForm" class="needs-validation" novalidate>
                        @csrf
                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">
                                Laravel Installer
                            </h1>
                            <div class="text-gray-500 fw-semibold fs-6">
                                The Laravel Installer is a friendly assistant to guide you through the process of creating a new Laravel application. It streamlines the setup process and gets you up and running with Laravel quickly and efficiently.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">{{ __('Email') }}</label>
                            <input id="username" type="email" class="form-control" name="email" required placeholder="Enter your Email" autocomplete="email" autofocus>
                            <div class="invalid-feedback">
                                Please enter your email.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password-input">{{ __('Password') }}</label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" class="form-control" required placeholder="Enter password" name="password" aria-label="Password" aria-describedby="password-addon" id="password-field">
                                <button class="btn btn-light border-1 password-toggle-btn" type="button"><i class="fas fa-eye"></i></button>
                                <div class="invalid-feedback">
                                    Please enter your Password.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Software Name') }}</label>
                            <input id="password" type="text" class="form-control" name="software_name" placeholder="Enter Software Name" required autocomplete="scheme-name">
                            <div class="invalid-feedback">
                                Please enter your software name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Software URL') }}</label>
                            <input id="password" type="text" class="form-control" name="software_url" placeholder="Enter Software URL" required autocomplete="scheme-name">
                            <div class="invalid-feedback">
                                Please enter your software url.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Logo') }}</label>
                            <input id="password" type="file" class="form-control" name="software_logo" required autocomplete="scheme-name">
                            <div class="invalid-feedback">
                                Please enter your software logo.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Profile Image') }}</label>
                            <input id="password" type="file" class="form-control" name="picture" required autocomplete="scheme-name">
                            <div class="invalid-feedback">
                                Please enter your software profile picture.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Database Name') }}</label>
                            <input id="password" type="text" class="form-control" name="database_name" placeholder="Enter Database Name" required autocomplete="database-name">
                            <div class="invalid-feedback">
                                Please enter your database name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Database-UserName') }}</label>
                            <input id="password" type="text" class="form-control" name="database_username" placeholder="Enter Database Name" required autocomplete="database-username">
                            <div class="invalid-feedback">
                                Please enter your database username.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password-input">{{ __('Database-Password') }}</label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" class="form-control" placeholder="Enter password" name="database_password" aria-label="Password" aria-describedby="password-addon" id="password-field">
                                <button class="btn btn-light border-1 password-toggle-btn" type="button"><i class="fas fa-eye"></i></button>
                                <div class="invalid-feedback">
                                    Please enter your Database Password.
                                </div>
                            </div>

                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary w-100" type="submit"
                                    id="insert"><i class='fas fa-download'></i> Install Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
             style="background-image: url(assets/media/misc/auth-bg.png)">
            <div class="d-flex flex-column py-7 py-lg-15 px-5 px-md-15 w-100">
                <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                     src="{{ asset('images/installation_logo.png') }}" alt="" />
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and
                    Productive</h1>
                <div class="d-none d-lg-block text-white fs-base text-center">
                    Laravel is a web application framework with an expressive, elegant syntax. Its belief is that development should be both enjoyable and creative. Laravel attempts to make development fun by easing common tasks used in most web projects, such as authentication, routing, sessions, templating, caching, and more.
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
<script src="{{ asset('/assets/js/sweat@alert.js') }}"></script>
<script>
    (function () {
        "use strict";
        var forms = document.querySelectorAll(".needs-validation");
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener(
                "submit",
                function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        event.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": '{{csrf_token()}}',
                            },
                        });
                        var formData = new FormData(installationForm);
                        const button = document.getElementById("insert");
                        button.innerHTML =
                            "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...";
                        button.setAttribute("disabled", "disabled");
                        $.ajax({
                            url: '{{route('install')}}',
                            method: "POST",
                            contentType: false,
                            processData: false,
                            data: formData,
                            dataType: "json",
                            success: function (response) {
                                if (response.message == 200) {
                                    button.removeAttribute("disabled");
                                    button.innerHTML = "<i class='fas fa-download'></i> Install Now";
                                    Swal.fire({
                                        toast: true,
                                        icon: "success",
                                        title: "Installation Completed Successfully",
                                        animation: false,
                                        position: "top-right",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                    });
                                    window.location.href = "{{url('/success')}}";
                                } else {
                                    button.removeAttribute("disabled");
                                    button.innerHTML = "<i class='fas fa-download'></i> Install Now";
                                    Swal.fire({
                                        toast: true,
                                        icon: "error",
                                        title: "Installation not Completed Successfully",
                                        animation: false,
                                        position: "top-right",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                    });
                                }
                                $("form").trigger("reset");
                                form.classList.remove("was-validated");
                            },
                            error: function (xhr, status, error) {
                                button.removeAttribute("disabled");
                                button.innerHTML = "<i class='fas fa-download'></i> Install Now";
                                var errorResponse = xhr.responseJSON; // Changed 'error' to 'xhr'
                                if (errorResponse && errorResponse.errors) {
                                    $.each(errorResponse.errors, function (index, value) {
                                        $("#" + index).html(value);
                                    });
                                }
                            },
                        });
                    }
                    form.classList.add("was-validated");
                },
                false
            );
        });
    })();
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var passwordFields = document.querySelectorAll('input[type="password"]');
        var passwordToggleBtns = document.querySelectorAll('.password-toggle-btn');

        passwordToggleBtns.forEach(function (btn, index) {
            btn.addEventListener("click", function () {
                if (passwordFields[index].type === "password") {
                    passwordFields[index].type = "text";
                    btn.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    passwordFields[index].type = "password";
                    btn.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });
    });
</script>
</body>

</html>

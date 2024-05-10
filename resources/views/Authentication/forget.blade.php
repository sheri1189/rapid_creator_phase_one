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
                    @if (session('success') == 200)
                    <div class="alert alert-success" role="alert">
                        <strong> Yey! Everything worked! </strong> Please Check <b>Your G-Mail Accout </b> —So,that
                        to reset the Password!
                    </div>
                    @endif
                    @if (session('error') == 300)
                        <div class="alert alert-danger" role="alert">
                            <strong> Something went wrong! </strong> Your Internet Connection <b>are not
                                working</b> —Please Check it!
                        </div>
                    @endif
                    @if (session('error') == 400)
                        <div class="alert alert-danger" role="alert">
                            <strong> Something went wrong! </strong> Your Email <b>is not
                                matched</b> —with the records!
                        </div>
                    @endif
                    <form action="{{ route('authentication.resetLink') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">Forgot Password?</h1>
                        </div>
                        <div class="my-14 text-center">
                            <span class="w-125px text-gray-500 fw-semibold fs-6">Enter your email to reset your password.</span>
                        </div>
                        <div class="mb-4">
                            <label for="iconInput" class="form-label">Email</label>
                            <div class="form-icon">
                                <input type="email" name="email"
                                       class="form-control form-control-icon" required id="iconInput"
                                       placeholder="example@gmail.com">
                                <i class="ri-mail-unread-line"></i>
                                @error('email')
                                <strong class="text-danger">{{ ucfirst($message) }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-primary w-100" type="submit" id="insert">Send
                                Reset
                                Link</button>
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
</body>

</html>

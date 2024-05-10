<!DOCTYPE html>
<html lang="en" >
<head>
    <title>{{getenv('SOFTWARE_NAME')}}</title>
    <meta charset="utf-8"/>
    <meta name="description" content="
            The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo,
            Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions.
            Grab your copy now and get life-time updates for free.
        "/>
    <meta name="keywords" content="
            metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js,
            Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates,
            free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button,
            bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon
        "/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/metronic"/>
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="https://preview.keenthemes.comauthentication/general/welcome.html"/>
    <link rel="shortcut icon" href="{{ asset("assets/media/logos/favicon.ico") }}"/>

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>        <!--end::Fonts-->



    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset("assets/plugins/global/plugins.bundle.css") }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/style.bundle.css") }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->

    <!--begin::Google tag-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-37564768-1');
    </script>
    <!--end::Google tag-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->

<!--begin::Body-->
<body  id="kt_body"  class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat" >
<!--begin::Theme mode setup on page load-->
<script>
    var defaultThemeMode = "light";
    var themeMode;

    if ( document.documentElement ) {
        if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if ( localStorage.getItem("data-bs-theme") !== null ) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }

        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }

        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>
<!--end::Theme mode setup on page load-->
<!--Begin::Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
    <style>
        body {
            background-image: url('assets/media/auth/bg8.jpg');
        }

        [data-bs-theme="dark"] body {
            background-image: url('assets/media/auth/bg8-dark.jpg');
        }
    </style>
    <div class="d-flex flex-column flex-center flex-column-fluid">
        <div class="d-flex flex-column flex-center text-center p-10">
            <div class="card card-flush w-md-650px py-5">
                <div class="card-body py-15 py-lg-20">
                    {{-- <div class="mb-7">
                        <a href="{{ url("index.html") }}" class="">
                            <img alt="Logo" src="{{ asset("assets/media/logos/custom-2.svg") }}" class="h-40px"/>
                        </a>
                    </div> --}}
                    <h1 class="fw-bolder text-gray-900 mb-5">
                        Welcome to {{env('SOFTWARE_NAME')}}    </h1>
                    <div class="fw-semibold fs-6 text-gray-500 mb-7">
                        This is your opportunity to get creative and make a name
                        <br/>
                        that gives readers an idea
                    </div>
                    <div class="mb-0">
                        <img src="{{ asset("assets/media/auth/welcome.png") }}" class="mw-100 mh-300px theme-light-show" alt=""/>
                        <img src="{{ asset("assets/media/auth/welcome-dark.png") }}" class="mw-100 mh-300px theme-dark-show" alt=""/>
                    </div>
                    <div class="mb-0">
                        <a href="{{env('SOFTWARE_URL')}}" class="btn btn-sm btn-primary">Go To Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var hostUrl = "assets/";</script>
<script src="{{ asset("assets/plugins/global/plugins.bundle.js") }}"></script>
<script src="{{ asset("assets/js/scripts.bundle.js") }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    {{-- =================header includes================= --}}
    <x-header />
    {{-- =================header includes================= --}}
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    class="app-default" data-new-gr-c-s-check-loaded="14.1147.0" data-gr-ext-installed=""
    studygpt-id="fcejkolobdcfbhhakbhajcflakmnhaff" studygpt-version="3.0.4" data-kt-sticky-app-header-minimize="on"
    data-kt-app-header-minimize="on" data-kt-scrolltop="on">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
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
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
            {{-- ====================navbar includes================== --}}
            <x-navbar />
            {{-- ====================navbar includes================== --}}
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
                {{-- ================sidebar includes=================== --}}
                <x-sidebar />
                {{-- ================sidebar includes=================== --}}
                @yield('main-content')
            </div>
        </div>
    </div>
    {{-- ================footer includes=================== --}}
    <x-footer />
    {{-- ================footer includes=================== --}}
</body>

</html>

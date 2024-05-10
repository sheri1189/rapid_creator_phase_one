
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Rapid Creator, A Product of ibexstack to help POD Business">
    <meta name="keywords" content="BootStrap,JavaScript,Laravel">
    <meta name="author" content="Tanveer Ahmed">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('SOFTWARE_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet"
          type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-37564768-1');
    </script>
    <script>
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<body  id="kt_body"  class="app-blank" >
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
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <style>
        html,body {
            padding:0;
            margin:0;
            font-family: Inter, Helvetica, "sans-serif";
        }

        a:hover {
            color: #009ef7;
        }
    </style>

    <div id="#kt_app_body_content" style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding-top:40px;padding-bottom:40px; width:100%;">
        <div style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:40px auto; max-width: 600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto" style="border-collapse:collapse">
                <tbody>
                <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                        <!--begin:Email content-->
                        <div style="text-align:center; margin:0 15px 34px 15px">
                            <!--begin:Logo-->
                            <div style="margin-bottom: 10px">
                                <a href="{{url('/')}}" rel="noopener" target="_blank">
                                    <img alt="Logo" src="{{$message->embed('assets/media/logos/17149942613159.png')}}" style="height: 35px;
    background-color: lightgray;
    padding: 6px;
    border-radius: 8px;"/>
                                </a>
                            </div>
                            <div style="margin-bottom: 15px">
                                <img alt="Logo" src="{{$message->embed('assets/media/email/icon-positive-vote-2.png')}}"/>
                            </div>
                            <div style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                                <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Change or reset your password</p>
                                <p style="margin-bottom:2px; color:#7E8299;font-weight: bold">You can change your password for
                                    security reasons or reset it if you forget it. Your Google
                                    Account password is used to access many Google products, like
                                    Gmail and YouTube.</p>
                                <a href="{{ url('/reset-password/' . $email) }}" target="_blank" style="text-decoration:none;background-color:#50cd89; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500; font-family:Arial,Helvetica,sans-serif;">
                                    Change Password
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="center" style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                        <p> © Copyright {{ date('Y') }}
                            <a href="https://ibexstack.com/live/" target="_blank" rel="noopener" style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Ibexstack</a>. All rights reserved.
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    var hostUrl = "/assets/";        </script>
<script src="{{ asset("/assets/plugins/global/plugins.bundle.js") }}"></script>
<script src="{{ asset("/assets/js/scripts.bundle.js") }}"></script>
</body>
</html>

@extends('layouts.app')
@section('title', 'Rapid Creator')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            @php
                                date_default_timezone_set('Asia/Karachi');
                                $currentHour = date('G');
                                $greeting;
                            @endphp
                            @if ($currentHour >= 5 && $currentHour < 12)
                                @php
                                    $greeting = 'Good Morning';
                                @endphp
                            @elseif ($currentHour >= 12 && $currentHour < 17)
                                @php
                                    $greeting = 'Good Afternoon';
                                @endphp
                            @elseif ($currentHour >= 17 && $currentHour < 19)
                                @php
                                    $greeting = 'Good Evening';
                                @endphp
                            @else
                                @php
                                    $greeting = 'Good Night';
                                @endphp
                            @endif
                            {{ $greeting }},
                            {{ Str::ucfirst(Auth::user()->first_name) . ' ' . Str::ucfirst(Auth::user()->last_name) }}!
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('dashboard.dashboard') }}" class="text-muted text-hover-primary">
                                    Home </a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                Dashboard</li>
                        </ul>
                    </div>
                </div>
                <div id="kt_app_toolbar_container" class="app-container  container text-end">
                    <div class="page-title d-flex flex-column justify-content-end flex-wrap me-3">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-end">
                            @php
                                date_default_timezone_set('Asia/Karachi');
                                $now = date('l j F Y');
                            @endphp
                            {{ $now }}
                        </h1>
                        <h1>
                            <span class="digital-clock badge badge-light-danger fs-base" id="digital-clock">11:40:21
                                AM</span>
                        </h1>
                        <input type="text" name="daterange" class="form-control" style="width: 70%;">
                        <button class="btn btn-primary" style="width: 30%;margin-left: 342px;margin-top: -43px;"
                                id="applyFilteration">Apply</button>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="row g-5 g-xl-10 mb-xl-10">
                        <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-5 mb-xl-10">
                            <div class="card card-flush h-100 mb-xl-10">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2"
                                                  id="fonts">{{ $activeFonts }}</span>
                                            <!--end::Amount-->

                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                Active
                                            </span>
                                            <!--end::Badge-->
                                            <i class="fas fa-font fs-2 text-end"
                                               style="border-radius: 50%;padding: 13px;margin-left: 138px;color: #2ac65c;background-color: #dfffea;"></i>
                                        </div>
                                        <!--end::Info-->

                                        <!--begin::Subtitle-->
                                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Fonts</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->

                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-end pt-0">
                                    <!--begin::Progress-->
                                    <div class="d-flex align-items-center flex-column mt-3 w-100">
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span class="fw-bolder fs-6 text-gray-900" id="active_fonts">{{ $activeFonts }}
                                                Active
                                                Fonts</span>
                                            <span class="fw-bold fs-6 text-gray-500"
                                                  id="active_fonts_percentage">{{ $percentageActiveFonts }}%</span>
                                        </div>

                                        <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                            <div class="bg-success rounded h-8px" role="progressbar"
                                                 id="active_fonts_percentage_css"
                                                 style="width: {{ $percentageActiveFonts }}%;" aria-valuenow="50"
                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end::Progress-->
                                </div>
                                <!--end::Card body-->
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-5 mb-xl-10">
                            <div class="card card-flush h-100 mb-xl-10">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2"
                                                  id="csvs">{{ $activeCSVs }}</span>
                                            <!--end::Amount-->

                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                Active
                                            </span>
                                            <!--end::Badge-->
                                            <i class="fas fa-font fs-2 text-end"
                                               style="border-radius: 50%;padding: 13px;margin-left: 138px;color: #2ac65c;background-color: #dfffea;"></i>
                                        </div>
                                        <!--end::Info-->

                                        <!--begin::Subtitle-->
                                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Total CSV Files</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->

                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-end pt-0">
                                    <!--begin::Progress-->
                                    <div class="d-flex align-items-center flex-column mt-3 w-100">
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span class="fw-bolder fs-6 text-gray-900" id="active_csvs">{{ $activeCSVs }}
                                                Active
                                                CSV Files</span>
                                            <span class="fw-bold fs-6 text-gray-500"
                                                  id="active_csvs_percentage">{{ $percentageActiveCsvs }}%</span>
                                        </div>

                                        <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                            <div class="bg-success rounded h-8px" role="progressbar"
                                                 id="active_csvs_percentage_css"
                                                 style="width: {{ $percentageActiveCsvs }}%;" aria-valuenow="50"
                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end::Progress-->
                                </div>
                                <!--end::Card body-->
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-5 mb-xl-10">
                            <div class="card card-flush h-100 mb-xl-10">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2"
                                                  id="templates">{{ $uploadedtemplates }}</span>
                                            <!--end::Amount-->

                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                Active
                                            </span>
                                            <!--end::Badge-->
                                            <i class="fas fa-images fs-2 text-end"
                                               style="border-radius: 50%;padding: 13px;margin-left: 138px;color: #2ac65c;background-color: #dfffea;"></i>
                                        </div>
                                        <!--end::Info-->

                                        <!--begin::Subtitle-->
                                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Templates</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->

                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-end pt-0">
                                    <!--begin::Progress-->
                                    <div class="d-flex align-items-center flex-column mt-3 w-100">
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span class="fw-bolder fs-6 text-gray-900"
                                                  id="active_templates">{{ $uploadedtemplates }} Active
                                                Templates</span>
                                            <span class="fw-bold fs-6 text-gray-500">100%</span>
                                        </div>

                                        <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                            <div class="bg-success rounded h-8px" role="progressbar" style="width: 100%;"
                                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end::Progress-->
                                </div>
                                <!--end::Card body-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_app_footer" class="app-footer mt-5 bg-white">
            <div class="app-container  container-fluid py-3 ">
                <div class="text-gray-900 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12 text-center">
                            <span class="text-muted fw-semibold me-1">© Copyright {{ date('Y') }} <a
                                    href="https://ibexstack.com/live/" target="_blank">Ibexstack</a>. All rights
                                reserved.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@if (session('success') == 200)
    @section('script')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
            $(function() {
                $('input[name="daterange"]').daterangepicker({
                    opens: 'left'
                }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                        .format('YYYY-MM-DD'));
                });
            });
            function updateDigitalClock() {
                const now = new Date();
                const hours = now.getHours();
                const minutes = now.getMinutes();
                const seconds = now.getSeconds();
                const ampm = (hours >= 12) ? 'PM' : 'AM';
                const formattedHours = (hours % 12 === 0) ? 12 : hours % 12;
                const digitalClock = document.getElementById('digital-clock');
                digitalClock.textContent =
                    `${formatTwoDigits(formattedHours)}:${formatTwoDigits(minutes)}:${formatTwoDigits(seconds)} ${ampm}`;
            }

            function formatTwoDigits(number) {
                return (number < 10) ? `0${number}` : number;
            }
            setInterval(updateDigitalClock, 1000);
            updateDigitalClock();
        </script>
        <script>
            $(document).ready(function() {
                $(document).on("click", "#applyFilteration", function(stop) {
                    stop.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    var value = $('input[name="daterange"]').val();
                    var formData = new FormData();
                    formData.append("value", value);
                    $.ajax({
                        url: "{{ url('/apply_filteration/') }}" + value,
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            alert(response);
                        }
                    });
                });
            });
        </script>
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Welcome Back to the Rapid Creator Dashboard...!',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        </script>
    @endsection
@endif
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });

        function updateDigitalClock() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();
            const seconds = now.getSeconds();
            const ampm = (hours >= 12) ? 'PM' : 'AM';
            const formattedHours = (hours % 12 === 0) ? 12 : hours % 12;
            const digitalClock = document.getElementById('digital-clock');
            digitalClock.textContent =
                `${formatTwoDigits(formattedHours)}:${formatTwoDigits(minutes)}:${formatTwoDigits(seconds)} ${ampm}`;
        }

        function formatTwoDigits(number) {
            return (number < 10) ? `0${number}` : number;
        }
        setInterval(updateDigitalClock, 1000);
        updateDigitalClock();
    </script>
    <script>
        $(document).ready(function() {
            $(document).on("click", "#applyFilteration", function(stop) {
                stop.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });
                var value = $('input[name="daterange"]').val();
                var formData = new FormData();
                formData.append("value", value);
                $.ajax({
                    url: "{{ url('/apply_filteration') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response) {
                            $("#templates").empty();
                            $("#active_templates").empty();
                            $("#fonts").empty();
                            $("#active_fonts").empty();
                            $("#active_fonts").append(response.activeFonts + " Active Fonts");
                            $("#fonts").append(response.totalFonts);
                            $("#active_fonts_percentage").empty();
                            $("#active_fonts_percentage").append(response
                                .percentageActiveFonts + "%");
                            $("#active_fonts_percentage_css").css("width", response
                                .percentageActiveFonts + "%");
                            $("#csvs").empty();
                            $("#active_csvs").empty();
                            $("#active_csvs").append(response.activeCSVs + " Active CSV Files");
                            $("#csvs").append(response.totalCSV);
                            $("#templates").append(response.uploadedtemplates);
                            $("#active_templates").append(response.uploadedtemplates +
                                " Active Templates");
                            $("#active_csvs_percentage").empty();
                            $("#active_csvs_percentage").append(response
                                .percentageActiveCsvs + "%");
                            $("#active_csvs_percentage_css").css("width", response
                                .percentageActiveCsvs + "%");
                        }
                    }
                });
            });
        });
    </script>
@endsection

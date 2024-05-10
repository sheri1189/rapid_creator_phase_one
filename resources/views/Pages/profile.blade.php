@extends('layouts.app')
@section('title', 'Rapid Creator')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Account Overview
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="../index.html" class="text-muted text-hover-primary">
                                    Home </a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                Account </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-body pt-9 pb-0">
                            <div class="d-flex flex-wrap flex-sm-nowrap">
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                        <img src="{{ asset(Auth::user()->picture) }}" alt="image" />
                                        <div
                                            class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Pic-->

                                <!--begin::Info-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <!--begin::User-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Name-->
                                            <div class="d-flex align-items-center mb-2">
                                                <a href="{{ route('dashboard.profile') }}"
                                                    class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                                    {{ ucfirst(Auth::user()->first_name) }}
                                                    {{ Auth::user()->last_name !== null ? ' ' . Str::ucfirst(Auth::user()->last_name) : '' }}
                                                </a>
                                            </div>
                                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                                <a href="{{ route('dashboard.profile') }}"
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                    <span class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i> {{ __('Admin') }}
                                                </a>
                                                <a href="{{ route('dashboard.profile') }}"
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                    <i class="fas fa-map-marker-alt fs-4 me-1">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                    {{ Auth::user()->address !== null ? ' ' . Str::ucfirst(Auth::user()->address) : '' }}

                                                </a>
                                                <a href="{{ route('dashboard.profile') }}"
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                                    <i class="fas fa-envelope-square fs-4"><span class="path1"></span><span
                                                            class="path2 ms-2"></span></i> {{ Auth::user()->email }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap flex-stack">
                                        <div class="d-flex flex-column flex-grow-1 pe-8">
                                            <div class="d-flex flex-wrap">
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-thumbs-up fs-3 text-success me-2"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                        <div class="fs-2 fw-bold" data-kt-countup="true"
                                                            data-kt-countup-value="100" data-kt-countup-prefix="%">0</div>
                                                    </div>
                                                    <div class="fw-semibold fs-6 text-gray-500">Success Rate
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (Auth::user()->country == '' &&
                                                Auth::user()->state == '' &&
                                                Auth::user()->city == '' &&
                                                Auth::user()->zip_code == '' &&
                                                Auth::user()->address == '' &&
                                                Auth::user()->contact_no == '')
                                            @php
                                                $completion = 50;
                                            @endphp
                                        @else
                                            @php
                                                $completion = 100;
                                            @endphp
                                        @endif
                                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                <span class="fw-semibold fs-6 text-gray-500">Profile
                                                    Completion</span>
                                                <span class="fw-bold fs-6">{{ $completion }}%</span>
                                            </div>

                                            <div class="h-5px mx-3 w-100 bg-light mb-3">
                                                <div class="bg-success rounded h-5px" role="progressbar"
                                                    style="width: {{ $completion }}%;"
                                                    aria-valuenow="{{ $completion }}" aria-valuemin="0"
                                                    aria-valuemax="{{ $completion }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                                        href="{{ route('dashboard.profile') }}">
                                        Overview </a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                        href="{{ route('dashboard.profile.edit') }}">
                                        Edit Profile </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!--end::Navbar-->
                    <!--begin::details View-->
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <!--begin::Card header-->
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Profile Details</h3>
                            </div>
                            <!--end::Card title-->

                            <!--begin::Action-->
                            <a href="{{ route('dashboard.profile.edit') }}"
                                class="btn btn-sm btn-primary align-self-center">Edit
                                Profile</a>
                            <!--end::Action-->
                        </div>
                        <div class="card-body p-9">
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ Str::ucfirst(Auth::user()->first_name) }}
                                        {{ Str::ucfirst(Auth::user()->last_name) }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Email</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">
                                        {{ Auth::user()->email ? Auth::user()->email : 'No Email' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">
                                    Contact Phone
                                </label>
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bold fs-6 text-gray-800 me-2">{{ Auth::user()->contact_no ? Auth::user()->contact_no :"No Contact Number"}}</span>
                                    <span class="badge badge-success">Verified</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">
                                    Country
                                </label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">
                                        {{ Auth::user()->country ? Auth::user()->country : "No Country" }}
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">State</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">
                                        {{ Auth::user()->state ? Auth::user()->state : "No State" }}
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-10">
                                <label class="col-lg-4 fw-semibold text-muted">City</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold fs-6 text-gray-800">
                                        {{ Auth::user()->city ? Auth::user()->city : "No City" }}
                                    </span>
                                </div>
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
                            <span class="text-muted fw-semibold me-1">© Copyright {{ date('Y') }} <a href="https://ibexstack.com/live/" target="_blank">Ibexstack</a>. All rights reserved.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

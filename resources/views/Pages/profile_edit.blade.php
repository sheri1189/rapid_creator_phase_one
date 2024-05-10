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
                                        <img src="{{ asset(Auth::user()->picture) }}" alt="image" id="fullPicture" />
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
                                                    class="text-gray-900 text-hover-primary fs-2 fw-bold me-1 fullName">
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
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2 fullAddress">
                                                    <i class="fas fa-map-marker-alt fs-4 me-1">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                    {{ Auth::user()->address !== null ? ' ' . Str::ucfirst(Auth::user()->address) : '' }}

                                                </a>
                                                <a href="{{ route('dashboard.profile') }}"
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary mb-2 fullEmail">
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
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                        href="{{ route('dashboard.profile') }}">
                                        Overview </a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                                        href="{{ route('dashboard.profile.edit') }}">
                                        Edit Profile </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                            data-bs-target="#kt_account_profile_details" aria-expanded="true"
                            aria-controls="kt_account_profile_details">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Profile Details</h3>
                            </div>
                        </div>
                        <div id="kt_account_settings_profile_details" class="collapse show">
                            <form id="form_update" method="POST">
                                @method('PUT')
                                <div class="card-body border-top p-9">
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                        <div class="col-lg-8">
                                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                                style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                                <div class="image-input-wrapper w-125px h-125px"
                                                    style="background-image: url({{ asset(Auth::user()->picture) }})">
                                                </div>
                                                <label
                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                    title="Change avatar">
                                                    <i class="fas fa-pencil-alt fs-7"><span class="path1"></span><span
                                                            class="path2"></span></i>
                                                    <input type="file" name="picture" accept=".png, .jpg, .jpeg" />
                                                </label>
                                            </div>
                                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Full Name</label>
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-6 fv-row">
                                                    <input type="hidden" id="id" value="{{ Auth::user()->id }}">
                                                    <input type="text" name="first_name"
                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                        placeholder="First name"
                                                        value="{{ Auth::user()->first_name != '' ? Auth::user()->first_name : '' }}" />
                                                </div>
                                                <div class="col-lg-6 fv-row">
                                                    <input type="text" name="last_name"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="Last name"
                                                        value="{{ Auth::user()->last_name != '' ? Auth::user()->last_name : '' }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Contact Number</label>
                                        <div class="col-lg-8">
                                            <input type="number" name="contact_no"
                                                value="{{ Auth::user()->contact_no != '' ? Auth::user()->contact_no : '' }}"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="Contact Number" />
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Country</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="country"
                                                value="{{ Auth::user()->country != '' ? Auth::user()->country : '' }}"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="Country" />
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">State</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="state"
                                                value="{{ Auth::user()->state != '' ? Auth::user()->state : '' }}"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="State" />
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">City</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="city"
                                                value="{{ Auth::user()->city != '' ? Auth::user()->city : '' }}"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="City" />
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Zip Postal Code</label>
                                        <div class="col-lg-8">
                                            <input type="number" name="zip_code"
                                                value="{{ Auth::user()->zip_code != '' ? Auth::user()->zip_code : '' }}"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="Zip Postal Code" />
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Address</label>
                                        <div class="col-lg-8">
                                            <textarea name="address" cols="3" placeholder="Address"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">{{ Auth::user()->address != '' ? Auth::user()->address : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button type="reset"
                                        class="btn btn-light btn-active-light-primary me-2">Discard</button>
                                    <button type="submit" class="btn btn-primary" id="update">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card  mb-5 mb-xl-10">
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                            data-bs-target="#kt_account_signin_method">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Sign-in Method</h3>
                            </div>
                        </div>
                        <div id="kt_account_settings_signin_method" class="collapse show">
                            <div class="card-body border-top p-9">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div id="kt_signin_email_edit" class="flex-row-fluid d-block">
                                        <form id="email_update_form" method="POST" class="form"
                                              novalidate="novalidate">
                                            @method('PUT')
                                            <div class="row mb-6">
                                                <div class="col-lg-6 mb-4 mb-lg-0">
                                                    <div class="fv-row mb-0">
                                                        <label for="emailaddress"
                                                               class="form-label fs-6 fw-bold mb-3">Enter New Email
                                                            Address</label>
                                                        <input type="hidden" id="id"
                                                               value="{{ Auth::user()->id }}">
                                                        <input type="email" name="email"
                                                               class="form-control form-control-lg form-control-solid"
                                                               placeholder="Email Address"
                                                               value="{{ Auth::user()->email }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <button id="email_update_button" type="button"
                                                        class="btn btn-primary  me-2 px-6">Update Email</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="separator separator-dashed my-6"></div>
                                <div class="d-flex flex-wrap align-items-center mb-10">
                                    <div id="kt_signin_password_edit" class="flex-row-fluid d-block">
                                        <form id="password_update_form" method="POST" class="form"
                                              novalidate="novalidate">
                                            @method('PUT')
                                            <div class="row mb-1">
                                                <div class="col-lg-4">
                                                    <div class="fv-row mb-0">
                                                        <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Current Password</label>
                                                        <input type="hidden" id="id"
                                                               value="{{ Auth::user()->id }}">
                                                        <div class="input-group auth-pass-inputgroup">
                                                            <input type="password" class="form-control form-control-lg form-control-solid" name="current_password" value="{{ Auth::user()->plain_password ? Auth::user()->plain_password:'**************' }}" placeholder="Enter Current Password" readonly />
                                                            <button class="btn btn-light password-toggle-btn" type="button"><i class="fas fa-eye"></i></button>
                                                        </div>
                                                        <div class="form-text mb-5 fw-bold text-danger">If you have no password then leave the Current Password field blank</div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="fv-row mb-0">
                                                        <label for="newpassword" class="form-label fs-6 fw-bold mb-3">New Password</label>
                                                        <div class="input-group auth-pass-inputgroup">
                                                            <input type="password" class="form-control form-control-lg form-control-solid" name="password" placeholder="New Password" id="new-password-field">
                                                            <button class="btn btn-light password-toggle-btn" type="button"><i class="fas fa-eye"></i></button>
                                                        </div>
                                                        <div class="form-text mb-5 fw-bold text-danger" id="password"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="fv-row mb-0">
                                                        <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">Confirm New Password</label>
                                                        <div class="input-group auth-pass-inputgroup">
                                                            <input type="password" class="form-control form-control-lg form-control-solid" name="password_confirmation" id="confirm-password-field" placeholder="Confirm New Password">
                                                            <button class="btn btn-light password-toggle-btn" type="button"><i class="fas fa-eye"></i></button>
                                                        </div>
                                                        <div class="form-text mb-5 fw-bold text-danger" id="password_confirmation"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <button id="password_update_button" type="button"
                                                        class="btn btn-primary me-2 px-6">Update Password</button>
                                            </div>
                                        </form>
                                    </div>
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
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on("click", "#update", function(stop) {
                stop.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });
                var formData = new FormData(form_update);
                var id = $("#update")
                    .closest("#form_update")
                    .find("#id")
                    .val();
                // --------------------------loading button coading-------------------
                const button = document.getElementById("update");
                button.innerHTML =
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...";
                button.setAttribute("disabled", "disabled");
                // --------------------------loading button coading-------------------
                $.ajax({
                    url: `{{ url('/profile_update/${id}') }}`,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.message == 200) {
                            Swal.fire({
                                toast: true,
                                icon: 'success',
                                title: 'Profile Updated Successfully',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            $(".fullName").text('');
                            $(".fullEmail").text('');
                            $(".fullAddress").text('');
                            $(".fullName").text(response.data.name);
                            $(".fullEmail").html(
                                '<i class="fas fa-envelope-square fs-4"><span class="path1"></span><span class="path2 ms-2"></span></i>' +
                                response.data.email);
                            $(".fullAddress").html(
                                '<i class="fas fa-map-marker-alt fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>' +
                                response.data.address);
                            $("#fullPicture").attr("src", '{{ asset('') }}' + response.data
                                .picture);
                            $("input[name=first_name]").val('');
                            $("input[name=last_name]").val('');
                            $("input[name=contact_no]").val('');
                            $("input[name=country]").val('');
                            $("input[name=state]").val('');
                            $("input[name=city]").val('');
                            $("input[name=zip_code]").val('');
                            $("input[name=address]").val('');
                            $("input[name=first_name]").val(response.data.first_name);
                            $("input[name=last_name]").val(response.data.last_name);
                            $("input[name=contact_no]").val(response.data.contact_no);
                            $("input[name=country]").val(response.data.country);
                            $("input[name=state]").val(response.data.state);
                            $("input[name=city]").val(response.data.city);
                            $("input[name=zip_code]").val(response.data.zip_code);
                            $("input[name=address]").val(response.data.address);
                            //$("form").trigger("reset");//
                            button.removeAttribute("disabled");
                            button.innerHTML = "Save Changes";
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: 'Profile Not Updated Successfully',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            $("form").trigger("reset");
                            button.removeAttribute("disabled");
                            button.innerHTML = "Save Changes";
                        }
                        // $("form").trigger("reset");
                        // form.classList.remove("was-validated");
                    },
                    error: function(error) {
                        button.removeAttribute("disabled");
                        button.innerHTML = "Update " + module_name + " >";
                        var error = error.responseJSON;
                        $.each(error.errors, function(index, value) {
                            $("#" + index).html(value);
                        });
                    },
                });
            })
            $(document).on("click", "#email_update_button", function(stop) {
                stop.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                var formData = new FormData($("#email_update_form")[0]);
                var id = $("#email_update_form #id").val();
                // --------------------------loading button coding-------------------
                const button = document.getElementById("email_update_button");
                button.innerHTML =
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...";
                button.setAttribute("disabled", "disabled");
                // --------------------------loading button coding-------------------

                $.ajax({
                    url: `{{ url('/email_update/${id}') }}`,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.message == 200) {
                            Swal.fire({
                                toast: true,
                                icon: 'success',
                                title: 'Email Updated Successfully',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            $(".emailAddress").text('');
                            $(".emailAddress").text(response.data.email);
                            $(".fullEmail").text('');
                            $(".fullEmail").html(
                                '<i class="fas fa-envelope-square fs-4"><span class="path1"></span><span class="path2 ms-2"></span></i>' +
                                response.data.email);
                            // $("#email_update_form").trigger("reset");
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: 'Email Not Updated Successfully',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                        button.removeAttribute("disabled");
                        button.innerHTML = "Update Email";
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        button.removeAttribute("disabled");
                        button.innerHTML = "Update Email";
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: 'An error occurred while updating email',
                            animation: false,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    }
                });
            });
            $(document).on("click", "#password_update_button", function(stop) {
                stop.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                var formData = new FormData($("#password_update_form")[0]);
                var id = $("#password_update_form #id").val();
                // --------------------------loading button coding-------------------
                const button = document.getElementById("password_update_button");
                button.innerHTML =
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...";
                button.setAttribute("disabled", "disabled");
                // --------------------------loading button coding-------------------

                $.ajax({
                    url: `{{ url('/password_update/${id}') }}`,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        button.removeAttribute("disabled");
                        button.innerHTML = "Update Password";
                        if (response.message == 200) {
                            Swal.fire({
                                toast: true,
                                icon: 'success',
                                title: 'Password Updated Successfully',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            $(".emailAddress").text('');
                            $(".emailAddress").text(response.data.email);
                            $(".fullEmail").text('');
                            $(".fullEmail").html(
                                '<i class="fas fa-envelope-square fs-4"><span class="path1"></span><span class="path2 ms-2"></span></i>' +
                                response.data.email);
                            // $("#email_update_form").trigger("reset");
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: 'Password Not Updated Successfully',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    },
                    error: function(error) {
                        button.removeAttribute("disabled");
                        button.innerHTML = "Update Password";
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: 'An error occurred while updating password',
                            animation: false,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                        $("#password").text(error.responseJSON.errors.password);
                        $("#password_confirmation").text(error.responseJSON.errors
                            .password_confirmation);
                    }
                });
            });

        })
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
@endsection

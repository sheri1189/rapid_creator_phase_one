@extends('layouts.app')
@section('title', 'Rapid Creator')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Users
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ url('/dashbaord') }}" class="text-muted text-hover-primary">
                                    Home </a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                Manage Users </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="fas fa-search fs-3 position-absolute ms-5"><span class="path1"></span><span
                                            class="path2"></span></i> <input type="text"
                                                                             data-kt-customer-table-filter="search" id="filteration"
                                                                             class="form-control form-control-solid w-250px ps-12"
                                                                             placeholder="Search with Name or Email" />
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTables">
                                <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th>Sr No</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600" id="gettingData">
                                @php
                                    $num = 1;
                                @endphp
                                @forelse ($allusers as $user)
                                    <tr>
                                        <td>{{$num++}}</td>
                                        <td>{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if($user->is_admin==1)
                                                <span class="badge badge-light-info">Admin</span>
                                            @else
                                                <span class="badge badge-light-secondary">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-light-{{$user->is_active==1?'primary':'danger'}}" id="status">{{$user->is_active==1?'Active':'In-active'}}</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-{{$user->is_active==0?'primary':'danger'}}" data-id="{{$user->id}}" id="changeStatus">{{$user->is_active==0?'Active':'In-active'}}</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="5">No Record Found !</th>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
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
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function (){
            $(document).on("input", "#filteration", function(event) {
                event.preventDefault();
                var value = $(this).val();
                $.ajax({
                    url: "{{ url('filteration') }}",
                    method: "GET",
                    data: { value: value, type: "users" },
                    success: function(response) {
                        $("#gettingData").empty();
                        if(response.data.length > 0) {
                            var count = 0;
                            $.each(response.data, function(key, value) {
                                if (value.is_admin == 1) {
                                    return true;
                                }
                                count++;
                                $("#gettingData").append(
                                    "<tr>" +
                                    "<td>" + count + "</td>" +
                                    "<td>" + value.first_name +" "+value.last_name+ "</td>" +
                                    "<td>" + value.email + "</td>" +
                                    "<td>" + (value.is_admin == 1 ? '<span class="badge badge-info">Admin</span>' : '<span class="badge badge-secondary">User</span>') + "</td>" +
                                    "<td>" + (value.is_active == 1 ? '<span class="badge badge-light-primary" id="status">Active</span>' : '<span class="badge badge-light-danger" id="status">In-active</span>') + "</td>" +
                                    "<td>" + (value.is_active == 0 ? '<button class="btn btn-sm btn-primary" data-id="'+value.id+'" id="changeStatus">Active</button>' : '<button class="btn btn-sm btn-danger" data-id="'+value.id+'" id="changeStatus">In-active</button>') + "</td>" +
                                    "</tr>"
                                );
                            });
                        } else {
                            $("#gettingData").html(
                                '<tr class="text-center fw-bolder"><th colspan="5">No Record Found!</th></tr>'
                            );
                        }
                    }
                });
            });
            $(document).on("click","#changeStatus",function (stop){
                stop.preventDefault();
                var id=$(this).attr("data-id");
                var button=$(this);
                const getButton = this;
                getButton.innerHTML =
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>";
                getButton.setAttribute("disabled", "disabled");
                $.ajax({
                    url:`{{url('change_status/${id}')}}`,
                    method:"GET",
                    success:function (response){
                        if(response.message == 200){
                            if(response.data.is_active == 0){
                                getButton.removeAttribute('disabled');
                                button.html("");
                                button.html("Active");
                                button.removeClass("btn-danger").addClass("btn-primary");
                                button.closest("tr").find("#status").html("");
                                button.closest("tr").find("#status").html("In-active");
                                button.closest("tr").find("#status").removeClass("badge-light-primary").addClass("badge-light-danger");
                            } else {
                                getButton.removeAttribute('disabled');
                                button.html("");
                                button.html("In-active");
                                button.removeClass("btn-primary").addClass("btn-danger");
                                button.closest("tr").find("#status").html("");
                                button.closest("tr").find("#status").html("Active");
                                button.closest("tr").find("#status").removeClass("badge-light-danger").addClass("badge-light-primary");
                            }
                        }
                    }
                })
            })
        })
    </script>
@endsection

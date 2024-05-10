@extends('layouts.app')
@section('title', 'Rapid Creator')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Csv
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
                                Manage CSV Files </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="fas fa-search fs-3 position-absolute ms-5"><span class="path1"></span><span
                                            class="path2"></span></i> <input type="text"
                                                                             data-kt-customer-table-filter="search"
                                                                             class="form-control form-control-solid w-250px ps-12"
                                                                             placeholder="Search with CSV Names" id="filteration" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                    <a href="{{ url('/csv/create') }}" class="btn btn-primary btn-sm"><i class="fas fa-upload"></i>
                                        Upload CSV</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTables">
                                <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th>Sr No</th>
                                    <th>File Name</th>
                                    <th>File Status</th>
                                    <th>Data in Csv File</th>
                                    <th>File Download</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600" id="gettingData">
                                @php
                                    $num = 1;
                                @endphp
                                @forelse ($allcsv_files as $csv_file)
                                    @if($array_data[$csv_file->csv_name])
                                        <tr>
                                            <td>{{ $num++ }}</td>
                                            <td>{{ Str::ucfirst($csv_file->csv_name) }}</td>
                                            <td>
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input"
                                                           onchange="CSVFileStatusChange(this, {{ $csv_file->id }}, '{{ url('/csv') }}')"
                                                           type="checkbox"
                                                           {{ $csv_file->csv_file_status == 1 ? 'checked' : '' }}
                                                           style="width: 28px;height: 15px;">
                                                    <span class="form-check-label fw-semibold"
                                                          id="csv_file_status_{{ $csv_file->id }}">
                                                        {{ $csv_file->csv_file_status == 1 ? 'Active' : 'In-active' }}
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <h1>
                                                    @php
                                                        $explode=explode(".",$csv_file->csv_file);
                                                    @endphp
                                                    <span class="badge badge-light-primary mt-3">{{ Str::ucfirst($explode[1]) }} {{__("Records: ".$array_data[$csv_file->csv_name])}}</span>

                                                </h1>
                                            </td>
                                            <td>
                                                <h1>
                                                    <a href="{{ route('download.csv', $csv_file->csv_file) }}"
                                                       class="badge badge-light-success text-capitalize mt-3 cursor-pointer">
                                                        <i class="fas fa-download me-3"></i> Download
                                                    </a>
                                                </h1>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm text-capitalizebtn-icon cursor-pointer"
                                                        onclick="deleteData(this,'{{ url('/csv') }}','{{ $csv_file->id }}','CSV')"><i class="fas fa-trash fs-6"></i>
                                                    Delete</button>
                                            </td>
                                        </tr>
                                    @endif
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
        $(document).ready(function () {
            $("#filteration").on("input", function (event) {
                event.preventDefault();
                var value = $(this).val();
                $.ajax({
                    url: "{{ url('filteration') }}",
                    method: "GET",
                    data: { value: value, type: "csv_files" },
                    success: function (response) {
                        $("#gettingData").empty();
                        if (response.data.length > 0) {
                            var count = 0;
                            var URL = '{{url('/csv')}}';
                            $.each(response.data, function (key, value) {
                                count++;
                                if (response.array_data[value.csv_name]) {
                                    var fileExtension = value.csv_file.split('.').pop();
                                    var downloadBaseURL = '{{url('/download-csv')}}';
                                    var fileDownload = `<h1><a href="${downloadBaseURL}/${value.csv_file}" class="badge badge-light-success text-capitalize mt-3 cursor-pointer"><i class="fas fa-download me-3"></i> Download</a></h1>`;
                                    var csvData = `<span class="badge badge-light-primary mt-3">${fileExtension.toUpperCase()} Records: ${response.array_data[value.csv_name]}</span>`;
                                    var checkboxHtml = `
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" data-id="${value.id}" ${value.csv_file_status ? 'checked' : ''} style="width: 28px;height: 15px;">
                                    <span class="form-check-label fw-semibold" id="csv_file_status_${value.id}">
                                        ${value.csv_file_status ? 'Active' : 'In-active'}
                                    </span>
                                </label>`;
                                    $("#gettingData").append(`
                                <tr>
                                    <td>${count}</td>
                                    <td>${value.csv_name}</td>
                                    <td>${checkboxHtml}</td>
                                    <td>${csvData}</td>
                                    <td>${fileDownload}</td>
                                   <td><button class="btn btn-danger btn-sm text-capitalizebtn-icon cursor-pointer" onclick="deleteData(this,'${URL}','${value.id}','CSV')"><i class="fas fa-trash fs-6"></i> Delete</button></td>
                                </tr>`
                                    );
                                }
                            });
                        } else {
                            $("#gettingData").html('<tr class="text-center fw-bolder"><th colspan="5">No Record Found!</th></tr>');
                        }
                    }
                });
            });
            $(document).on('change', 'input[type="checkbox"]', function () {
                var isChecked = $(this).prop('checked');
                var id = $(this).data('id');
                var statusText = isChecked ? 'Active' : 'In-active';
                $("#csv_file_status_" + id).text(statusText);
                CSVFileStatusChange(this, id, URL);
            });
        });
    </script>
@endsection

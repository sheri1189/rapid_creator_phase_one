@extends('layouts.app')
@section('title', 'Rapid Creator')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Template
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
                                Template Details </li>
                        </ul>
                    </div>
                     <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="{{url('/template')}}" class="btn btn-sm fw-bold btn-primary">
                            <i class="fas fa-long-arrow-alt-left"></i> Go Back
                        </a>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <input type="hidden" id="get_url_view" value="{{ url('/gettingData') }}">
                    <input type="hidden" id="get_url" value="{{ url('/template') }}">
                    <input type="hidden" id="module_name" value="Template">
                    <input type="hidden" id="image_base_url" value="{{ url('uploads') }}">
                    <div class="row">
                        @forelse ($alldesigns as $designs)
                            <div class="col-md-3 col-xxl-3 mt-2">
                                <div class="card template_status bg-secondary">
                                    <div class="card-body d-flex flex-center flex-column">
                                        <a class="d-block overlay" data-fslightbox="lightbox-basic"
                                            href="{{ asset($designs->design_image) }}">
                                            <div
                                                class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-200px">
                                                <div class="symbol symbol-200px mb-5 bg-dark">
                                                    <img src="{{ asset($designs->design_image) }}" alt="image"
                                                        style="border: 10px double lightgray;">
                                                </div>
                                            </div>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                <i class="bi bi-eye-fill text-white fs-3x"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12 col-xxl-12 mt-2">
                                <div class="card">
                                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                        <marquee behavior="scroll" direction="right"
                                            class="fs-4 text-danger fw-bold mb-0 text-capitalize text-center">No Record
                                            Found !!</marquee>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    @if ($alldesigns->links() != '')
                        <div class="row justify-content-center pt-5 rounded fs-4 bg-light-info mt-5">
                            <div class="col-11 mb-4">
                                {{ $alldesigns->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
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
    </div>
@endsection

@extends('layouts.app')
@section('title', 'Rapid Creator')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="modal fade" id="template_add" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content rounded">
                        <div class="modal-header pb-0 border-0 justify-content-end">
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <i class="fas fa-times fs-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                            <form id="form_submit" class="row g-3 needs-validation form" novalidate>
                                <div class="mb-13 text-center">
                                    <h1 class="mb-3">Add Template</h1>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Template Title</span>
                                    </label>
                                    <input type="hidden" id="get_url" value="{{ url('/template') }}">
                                    <input type="hidden" id="module_name" value="Template">
                                    <input type="text" class="form-control form-control-solid"
                                           placeholder="Enter Template Title" name="template_title" required />
                                    <strong class="text-danger" id="template_title"></strong>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Template Picture</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                             style="background-color:black;background-image: url('../assets/media/svg/avatars/blank.svg')">
                                            <div class="image-input-wrapper w-125px h-125px" id="template_add_image"
                                                 style="background-color:black;background-image: url('../assets/media/svg/avatars/blank.svg')">
                                            </div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="fas fa-pencil-alt fs-7"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                                <input type="file" name="template_picture" accept=".png, .jpg, .jpeg" />
                                            </label>
                                        </div>
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                        <strong class="text-danger" id="template_picture"></strong>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">
                                        Cancel
                                    </button>
                                    <button type="submit" id="insert" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Save Template >
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="template_update" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content rounded">
                        <div class="modal-header pb-0 border-0 justify-content-end">
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <i class="fas fa-times fs-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                            <form id="form_update" class="row g-3 needs-validation form" novalidate>
                                <div class="mb-13 text-center">
                                    <h1 class="mb-3">Add Template</h1>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Template Title</span>
                                    </label>
                                    <input type="hidden" id="id" value="{{ url('/template') }}">
                                    <input type="hidden" id="get_url" value="{{ url('/template') }}">
                                    <input type="hidden" id="module_name" value="Template">
                                    <input type="text" class="form-control form-control-solid"
                                           placeholder="Enter Template Title" name="template_title" required />
                                    <strong class="text-danger" id="template_title"></strong>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Template Picture</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                             style="background-color:black;background-image: url('../assets/media/svg/avatars/blank.svg')">
                                            <div class="image-input-wrapper w-125px h-125px"
                                                 style="background-color:black;background-image: url('../assets/media/svg/avatars/blank.svg')">
                                            </div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="fas fa-pencil-alt fs-7"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                                <input type="file" name="template_picture"
                                                       accept=".png, .jpg, .jpeg" />
                                            </label>
                                        </div>
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                        <strong class="text-danger" id="template_picture"></strong>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">
                                        Cancel
                                    </button>
                                    <button type="submit" id="insert" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Edit Template >
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Templates
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
                                Manage Templates </li>
                        </ul>
                    </div>
                    {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#template_add">
                            + Create Template
                        </a>
                    </div> --}}
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <input type="hidden" id="get_url_view" value="{{ url('/gettingData') }}">
                    <input type="hidden" id="get_url" value="{{ url('/template') }}">
                    <input type="hidden" id="module_name" value="Template">
                    <input type="hidden" id="image_base_url" value="{{ url('uploads') }}">
                    <div class="row">
                        @forelse ($alltemplates as $templates)
                            @if (isset($array_designs[$templates->id]))
                                <div class="col-md-3 col-xxl-3 mt-2">
                                    <div class="card template_status bg-secondary">
                                        <div class="card-body d-flex flex-center flex-column">
                                            <a class="d-block overlay" data-fslightbox="lightbox-basic"
                                               href="{{ asset($array_designs[$templates->id]['design_status']!=0 ? $array_designs[$templates->id]['design_image']:$templates->template_picture) }}">
                                                <div
                                                    class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-200px">
                                                    <div class="symbol symbol-200px mb-5 bg-dark">
                                                        <img src="{{ asset($array_designs[$templates->id]['design_status']!=0 ? $array_designs[$templates->id]['design_image']:$templates->template_picture) }}"
                                                             alt="image" style="border: 10px double lightgray;">
                                                    </div>
                                                </div>
                                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                    <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                </div>
                                            </a>
                                            @if($array_designs[$templates->id]['design_status']!=0)
                                                <div class="btn-group mt-2" role="group" aria-label="First group">

                                                    <a href="{{ url('design-details/' . $array_designs[$templates->id]['template_id']) }}"
                                                       type="button" class="btn btn-primary  btn-icon"
                                                       data-id="{{ $array_designs[$templates->id]['template_id'] }}"
                                                       title="View Template Design"><i class="fas fa-eye"></i></a>
                                                    <button type="button" class="btn btn-danger btn-icon"
                                                            onclick="deleteData(this,'{{ url('/template') }}','{{ $array_designs[$templates->id]['template_id'] }}','Template')"
                                                            title="Delete Template"><i class="fas fa-trash"></i></button>
                                                    <a href="{{ url('design-download/' . $array_designs[$templates->id]['template_id']) }}"
                                                       type="button" class="btn btn-info btn-icon"
                                                       title="Download Template Design"><i class="fas fa-download"></i></a>
                                                </div>
                                            @else
                                                <h6 class="text-dark fs-2">Processing</h6>
                                                <div class="loading">
                                                    <span class="loading__dot"></span>
                                                    <span class="loading__dot"></span>
                                                    <span class="loading__dot"></span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
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
                    @if ($alltemplates->links() != '')
                        <div class="row justify-content-center pt-5 rounded fs-4 bg-light-info mt-5">
                            <div class="col-11 mb-4">
                                {{ $alltemplates->links('pagination::bootstrap-5') }}
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
                                <span class="text-muted fw-semibold me-1">© Copyright {{ date('Y') }} <a href="https://ibexstack.com/live/" target="_blank">Ibexstack</a>. All rights reserved.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('title', 'Rapid Creator')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Image
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
                                Processing </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl">
                    <div class="row d-flex">
                        <div class="col-lg-6 col-xl-6 col-md-6 mx-auto" id="image_upload" style="display: block">
                            <div class="file-uploader-wrapper" style="width: 502px;height:502px;text-align: -webkit-center">
                                <header>Design Upload</header>
                                <form id="form_upload_file">
                                    <input class="file-input" type="file" name="file" hidden>
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="fw-bold">Browse File to Upload</p>
                                </form>
                                <section class="progress-area"></section>
                                <section class="uploaded-files-area"></section>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6" style="display: none" id="image_processing">
                            <div class="card custom-card mx-auto" style="width: 502px;height:519px;">
                                <div class="card-header" style="background-color: #2d3250;color: white;">
                                    <div class="card-title mb-0 fw-bold" style="color: white;">Text Implementation</div>
                                    {{--                                    <span class="fw-bold text-danger text-center fs-7 mb-5">Note: Ensure that the text length remains within a single line.</span>--}}
                                </div>
                                <div id="loader_preview" style="display: none">
                                    <div class="card-body"
                                         style="height: 100%;padding-top: 50%;position:absolute;padding-left: 40%;">
                                        <div class="lds-spinner mx-auto">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" id="text_design_area" style="overflow: scroll;width:500px;height:454px">
                                    <form id="form_submit" data-parsley-validate="">
                                        <div class="">
                                            <div class="row mt-5">
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 mb-2" style="font-weight:bold">Apply Text</label>
                                                    <input type="hidden" class="form-control" id="get_id">
                                                    <input type="text" class="form-control" id="csv_text"
                                                           placeholder="Apply Text into the Image" required=""
                                                           type="text" />
                                                    <strong class="text-danger" id="applyText"></strong>
                                                </div>
                                                {{-- <div class="fv-row mb-7">
                                                    <label
                                                        class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" id="check_via_csv" type="checkbox"
                                                            value="text" style="width: 28px;height: 15px;">
                                                        <span class="form-check-label fw-semibold">
                                                            {{ __('Via CSV') }}
                                                        </span>
                                                    </label>
                                                </div> --}}
                                                <div class="fv-row mb-7" id="csv_field" style="display: block">
                                                    <label class="fs-6 mb-2" style="font-weight:bold">Choose CSV
                                                        File</label>
                                                    <br>
                                                    <select class="form-control" id="gettingCSV">
                                                        <option value="" selected disabled>--Choose CSV File--
                                                        </option>
                                                        @foreach ($csv_files as $csv_file)
                                                            @php
                                                                $explode_name = explode('.csv', $csv_file->csv_file);
                                                            @endphp
                                                            <option value="{{ $csv_file->csv_file }}">{{ $explode_name[0] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="fv-row mb-7" style="display: none" id="csv_names">
                                                    <label class="fs-6 mb-2" style="font-weight:bold">Choose CSV
                                                        Data</label>
                                                    <br>
                                                    <select class="form-control" id="getting_names">
                                                        <option value="" selected disabled>--Choose CSV Data--
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label for="fs-6 mb-2" style="font-weight: bold">Fonts Type <strong
                                                            class="text-danger">*</strong></label>
                                                    <br>
                                                    <br>
                                                    <select id="selectFontType" class="form-control">
                                                        <option value="" selected disabled>--Choose Font Type--
                                                        </option>
                                                        <option value="own">Own Fonts</option>
                                                        <option value="google">Google Fonts</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-7">
                                                            <label for="fs-6 mb-2" style="font-weight: bold">Choose Font
                                                                Family <strong class="text-danger">*</strong></label>
                                                            <br>
                                                            <br>
                                                            <select class="form-control" id="applyFont" disabled>
                                                                <option value="" selected disabled>--Choose Font Type First--
                                                                </option>
                                                            </select>
                                                            <strong class="text-danger" id="fontFamily"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-7">
                                                            <label for="fs-6 mb-2" style="font-weight: bold">Add Variants to
                                                                Fonts <strong class="text-danger">*</strong></label>
                                                            <br>
                                                            <br>
                                                            <select id="selectFontVariants" class="form-control" disabled>
                                                                <option value="" selected disabled>--Choose Font Family
                                                                    First--</option>
                                                                <option value="regular">Regular</option>
                                                            </select>
                                                            <strong class="text-danger" id="fontVariant"></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-7">
                                                            <label for="fs-6 mb-2" style="font-weight: bold">Add Font
                                                                Size</label>
                                                            <br>
                                                            <br>
                                                            <input type="range" id="font_size">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-7">
                                                            <label for="fs-6 mb-2" style="font-weight: bold">Text
                                                                Alignment</label>
                                                            <br>
                                                            <br>
                                                            <div class="btn-group mr-2" role="group" aria-label="..."
                                                                 style="background-color:#2d3250;width:100%">
                                                                <button type="button" id="applyAlignment"
                                                                        value="baseline" style="background-color:#2d3250"
                                                                        title="Align Left"
                                                                        class="btn btn-outline-secondary btn-icon"><i
                                                                        class="text-white fas fa-align-left"></i></button>
                                                                <button type="button" id="applyAlignment" value="center"
                                                                        style="background-color:#2d3250" title="Align Center"
                                                                        class="btn btn-outline-secondary btn-icon"><i
                                                                        class="text-white fas fa-align-center"></i></button>
                                                                <button type="button" id="applyAlignment" value="end"
                                                                        style="background-color:#2d3250" title="Align Right"
                                                                        class="btn btn-outline-secondary btn-icon"><i
                                                                        class="text-white fas fa-align-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label for="fs-6 mb-2" style="font-weight: bold">Choose Text
                                                        Color</label>
                                                    <br>
                                                    <img style="min-width:16px;min-height:16px;box-sizing:unset;box-shadow:none;background:unset;padding:0 6px 0 0;cursor:pointer;"
                                                         src="{{asset('images/icon16.png')}}"
                                                         title="Choose with ColorPick Eyedropper - See advanced option: &quot;Add ColorPick Eyedropper near input[type=color] fields on websites&quot;"
                                                         class="colorpick-eyedropper-input-trigger">
                                                    <input class="form-control" type="color" value="#ffffff"
                                                           id="example-color-input" colorpick-eyedropper-active="true"
                                                           style="height: 45px">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer p-3 text-center" style="background-color: #2d3250;color: white;">
                                    <button class="btn text-dark" type="reset" id="formReset" style="background-color: white;">
                                        <span class="indicator-label">
                                            Reset Form
                                        </span>
                                        <i class="fas fa-sync text-dark"></i>
                                    </button>
                                    <button class="btn text-dark" type="reset" id="changeTemplate" style="background-color: white;">
                                        <span class="indicator-label">
                                            Change Template
                                        </span>
                                        <i class="fas fa-sync text-dark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6" id="getting_preview" style="text-align: -webkit-center">
                            <div class="card custom-card bg-dark" style="width:502px">
                                <div class="card-body pt-9 pb-0" style="background-color: #2d3250;width:500px">
                                    <div id="capture_preview" class="bg-dark">
                                        <div id="container" class="ui-widget-content">
                                            <div id="input">Text Here</div>
                                        </div>
                                        <img src="{{ asset('/images/gallery.png') }}" alt="Image not found"
                                             style="background-color:#B6BBC4;" class="img-fluid" id="image">
                                    </div>
                                    <br><br>
                                </div>
                                <div class="card-footer p-3 text-center" id="preview_image"
                                     style="display: none;background-color: #2d3250;border-bottom-right-radius: 8px;border-bottom-left-radius: 8px;">
                                    <button type="submit" class="btn" id="preview"
                                            style="background-color:white;">
                                        <span class="indicator-label">
                                            Generate Template
                                        </span>
                                        <i class="fas fa-arrow-right text-dark"></i>
                                    </button>
                                </div>
                                <div class="card-footer p-3 text-center" id="edit_image"
                                     style="display: none;background-color: #2d3250;border-bottom-right-radius: 8px;border-bottom-left-radius: 8px;">
                                    <button type="submit" class="btn" id="edit"
                                            style="background-color:white;">
                                        <span class="indicator-label">
                                            Edit Template
                                        </span>
                                        <i class="fas fa-edit text-dark"></i>
                                    </button>
                                    <a href="{{ url('details') }}" type="button" class="btn" id="details"
                                       style="background-color:white;">
                                        <span class="indicator-label">
                                            View Details
                                        </span>
                                        <i class="fas fa-eye text-dark"></i>
                                    </a>
                                </div>
                            </div>
                            <div id="previewImageContainer" class="bg-dark"></div>
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
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function (){
            $(document).on("click","#changeTemplate",function (stop){
                stop.preventDefault();
                $("#image_processing").css("display", "none");
                $("#image_upload").css("display", "block");
                $(".progress-row").css("display",'none');
                $("#preview").prop("disabled",true);
            })
            $(document).on("click","#formReset",function (event){
                event.preventDefault();
                $('#form_submit')[0].reset();
                $("#csv_text").val("Text Here");
                $("#input").text("Text Here");
                $("#input").css({"color": "white", "font-family": "Roboto"});
                $("#input").trigger("input");
                $("#csv_names").css({"display":"none"});
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#csv_text").val("Text Here");
            $("#container").on("resize", function(event, ui) {
                var srcTag = $("#image").attr("src");
                if (srcTag.includes("gallery.png")) {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Please upload a design before making changes!',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                    $("#container").resizable("disable");
                    $("#container").draggable("disable");
                } else {
                    $("#container").resizable("enable");
                    $("#container").draggable("enable");
                }
            });
            $("#container").on("drag", function(event, ui) {
                var srcTag = $("#image").attr("src");
                if (srcTag.includes("gallery.png")) {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Please upload a design before making changes!',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                    $("#container").resizable("disable");
                    $("#container").draggable("disable");
                } else {
                    $("#container").resizable("enable");
                    $("#container").draggable("enable");
                }
            });
        });
    </script>
    <script>
        const MAX_WIDTH = $('#container').width();
        const MAX_HEIGHT = $('#container').height();
        const MAX_FONT_SIZE = 100;
        const MIN_FONT_SIZE = 12;
        const LEFT_OFFSET = 28.875;

        function onChange(e) {
            const el = e.target;
            const container = $('#container');
            const maxWidth = container.width();
            let fontSize = MAX_FONT_SIZE;
            el.style.fontSize = fontSize + 'px';
            while (fontSize > MIN_FONT_SIZE && el.scrollWidth > maxWidth) {
                fontSize--;
                el.style.fontSize = fontSize + 'px';
            }
        }

        function onLoad() {
            const container = $("#container");
            const input = $("#input");

            container.resizable({
                aspectRatio: false,
                handles: "se",
                containment: "#image",
                resize: function(event, ui) {
                    onChange({
                        target: input[0]
                    });
                }
            }).draggable({
                containment: "#image"
            });

            let isDragging = false;

            container.mousedown(function() {
                isDragging = false;
            }).mousemove(function() {
                isDragging = true;
            }).mouseup(function(event) {
                if (isDragging) {
                    isDragging = false;
                    event.stopPropagation();
                    return;
                }
            });

            input.focus(function() {
                container.resizable("enable");
                container.draggable("enable");
            });

            input.blur(function() {
                container.resizable("enable");
                container.draggable("enable");
            });
            const image = $("#image");
            const imageRect = image[0].getBoundingClientRect();
            const initialLeft = (imageRect.width - MAX_WIDTH) / 2 + LEFT_OFFSET;
            const initialTop = (imageRect.height - MAX_HEIGHT) / 2;
            container.css({
                left: initialLeft + 'px',
                top: initialTop + 'px',
                width: MAX_WIDTH + 'px',
                height: MAX_HEIGHT + 'px',
            });
            input.css({
                fontSize: MAX_FONT_SIZE + 'px',
            });
            input.on('input', onChange);
            input.focus();
            onChange({
                target: input[0]
            });
        }
        window.addEventListener('load', onLoad);
        $(document).ready(function() {
            $(document).on("input", "#csv_text", function(event) {
                event.preventDefault();
                var csvText = $("#csv_text").val().replace(/(\r\n|\n|\r)/g, "");
                $("#input").html(csvText);
                $("#input").trigger("input");
            });
            $(document).on("change", "#applyFont", function(stop) {
                stop.preventDefault();
                $("#loader_preview").css("display", "block");
                setTimeout(time, 5000);
                function time() {
                    $("#loader_preview").css("display", "none");
                }
                var selectedFont = $(this).val();
                var fontType = $("#selectFontType").val();
                if ($("#input").css("font-weight")) {
                    $("#input").css("font-weight", "");
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: `{{url('/getting_font_effect/${selectedFont}')}}`,
                    method: 'PUT',
                    data: {
                        "font_type": fontType
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.message == 200) {
                            $("#selectFontVariants").empty();
                            $("#selectFontVariants").prop("disabled", false);
                            $("#selectFontVariants").append(
                                "<option value='' selected disabled>--Choose Font Variants--</option>"
                            );
                            $.each(response.variants, function(key, value) {
                                if (value.includes("Regular")) {
                                    var selectedFont = $("#applyFont").val();
                                    var fontUrl = `{{ url('/${key}') }}`;
                                    if (fontUrl) {
                                        var existingStyle = $('style[data-font="' + selectedFont + '"]');
                                        if (existingStyle.length > 0) {
                                            existingStyle.remove();
                                        }
                                        var styleElement = document.createElement('style');
                                        styleElement.setAttribute("data-font", selectedFont);
                                        styleElement.textContent = `@font-face {
                                font-family: '${selectedFont}';
                                src: url('${fontUrl}') format('truetype');
                            }
                            #input {
                                font-family: '${selectedFont}', sans-serif;
                            }
                            `;
                                        document.head.appendChild(styleElement);
                                        $("#input").trigger("input");
                                        $("#selectFontVariants").append("<option value='" +
                                            `{{ url('/${key}') }}` +
                                            "' style='text-transform:capitalize' selected>" +
                                            value +
                                            "</option>");
                                    }
                                }else {
                                    $("#selectFontVariants").append("<option value='" +
                                        `{{ url('/${key}') }}` +
                                        "' style='text-transform:capitalize'>" +
                                        value +
                                        "</option>");
                                }
                            });
                        } else {
                            $("#loader_preview").css("display", "none");
                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: 'Sorry! Your request to retrieve data',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching CSV data:', error);
                    }
                });
            });
            $(document).on("change", "#gettingCSV", function(stop) {
                stop.preventDefault();
                $("#loader_preview").css("display", "block");
                var selectedCSV = $(this).val();
                $.ajax({
                    url: `{{url('/getting_csv_data/${selectedCSV}')}}`,
                    method: 'GET',
                    success: function(response) {
                        if (response.message == 200) {
                            $("#loader_preview").css("display", "none");
                            $("#csv_names")
                                .css({
                                    opacity: 0,
                                })
                                .slideDown("slow")
                                .animate({
                                    opacity: 1,
                                });
                            $("#csv_names").prop("required", true);
                            $("#getting_names").empty();
                            $("#getting_names").append(
                                "<option value='' selected disabled>--Choose Name--</option>"
                            );
                            $.each(response.data, function(key, value) {
                                $("#getting_names").append("<option value='" + value +
                                    "'>" +
                                    value +
                                    "</option>");
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: 'Sorry! Your request to retrieve data from the ' +
                                    selectedCSV + 'file has failed.',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching CSV data:', error);
                    }
                });
            });

            $(document).on("change", "#getting_names", function(stop) {
                stop.preventDefault();
                var selectName = $(this).val();
                $("#loader_preview").css("display", "block");
                setTimeout(function() {
                    $("#loader_preview").css("display", "none");
                }, 500);
                var gettingText = selectName.replace(/(\r\n|\n|\r)/g, "");
                $("#input").html(gettingText);
                $("#csv_text").val(gettingText);
                // $('#input').trigger('input');
            });
            $(document).on("input", "#font_size", function() {
                var fontSize = $(this).val();

                $("#input").css("font-size", fontSize + "px");
            });
            $(document).on("change", "#selectFontVariants", function(event) {
                event.preventDefault();
                setTimeout(function() {
                    $("#loader_preview").css("display", "block");
                    setTimeout(function() {
                        $("#loader_preview").css("display", "none");
                    }, 1500);
                }, 1500);
                var selectedFont = $("#applyFont").val();
                var fontUrl = $(this).val();
                if (fontUrl) {
                    $("#loader_preview").css("display", "block");
                    var existingStyle = $('style[data-font="' + selectedFont + '"]');
                    if(existingStyle.length > 0) {
                        existingStyle.remove();
                    }
                    var styleElement = document.createElement('style');
                    styleElement.setAttribute("data-font", selectedFont);
                    styleElement.textContent = `
            @font-face {
                font-family: '${selectedFont}';
                src: url('${fontUrl}') format('truetype');
            }
            #input {
                font-family: '${selectedFont}', sans-serif;
            }
        `;
                    document.head.appendChild(styleElement);
                    $('#input').trigger('input');
                }
            });
            $(document).on("click", "#applyAlignment", function(stop) {
                stop.preventDefault();
                var align = $(this).val();
                $("#input").css("align-self", align);
            });
            $(document).on("input", "#example-color-input", function(stop) {
                stop.preventDefault();
                var color = $(this).val();
                $("#input").css("color", color);
            });
            $(document).on("change", "#selectFontType", function(stop) {
                stop.preventDefault();
                $("#loader_preview").css("display", "block");;
                var value = $(this).val();
                // $('#input').trigger('input');
                $.ajax({
                    url: `{{ url('/get-font-type/${value}') }}`,
                    method: "GET",
                    success: function(response) {
                        if (response) {
                            $("#loader_preview").css("display", "none");
                            $("#applyFont").prop("disabled", false);
                            $("#applyFont").empty();
                            $("#applyFont").append(
                                "<option value='' selected disabled>--Choose Font Family--</option>"
                            );
                            $.each(response.data, function(key, value) {
                                $("#applyFont").append("<option value='" + value +
                                    "' class='text-capitalize'>" +
                                    value +
                                    "</option>");
                            });
                        } else {
                            $("#loader_preview").css("display", "none");
                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: 'Error in the Process...!',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    }
                })
            });
        });
        $(document).ready(function() {
            $(document).on("click", "#preview", function(event) {
                event.preventDefault();
                var fontFamily = $("#applyFont").val();
                var fontVariants = $("#selectFontVariants").val();
                if (fontFamily !== null && fontVariants !== null) {
                    const button = $(this);
                    button.html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...");
                    button.prop("disabled", true);
                    $("#formReset").prop("disabled",true);
                    $("#changeTemplate").prop("disabled",true);
                    createTemplate();
                } else {
                    if (fontFamily === null) {
                        $("#fontFamily").text("Font Family is missing");
                    }else{
                        $("#fontFamily").text("");
                    }
                    if (fontVariants === null) {
                        $("#fontVariant").text("Font Variant is missing");
                    }else{
                        $("#fontVariant").text("");
                    }
                    const button = $(this);
                    button.html("<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-dark'></i>");
                    button.prop("disabled", false);
                }
            });
            $(document).on("click", "#edit", function(stop) {
                stop.preventDefault();
                const button = $(this);
                button.html(
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..."
                );
                button.prop("disabled", true);
                setTimeout(function() {
                    button.html(
                        "<span class='indicator-label'>Edit Template</span> <i class='fas fa-edit text-dark'></i>"
                    );
                    button.prop("disabled", false);
                    $("#formReset").prop("disabled",false);
                    $("#changeTemplate").prop("disabled",false);
                    editImage();
                }, 1000);
            });
            $(document).on("click", "#details", function(event) {
                event.preventDefault();
                const button = $(this);
                button.html(
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..."
                );
                button.prop("disabled", true);
                setTimeout(function() {
                    window.location.href = button.attr("href");
                }, 500);
            });

        });

        function createTemplate() {
            var containerDiv = $("#getting_preview #container");
            containerDiv.draggable("destroy").resizable("destroy");
            containerDiv.css({
                border: "none",
                userSelect: "none",
                MozUserSelect: "none",
                WebkitUserSelect: "none",
                msUserSelect: "none",
                touchAction: "none",
                cursor: "auto",
            });
            disableForm();
            captureScreenshot();
        }

        function captureScreenshot() {
            var fontFamilyValue = $("#applyFont").val();
            var fontVariantValue = $("#selectFontVariants").val();
            var csvValue = $("#gettingCSV").val();
            var textValue = $("#csv_text").val();
            var button = $("#preview");
            button.html(
                "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..."
            );
            button.prop("disabled", true);
            $("#preview_image").css("display", "block");
            $("#edit_image").css("display", "none");
            if (textValue.trim() === "" && csvValue == null) {
                $("#applyText").text("Please Enter the Text On Which You Want to Create the Image");
                button.html(
                    "<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-dark'></i>"
                );
                button.prop("disabled", false);
                return;
            }
            if (fontFamilyValue == "") {
                $("#applyFont").text("Please Select the Font Family First");
                button.html(
                    "<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-dark'></i>"
                );
                button.prop("disabled", false);
                return;
            }
            if (fontVariantValue == "") {
                $("#applyText").text("Please Select the Font Variant First");
                button.html(
                    "<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-dark'></i>"
                );
                button.prop("disabled", false);
                return;
            }
            var dataArray = [];
            if (csvValue === null && textValue !== null) {
                dataArray.push(textValue);
                processScreenshotData(dataArray);
            } else {
                var selectedCSV = csvValue;
                $.ajax({
                    url: '/getting_csv_data/' + selectedCSV,
                    method: 'GET',
                    success: function(response) {
                        if (response.message == 200) {
                            $.each(response.data, function(key, value) {
                                if (value !== undefined && Object.keys(value).length !== 0) {
                                    $.each(value, function(key, value2) {
                                        dataArray.push(value2);
                                    })
                                }
                            });
                            processScreenshotData(dataArray);
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: 'Sorry! Your request to retrieve data from the ' + selectedCSV +
                                    ' file has failed.',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            var button = $("#preview");
                            button.html(
                                "<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-dark'></i>"
                            );
                            button.prop("disabled", false);
                        }
                    },
                    error: function(error) {
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: 'Error fetching CSV data. Please try again later.',
                            animation: false,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                        var button = $("#preview");
                        button.html(
                            "<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-dark'></i>"
                        );
                        button.prop("disabled", false);
                    }
                });
            }
        }

        function processScreenshotData(dataArray) {
            if (dataArray.length === 0) {
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    title: 'No data to process.',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                var button = $("#preview");
                button.html(
                    "<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-dark'></i>"
                );
                button.prop("disabled", false);
                return;
            }

            var screenshotData = [];
            for (const text of dataArray) {
                const position = calculatePosition(text);
                screenshotData.push({
                    text: text,
                    positionX: position.x,
                    positionY: position.y,
                    fontSize: position.fontSize,
                    currentWidth: position.currentWidth,
                    currentHeight: position.currentHeight,
                    inputdivHeight: position.inputdivHeight,
                });
            }
            sendAjaxRequest(screenshotData);
        }

        function calculatePosition(text) {
            const container = $('#container');
            const input = $('#input');
            const image = $('#image');

            if (!container.length || !input.length || !image.length) {
                throw new Error("One or more elements not found.");
            }

            input.text(text);

            const fontSize = parseInt(input.css('font-size'));

            if (isNaN(fontSize)) {
                throw new Error("Error: Unable to get font size.");
            }

            input.css('line-height', fontSize + 'px');

            const containerRect = container[0].getBoundingClientRect();
            const inputRect = input[0].getBoundingClientRect();
            const imageRect = image[0].getBoundingClientRect();

            if (!containerRect || !inputRect || !imageRect) {
                throw new Error("Error: Unable to get element dimensions.");
            }
            const currentWidth = imageRect.width;
            const currentHeight = imageRect.height;
            const scaleWidth = currentWidth / image[0].naturalWidth;
            const scaleHeight = currentHeight / image[0].naturalHeight;
            const containerPositionX = (inputRect.left - imageRect.left) / scaleWidth;
            const containerPositionY = (inputRect.top - imageRect.top) / scaleHeight;

            const adjustedPositionX = containerPositionX * scaleWidth;
            const adjustedPositionY = containerPositionY * scaleHeight;

            return {
                x: adjustedPositionX,
                y: adjustedPositionY,
                fontSize: fontSize,
                currentWidth: currentWidth,
                currentHeight: currentHeight,
                inputdivHeight: input.height(),
            };
        }

        function sendAjaxRequest(dataArray) {
            var csv_file = $("#gettingCSV").val();
            var fontType = $("#selectFontType").val();
            var textColor = $("#example-color-input").val();
            var fontFamily = $("#applyFont").val();
            var textEffect = $("#selectFontVariants").val();
            var image_path = $("#image").attr("src");
            var get_id = $("#get_id").val();
            var alignment=$("#applyAlignment").val();
            if(alignment===null){
                alignment="center";
            }else{
                alignment=alignment;
            }
            if (csv_file === null) {
                var csv_file_name = "";
            } else {
                var csv_file_name = csv_file + ".csv";
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: `{{ url('/apply-text-position') }}`,
                method: 'POST',
                data: {
                    screenshotData: dataArray,
                    csv_file: csv_file_name,
                    id: get_id,
                    text_color: textColor,
                    textEffect: textEffect,
                    image_path: image_path,
                    font_family: fontFamily,
                    font_type:fontType,
                    alignment:alignment,
                },
                success: function(response) {
                    if (response.message === 200) {
                        var button = $("#preview");
                        button.html(
                            "<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-dark'></i>"
                        );
                        button.prop("disabled", false);
                        $("#preview_image").css("display", "none");
                        $("#edit_image").css("display", "block");
                        $("#details").attr("href", "/design-details/" + response.template);
                        $("#edit").val(response.template);
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: 'Thanks For Creating The Template',
                            animation: false,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    } else {
                        var button = $("#preview");
                        button.html(
                            "<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-dark'></i>"
                        );
                        button.prop("disabled", false);
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: 'Thanks not Created! Please try again later',
                            animation: false,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    }
                },
                error: function(error) {
                    var button = $("#preview");
                    button.html(
                        "<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-dark'></i>"
                    );
                    button.prop("disabled", false);
                    $("#fontVariant").text(error.responseJSON.errors.textEffect);
                    $("#fontFamily").text(error.responseJSON.errors.font_family);
                }
            });
        }

        function editImage() {
            $("#preview_image").css("display", "block");
            $("#preview").html(
                '<span class="indicator-label">Re-Generate Template</span> <i class="fas fa-arrow-right text-dark"></i>'
            );
            $("#edit_image").css("display", "none");
            // $("#input").trigger("input");
            var containerDiv = $("#getting_preview #container");
            const container = $("#container");
            const input = $("#input");
            container.resizable({
                aspectRatio: false,
                handles: "se",
                containment: "#image",
                resize: function(event, ui) {
                    onChange({
                        target: input[0]
                    });
                }
            }).draggable({
                containment: "#image"
            });

            let isDragging = false;

            container.mousedown(function() {
                isDragging = false;
            }).mousemove(function() {
                isDragging = true;
            }).mouseup(function(event) {
                if (isDragging) {
                    isDragging = false;
                    event.stopPropagation();
                    return;
                }
            });

            input.focus(function() {
                container.resizable("enable");
                container.draggable("enable");
            });

            input.blur(function() {
                container.resizable("enable");
                container.draggable("enable");
            });
            containerDiv.css({
                border: "",
                userSelect: "",
                MozUserSelect: "",
                WebkitUserSelect: "",
                msUserSelect: "",
                touchAction: "",
                cursor: "move",
            });
            $("#get_id").val($("#edit").val());
            enableForm();
        }

        function disableForm() {
            var form = document.getElementById("form_submit");
            var elements = form.elements;

            for (var i = 0; i < elements.length; i++) {
                elements[i].disabled = true;
            }
        }

        function enableForm() {
            var form = document.getElementById("form_submit");
            var elements = form.elements;

            for (var i = 0; i < elements.length; i++) {
                elements[i].disabled = false;
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            const $fileInput = $('.file-input');
            const $progressArea = $('.progress-area');
            const $uploadedFilesArea = $('.uploaded-files-area');
            const $uploadedImage = $('#uploaded-image');
            $('#form_upload_file').click(function (event) {
                if (event.target !== $('.file-input')[0]) {
                    $('.file-input').click();
                }
            });
            $fileInput.change(function (event) {
                const file = event.target.files[0];
                if (file) {
                    const fileName = file.name.length >= 12 ? file.name.substring(0, 13) + "... ." + file.name.split('.')[1] : file.name;
                    const fileExtension = file.name.split('.').pop().toLowerCase();
                    if (fileExtension !== 'jpg' && fileExtension !== 'png') {
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: 'Please select an image with a extension of either png, or jpg...!',
                            animation: false,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                        $(this).val("");
                        return false;
                    }
                    simulateProgressBar(fileName);
                }
            });
            function simulateProgressBar(name) {
                let progress = 0;
                const interval = setInterval(function () {
                    progress += 10;
                    if (progress <= 100) {
                        updateProgressBar(name, progress);
                        $("#preview").prop("disabled",false);
                    } else {
                        clearInterval(interval);
                        displayUploadedFile(name);
                    }
                }, 500);
            }
            function updateProgressBar(name, progress) {
                $progressArea.html(`
                <li class="progress-row">
                    <i class="fas fa-file-alt"></i>
                    <div class="progress-content">
                        <div class="details">
                            <span class="file-name">${name} • Uploading</span>
                            <span class="percent">${progress}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: ${progress}%"></div>
                        </div>
                    </div>
                </li>`);
            }
            function displayUploadedFile(name) {
                $progressArea.html("");
                let uploadedHTML = `
                <li class="progress-row">
                    <i class="fas fa-file-alt"></i>
                    <div class="progress-content">
                        <div class="details">
                            <span class="file-name">${name} • Uploaded</span>
                        </div>
                    </div>
                    <i class="fas fa-check"></i>
                </li>`;
                $uploadedFilesArea.prepend(uploadedHTML);
                applyImageProcessing();
            }
            function applyImageProcessing() {
                const file = $fileInput[0].files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        $("#image_processing").css("display", "block");
                        $("#image_upload").css("display", "none");
                        $("#preview_image").css({
                            "display": "block",
                            "background-color": "#2d3250",
                            "border-bottom-right-radius": "8px",
                            "border-bottom-left-radius": "8px"
                        });
                        $("#image").css('background-color', 'black');
                        $("#image").attr('src', event.target.result);
                        $("#container").resizable("enable");
                        $("#container").draggable("enable");
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>
@endsection

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
<style>
    .fslightbox-source .fslightbox-opacity-1 {
        background-color: black;
    }
</style>
<style>
    #container {
        position: absolute;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        word-wrap: normal;
        border: 1px dashed white;
        background-color: transparent;
        color: black;
        font-weight: bold;
        font-size: 30px;
        /* padding: 10px; */
        cursor: move;
    }

    .ui-resizable-handle {
        color: white;
    }


    #input {
        text-align: center;
        word-wrap: normal;
        background-color: transparent;
        color: white;
        font-size: 30px;
        /* padding: 10px; */
        border: none;
        outline: none;
        font-family: 'Roboto', sans-serif;
        font-weight: initial;
    }

    #image {
        /* margin-top: 10px; */
    }

    .italic-text {
        font-style: italic;
    }

    .bold-text {
        font-weight: bold;
    }

    .underline-text {
        text-decoration: underline;
    }

    .line-through-text {
        text-decoration: line-through;
    }

    .uppercase-text {
        text-transform: uppercase;
    }

    .lowercase-text {
        text-transform: lowercase;
    }

    .capitalize-text {
        text-transform: capitalize;
    }

    .letter-spacing-text {
        letter-spacing: 2px;
    }

    .word-spacing-text {
        word-spacing: 5px;
    }

    .text-shadow-effect {
        text-shadow: 2px 2px 4px #000000;
    }

    .small-caps-text {
        font-variant: small-caps;
    }
</style>
<style>
    .swal2-title {
        font-size: 18px !important;
    }

    .swal2-icon {
        font-size: 18px !important;
    }
</style>
<style>
    .file-uploader-wrapper {
        width: 100%;
        height: 100%;
        background: #fff;
        border-radius: 5px;
        padding: 30px;
        box-shadow: 7px 7px 12px rgba(0, 0, 0, 0.05);
    }

    .file-uploader-wrapper header {
        color: #2d3250;
        padding-top: 100px;
        font-size: 27px;
        font-weight: 600;
        text-align: center;
    }

    .file-uploader-wrapper form {
        height: 167px;
        display: flex;
        cursor: pointer;
        margin: 30px 0;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        border-radius: 5px;
        border: 2px dashed #2d3250;
    }

    .file-uploader-wrapper form :where(i, p) {
        color: #2d3250;
    }

    .file-uploader-wrapper form i {
        font-size: 50px;
    }

    .file-uploader-wrapper form p {
        margin-top: 15px;
        font-size: 16px;
    }

    .file-uploader-wrapper .progress-row {
        margin-bottom: 10px;
        background: #E9F0FF;
        list-style: none;
        padding: 15px 20px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .file-uploader-wrapper .progress-row i {
        color: #2d3250;
        font-size: 30px;
    }

    .file-uploader-wrapper .progress-row .details span {
        font-size: 14px;
    }

    .file-uploader-wrapper .progress-content {
        width: 100%;
        margin-left: 15px;
    }

    .file-uploader-wrapper .progress-content .details {
        display: flex;
        align-items: center;
        margin-bottom: 7px;
        justify-content: space-between;
    }

    .file-uploader-wrapper .progress-content .progress-bar {
        height: 6px;
        width: 100%;
        margin-bottom: 4px;
        background: #fff;
        border-radius: 30px;
    }

    .file-uploader-wrapper .progress-content .progress-bar .progress {
        height: 100%;
        width: 0%;
        background: #2d3250;
        border-radius: inherit;
    }

    .file-uploader-wrapper .uploaded-files-area {
        max-height: 232px;
        overflow-y: scroll;
    }

    .file-uploader-wrapper .uploaded-files-area.onprogress {
        max-height: 150px;
    }

    .file-uploader-wrapper .uploaded-files-area::-webkit-scrollbar {
        width: 0px;
    }

    .file-uploader-wrapper .uploaded-files-area .uploaded-row .content {
        display: flex;
        align-items: center;
    }

    .file-uploader-wrapper .uploaded-files-area .uploaded-row .details {
        display: flex;
        margin-left: 15px;
        flex-direction: column;
    }

    .file-uploader-wrapper .uploaded-files-area .uploaded-row .details .size {
        color: #404040;
        font-size: 11px;
    }

    .file-uploader-wrapper .uploaded-files-area i.fa-check {
        font-size: 16px;
    }

    .file-uploader-wrapper .apply-image-btn {
        margin-top: 20px;
        background-color: #2d3250;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .file-uploader-wrapper .apply-image-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .file-uploader-wrapper .apply-image-btn.loading {
        pointer-events: none;
    }

    .file-uploader-wrapper .image-preview-container {
        margin-top: 20px;
        text-align: center;
    }

    .file-uploader-wrapper .image-preview-container img {
        max-width: 100%;
        max-height: 300px;
    }
</style>
<style>
    .lds-spinner {
        color: official;
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-spinner div {
        transform-origin: 40px 40px;
        animation: lds-spinner 1.2s linear infinite;
    }

    .lds-spinner div:after {
        content: " ";
        display: block;
        position: absolute;
        top: 3px;
        left: 37px;
        width: 6px;
        height: 18px;
        border-radius: 20%;
        background: black;
    }

    .lds-spinner div:nth-child(1) {
        transform: rotate(0deg);
        animation-delay: -1.1s;
    }

    .lds-spinner div:nth-child(2) {
        transform: rotate(30deg);
        animation-delay: -1s;
    }

    .lds-spinner div:nth-child(3) {
        transform: rotate(60deg);
        animation-delay: -0.9s;
    }

    .lds-spinner div:nth-child(4) {
        transform: rotate(90deg);
        animation-delay: -0.8s;
    }

    .lds-spinner div:nth-child(5) {
        transform: rotate(120deg);
        animation-delay: -0.7s;
    }

    .lds-spinner div:nth-child(6) {
        transform: rotate(150deg);
        animation-delay: -0.6s;
    }

    .lds-spinner div:nth-child(7) {
        transform: rotate(180deg);
        animation-delay: -0.5s;
    }

    .lds-spinner div:nth-child(8) {
        transform: rotate(210deg);
        animation-delay: -0.4s;
    }

    .lds-spinner div:nth-child(9) {
        transform: rotate(240deg);
        animation-delay: -0.3s;
    }

    .lds-spinner div:nth-child(10) {
        transform: rotate(270deg);
        animation-delay: -0.2s;
    }

    .lds-spinner div:nth-child(11) {
        transform: rotate(300deg);
        animation-delay: -0.1s;
    }

    .lds-spinner div:nth-child(12) {
        transform: rotate(330deg);
        animation-delay: 0s;
    }

    @keyframes lds-spinner {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }

    .lds-ellipsis {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-ellipsis div {
        position: absolute;
        top: 33px;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: black;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }

    .lds-ellipsis div:nth-child(1) {
        left: 8px;
        animation: lds-ellipsis1 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(2) {
        left: 8px;
        animation: lds-ellipsis2 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(3) {
        left: 32px;
        animation: lds-ellipsis2 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(4) {
        left: 56px;
        animation: lds-ellipsis3 0.6s infinite;
    }

    @keyframes lds-ellipsis1 {
        0% {
            transform: scale(0);
        }

        100% {
            transform: scale(1);
        }
    }

    @keyframes lds-ellipsis3 {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(0);
        }
    }

    @keyframes lds-ellipsis2 {
        0% {
            transform: translate(0, 0);
        }

        100% {
            transform: translate(24px, 0);
        }
    }
    .loading {
        align-items: center;
        display: flex;
        justify-content: center;
        height: 100%;
        /*position: fixed;*/
        width: 100%;
    }

    .loading__dot {
        animation: dot ease-in-out 1s infinite;
        background-color: whitesmoke;
        display: inline-block;
        height: 10px;
        margin: 4px;
        border-radius: 50%;
        width: 10px;
    }

    .loading__dot:nth-of-type(2) {
        animation-delay: 0.2s;
    }

    .loading__dot:nth-of-type(3) {
        animation-delay: 0.3s;
    }

    @keyframes dot {
        0% { background-color: whitesmoke; transform: scale(1); }
        50% { background-color: #0d0e12; transform: scale(1.3); }
        100% { background-color: whitesmoke; transform: scale(1); }
    }
</style>

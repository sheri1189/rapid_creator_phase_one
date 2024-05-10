<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i>
</div>
<script>
    var hostUrl = "assets/index.html";
</script>
<script src="{{ asset('/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('/assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
<script src="{{ asset('/assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script src="{{ asset('/assets/js/custom/account/se ttings/signin-methods.js') }}"></script>
<script src="{{ asset('/assets/js/custom/account/settings/profile-details.js') }}"></script>
<script src="{{ asset('/assets/js/custom/account/settings/deactivate-account.js') }}"></script>
<script src="{{ asset('/assets/js/custom/pages/user-profile/general.js') }}"></script>
<script src="https://preview.keenthemes.com/metronic/theme/html/demo4/dist/assets/js/pages/widgets.js?v=7.2.9"></script>
{{--<script src="{{ asset('/assets/js/widgets.bundle.js') }}"></script>--}}
{{--<script src="{{ asset('/assets/js/custom/widgets.js') }}"></script>--}}
<script src="{{ asset('/assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/type.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/details.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/finance.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/complete.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/main.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/offer-a-deal/two-factor-authentication.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="{{ asset('/assets/js/custom/apps/customers/list/export.js') }}"></script>
<script src="{{ asset('/assets/js/custom/apps/customers/list/list.js') }}"></script>
<script src="{{ asset('/assets/js/custom/apps/customers/add.js') }}"></script>
<script src="{{ asset('/assets/js/view_data.js') }}"></script>
<script src="{{ asset('/assets/js/status_change.js') }}"></script>
<script src="{{ asset('/assets/js/sweat@alert.js') }}"></script>
<script src="{{ asset('/assets/js/insert_data.js') }}"></script>
{{--<script src="{{ asset('/assets/js/delete_data.js') }}"></script>--}}
<script src="{{ asset('/assets/js/update_data.js') }}"></script>
<script src="{{ asset('/assets/js/restore_data.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
      integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@yield('script')
<script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function() {
        $jq('.dataTables').DataTable({
            searching: true,
            paging: true,
            lengthMenu: [10, 25, 50, 75, 100],
            pageLength: 10
        });
        $jq('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        $jq('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    });
</script>
<script>
    function deleteData(element, end_point_url, id, module_name) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        const button_text='<i class="fas fa-trash fs-6"></i> Delete';
        const button = element;
        button.innerHTML =
            "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>";
        button.setAttribute("disabled", "disabled");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: end_point_url + "/" + id,
                    method: "DELETE",
                    dataType: "json",
                    success: function (response) {
                        if (response.message == 200) {
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                title: module_name + " Deleted Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            button.innerHTML=button_text;
                            button.removeAttribute("disabled");
                            $(element).closest("tr").fadeOut();
                        } else if (response.message == "template") {
                            button.innerHTML=button_text;
                            button.removeAttribute("disabled");
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                title: module_name + " Deleted Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            location.reload(true);
                        } else {
                            button.innerHTML=button_text;
                            button.removeAttribute("disabled");
                            Swal.fire({
                                toast: true,
                                icon: "error",
                                title:
                                    module_name +
                                    " Not Deleted Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    },
                });
            } else if (result.dismiss === Swal.DismissReason.cancel)
                button.innerHTML=button_text;
            button.removeAttribute("disabled");
            // Swal.fire({
            //     toast: true,
            //     icon: "success",
            //     title: module_name + " Saved Successfully..!",
            //     animation: false,
            //     position: "top-right",
            //     showConfirmButton: false,
            //     timer: 3000,
            //     timerProgressBar: true,
            // });
        });
    }
</script>

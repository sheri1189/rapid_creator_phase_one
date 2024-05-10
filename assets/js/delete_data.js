// function deleteData(element, end_point_url, id, module_name) {
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You won't be able to revert this!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes, delete it!",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 url: end_point_url + "/" + id,
//                 method: "DELETE",
//                 dataType: "json",
//                 success: function (response) {
//                     if (response.message == 200) {
//                         Swal.fire({
//                             toast: true,
//                             icon: "success",
//                             title: module_name + " Deleted Successfully..!",
//                             animation: false,
//                             position: "top-right",
//                             showConfirmButton: false,
//                             timer: 3000,
//                             timerProgressBar: true,
//                         });
//                         $(element).closest("tr").fadeOut();
//                     } else if (response.message == "template") {
//                         Swal.fire({
//                             toast: true,
//                             icon: "success",
//                             title: module_name + " Deleted Successfully..!",
//                             animation: false,
//                             position: "top-right",
//                             showConfirmButton: false,
//                             timer: 3000,
//                             timerProgressBar: true,
//                         });
//                         location.reload(true);
//                     } else {
//                         Swal.fire({
//                             toast: true,
//                             icon: "error",
//                             title:
//                                 module_name +
//                                 " Not Deleted Successfully..!",
//                             animation: false,
//                             position: "top-right",
//                             showConfirmButton: false,
//                             timer: 3000,
//                             timerProgressBar: true,
//                         });
//                     }
//                 },
//             });
//         } else if (result.dismiss === Swal.DismissReason.cancel)
//             console.log("Saved");
//             // Swal.fire({
//             //     toast: true,
//             //     icon: "success",
//             //     title: module_name + " Saved Successfully..!",
//             //     animation: false,
//             //     position: "top-right",
//             //     showConfirmButton: false,
//             //     timer: 3000,
//             //     timerProgressBar: true,
//             // });
//     });
// }

function addReligion() {
    $("#addReligionForm").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: 'agama/store', // Use the variable declared in Blade file
            data: formData,
            success: function (data) {
                $("#modal_default_tabCreate").modal("hide");
                $("#addReligionForm")[0].reset();
            //     $("#agamaTable tbody").append(`
            //     <tr>
            //     <td>${data.religionName}</td>
            //     <td>${data.description}</td>
            //     <td class="text-center">
            //         <div class="d-inline-flex">
            //             <div class="dropdown">
            //                 <a href="#" class="text-body" data-bs-toggle="dropdown">
            //                     <i class="ph-list"></i>
            //                 </a>
            //                 <div class="dropdown-menu dropdown-menu-end">
            //                     <a href="#" class="dropdown-item text-info detail-button"
            //                         data-bs-toggle="modal" data-bs-target="#modal_detail_${data.religionId}">
            //                         <i class="ph-list me-2"></i>
            //                         Detail
            //                     </a>
            //                     <a href="#" class="dropdown-item text-secondary" data-bs-toggle="modal"
            //                         data-bs-target="#modal_default_tabUpdate" data-id="${data.religionId}">
            //                         <i class="ph-pencil me-2"></i>
            //                         Edit
            //                     </a>
            //                     <a href="#" class="dropdown-item text-danger"
            //                         onclick="confirmDelete(${data.religionId})">
            //                         <i class="ph-trash me-2"></i>
            //                         Hapus
            //                     </a>
            //                 </div>
            //             </div>
            //         </div>
            //     </td>
            // </tr>
            //     `);
                console.log(formData);
                location.reload(); // melakukan reload page
            },
            error: function (data) {
                console.error("Error:", data);
            },
        });
    });
}

$(document).ready(function () {
    addReligion();
});

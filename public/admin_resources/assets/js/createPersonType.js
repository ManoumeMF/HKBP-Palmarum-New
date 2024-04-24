function addPersonType() {
    const notyWarning = new Noty({
        text: "Kedua field harus diisi sebelum mengirimkan form.",
        type: "warning",
        progressBar: false,
        layout:'topCenter',
        // timeout: 3000,
    });

    $("#addPersonTypeForm").on("submit", function (e) {
        e.preventDefault();

        // Ambil nilai dari field personType dan description
        let personTypeValue = $("input[name='personType']").val();
        let descriptionValue = $("textarea[name='description']").val();

        // Cek apakah kedua field sudah diisi
        if (personTypeValue.trim() !== "" && descriptionValue.trim() !== "") {
            let formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: `jenis-orang/store`,
                data: formData,
                success: function (data) {
                    $("#modal_default_tabCreate").modal("hide");
                    $("#addPersonTypeForm")[0].reset();
                    location.reload();
                },
                error: function (data) {
                    console.error("Error:", data);
                },
            });
        } else {
            notyWarning.show();
        }
    });

    $("#btnBatal").on("click", function () {
        $("#addPersonTypeForm")[0].reset();
    });
}

$(document).ready(function () {
    addPersonType();
});

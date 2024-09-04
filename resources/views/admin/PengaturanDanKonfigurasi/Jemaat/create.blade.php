@extends('layouts.admin.template')
@section('content')
<script>
    $(document).ready(function () {
        // Your existing Select2 initialization
        $('.select').each(function () {
            if ($(this).closest('.modal').length) {
                // If the Select2 element is inside a modal
                $(this).select2({
                    dropdownParent: $(this).closest('.modal')
                });
            } else {
                // If the Select2 element is not inside a modal
                $(this).select2();
            }

        });

        // jQuery button click event to add Anggota Keluarga row
        $("#addAnggota").on("click", function () {

            // Adding a row inside the tbody.
            $("#tblAnggota tbody").append('<tr>' +
                '<td>' +
                'Nama Lengkap' +
                '</td>' +
                '<td>' +
                'Jenis Kelamin' +
                '</td>' +
                '<td>' +
                'Tanggal Lahir' +
                '</td>' +
                '<td>' +
                'Hubungan Keluarga' +
                '</td>' +
                '<td>' +
                'Foto' +
                '</td>' +
                '<td  style="text-align: center">' +
                '<a href="#"class="btn btn-flat-danger btn-icon w-24px h-24px rounded-pill" id="delAnggota"><i class="ph-x ph-sm"></i></a>' +
                '</td>' +
                '</tr>');
        });

        $(document).on('click', '#delAnggota', function () {
            $(this).closest('tr').remove();
            return false;
        });

        // jQuery button click event to add Anggota Keluarga row
        $("#addDokumen").on("click", function () {

            // Adding a row inside the tbody.
            $("#tblDokumen tbody").append('<tr>' +
                '<td>' +
                'Nama Dokumen' +
                '</td>' +
                '<td>' +
                'Nama File' +
                '</td>' +
                '<td>' +
                'Keterangan' +
                '</td>' +
                '<td  style="text-align: center">' +
                '<a href="#"class="btn btn-flat-danger btn-icon w-24px h-24px rounded-pill" id="delDokumen"><i class="ph-x ph-sm"></i></a>' +
                '</td>' +
                '</tr>');
        });

        $(document).on('click', '#delDokumen', function () {
            $(this).closest('tr').remove();
            return false;
        });
    });
</script>
<script>
    // Setup module
    // ------------------------------

    var DateTimePickers = function () {


        //
        // Setup module components
        //

        // Daterange picker
        const _componentDaterange = function () {
            if (!$().daterangepicker) {
                console.warn('Warning - daterangepicker.js is not loaded.');
                return;
            }

            // Basic initialization
            $('.daterange-basic').daterangepicker({
                parentEl: '.content-inner'
            });
            $('.daterange-time').daterangepicker({
                parentEl: '.content-inner',
                timePicker: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
            $('.daterange-increments').daterangepicker({
                parentEl: '.content-inner',
                timePicker: true,
                timePickerIncrement: 10,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

        };

        // Date picker
        const _componentDatepicker = function () {
            if (typeof Datepicker == 'undefined') {
                console.warn('Warning - datepicker.min.js is not loaded.');
                return;
            }

            // Hide on selection
            const dpAutoHideElement = document.querySelector('.datepicker-autohide');
            if (dpAutoHideElement) {
                const dpAutoHide = new Datepicker(dpAutoHideElement, {
                    container: '.content-inner',
                    buttonClass: 'btn',
                    prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                    nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                    autohide: true,
                    format: 'dd M yyyy'
                });
            }

            const dpAutoHideElement2 = document.querySelector('.datepicker-autohide2');
            if (dpAutoHideElement2) {
                const dpAutoHide = new Datepicker(dpAutoHideElement2, {
                    container: '.content-inner',
                    buttonClass: 'btn',
                    prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                    nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                    autohide: true,
                    format: 'dd M yyyy'
                });
            }

            const dpAutoHideElement3 = document.querySelector('.datepicker-autohide3');
            if (dpAutoHideElement3) {
                const dpAutoHide = new Datepicker(dpAutoHideElement3, {
                    container: '.content-inner',
                    buttonClass: 'btn',
                    prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                    nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                    autohide: true,
                    format: 'dd M yyyy'
                });
            }

            const dpAutoHideElement4 = document.querySelector('.datepicker-autohide4');
            if (dpAutoHideElement4) {
                const dpAutoHide = new Datepicker(dpAutoHideElement4, {
                    container: '.content-inner',
                    buttonClass: 'btn',
                    prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                    nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                    autohide: true,
                    format: 'dd M yyyy'
                });
            }

        };


        //
        // Return objects assigned to module
        //

        return {
            init: function () {
                _componentDaterange();
                _componentDatepicker();
            }
        }
    }();


    // Initialize module
    // ------------------------------

    document.addEventListener('DOMContentLoaded', function () {
        DateTimePickers.init();
    });
</script>

<script>
    // Setup module
// ------------------------------

const DropzoneUploader = function() {


//
// Setup module components
//

// Dropzone file uploader
const _componentDropzone = function() {
    if (typeof Dropzone == 'undefined') {
        console.warn('Warning - dropzone.min.js is not loaded.');
        return;
    }

    // Single files
    let dropzoneSingle = new Dropzone("#dropzone_single", {
        url: "#",
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 1, // MB
        maxFiles: 1,
        dictDefaultMessage: 'Drop Gambar atau upload <span>atau KLIK</span>',
        autoProcessQueue: false,
        addRemoveLinks: true,
        init: function() {
            this.on('addedfile', function(file){
                if (this.fileTracker) {
                this.removeFile(this.fileTracker);
            }
                this.fileTracker = file;
            });
        }
    });
};


//
// Return objects assigned to module
//

return {
    init: function() {
        _componentDropzone();
    }
}
}();

// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
DropzoneUploader.init();
});
</script>

<script>
    //-------------------------------------------------------------------------------------------------
    //Ajax Form Store Data
    //-------------------------------------------------------------------------------------------------
    $(document).on('click', '.tambah_jenisStatus', function (e) {
        e.preventDefault();
        var data = {
            'jenisStatusModal': $("input[name='jenisStatusModal']").val(),
            'jenisKeteranganModal': $("textarea[name='keteranganModal']").val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        console.log(data);

        $.ajax({
            method: "POST",
            url: "{{ route('Status.storeStatusType') }}",
            data: data,
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.status == 400) {
                    //console.log(response);
                    $.each(response.errors, function (key, err_value) {
                        //$('#save_msgList').append('<li>' + err_value + '</li>');
                        /*new Noty({
                            text: err_value,
                            type: 'error',
                            modal: true
                        }).show();*/
                    });
                    $('.tambah_jenisStatus').text('Simpan');
                } else {
                    //console.log(response);
                    location.reload();
                    $('#addModalJenis').find("input[name='jenisStatusModal']").val('');
                    $('#addModalJenis').find("textarea[name='keteranganModal']").val('');
                    $('.tambah_jenisStatus').text('Simpan');
                    $('#addModalJenis').modal('hide');
                }
            }
        });
    });

</script>
<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Data Master - <span class="fw-normal">Jemaat</span>
            </h4>
            <a href="#page_header"
                class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>
    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="index.html" class="breadcrumb-item"><i class="ph-house"></i></a>
                <span class="breadcrumb-item">Jemaat</span>
                <a href="{{ route('Status.index') }}" class="breadcrumb-item active">Status</a>
            </div>
            <a href="#breadcrumb_elements"
                class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
        <div class="collapse d-lg-block ms-lg-auto" id="breadcrumb_elements">
        </div>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
    <!-- Wizard with validation -->
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Tambah Jemaat</h6>
        </div>

        <form class="wizard-form steps-validation" action="#">
            <h6>Data Registrasi</h6>
            <fieldset>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Nomor Registrasi: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe">
                            <div class="invalid-feedback">Bank Tidak Boleh Kosong.</div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Registrasi:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ph-calendar"></i>
                                </span>
                                <input type="text" class="form-control datepicker-autohide "
                                    placeholder="Pilih Tanggal">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Nomor Registrasi Sebelumya: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="name1" class="form-control" placeholder="John Doe">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9">
                        <div class="mb-3">
                            <label class="form-label">Lingkungan/Lunggu/Wijk: <span class="text-danger">*</span></label>

                            <div class="input-group">
                                <select data-placeholder="Pilih Lingkungan/Lunggu/Wijk" class="form-control select"
                                    data-width="1%" name="jenisStatus">
                                    <option></option>
                                    <option value="1">Sumatera Utara</option>
                                    <option value="2">DKI Jakarta</option>
                                    <option value="3">NTB</option>
                                </select>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i>
                                </button>
                                <div class="invalid-feedback">Silahkan Pilih Jenis Status.</div>
                            </div>

                            <!--<div class="valid-feedback">Valid feedback</div>-->

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Propinsi:</label>
                            <select data-placeholder="Pilih Propinsi" class="form-control select" name="propinsi">
                                <option></option>
                                <option value="1">Sumatera Utara</option>
                                <option value="2">DKI Jakarta</option>
                                <option value="3">NTB</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Kota/Kabupaten:</label>
                            <select data-placeholder="Pilih Kota/Kabupaten" class="form-control select"
                                name="kotaKabupaten">
                                <option></option>
                                <option value="1">Sumatera Utara</option>
                                <option value="2">DKI Jakarta</option>
                                <option value="3">NTB</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Kecamatan:</label>
                            <select data-placeholder="Pilih Kecamatan" class="form-control select" name="kecamatan">
                                <option></option>
                                <option value="1">Sumatera Utara</option>
                                <option value="2">DKI Jakarta</option>
                                <option value="3">NTB</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Kelurahan/Desa:</label>
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <select data-placeholder="Pilih Kelurahan/Desa" class="form-control select"
                                        name="kelurahanDesa">
                                        <option></option>
                                        <option value="1">Sumatera Utara</option>
                                        <option value="2">DKI Jakarta</option>
                                        <option value="3">NTB</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Alamat: <span class="text-danger">*</span></label>
                            <textarea rows="3" cols="3" name="keteranganModal" class="form-control"
                                placeholder="Masukkan Alamat"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Diwartakan: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ph-calendar"></i>
                                </span>
                                <input type="text" class="form-control datepicker-autohide2"
                                    placeholder="Pilih Tanggal Diwartakan">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <h6>Anggota Keluarga</h6>
            <fieldset>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="mb-3">
                            <label class="form-label">Gelar Depan: <span class="text-danger">*</span></label>
                            <input type="text" name="gelarDepan" placeholder="Gelar Depan" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Nama Depan: <span class="text-danger">*</span></label>
                            <input type="text" name="namaDepan" placeholder="Nama Depan" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Nama Belakang: <span class="text-danger">*</span></label>
                            <input type="text" name="namaBelakang" placeholder="Nama Belakang" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="mb-3">
                            <label class="form-label">Gelar Belakang: <span class="text-danger">*</span></label>
                            <input type="text" name="gelarBelakang" placeholder="Gelar Belakang" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin: <span class="text-danger">*</span></label>
                            <div style="padding-top: 9px; padding-bottom: 10px;">
                                <label class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="gender" checked="">
                                    <span class="form-check-label">Laki-laki</span>
                                </label>

                                <label class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="gender">
                                    <span class="form-check-label">Perempuan</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="mb-3">
                            <label class="form-label">Tempat Lahir: <span class="text-danger">*</span></label>
                            <input type="text" name="tempatLahir" placeholder="Masukkan Tempat Lahir"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ph-calendar"></i>
                                </span>
                                <input type="text" class="form-control datepicker-autohide3"
                                    placeholder="Pilih Tanggal Lahir" name="tanggalLahir">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Pendidikan:</label>
                            <div class="input-group">
                                <select data-placeholder="Pilih Pendidikan" class="form-control select" data-width="1%"
                                    name="pendidikan">
                                    <option></option>
                                    <option value="1">Sumatera Utara</option>
                                    <option value="2">DKI Jakarta</option>
                                    <option value="3">NTB</option>
                                </select>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i>
                                </button>
                                <div class="invalid-feedback">Silahkan Pilih Jenis Status.</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Bidang Pendidikan:</label>
                            <div class="input-group">
                                <select data-placeholder="Pilih Bidang Pendidikan" class="form-control select"
                                    data-width="1%" name="bidangPendidikan">
                                    <option></option>
                                    <option value="1">Sumatera Utara</option>
                                    <option value="2">DKI Jakarta</option>
                                    <option value="3">NTB</option>
                                </select>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i>
                                </button>
                                <div class="invalid-feedback">Silahkan Pilih Jenis Status.</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Bidang Pendidikan Lainnya: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="bidangPendidikanLain"
                                placeholder="Masukkan Bidang Pendidikan Lainnya" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Pekerjaan:</label>
                            <div class="input-group">
                                <select data-placeholder="Pilih Pekerjaan" class="form-control select" data-width="1%"
                                    name="pekerjaan">
                                    <option></option>
                                    <option value="1">Sumatera Utara</option>
                                    <option value="2">DKI Jakarta</option>
                                    <option value="3">NTB</option>
                                </select>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i>
                                </button>
                                <div class="invalid-feedback">Silahkan Pilih Jenis Status.</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Pekerjaan Lainnya: <span class="text-danger">*</span></label>
                            <input type="text" name="pekerjaanLain" placeholder="Masukkan Pekerjaan Lainnya"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Golongan Darah:</label>
                            <div class="input-group">
                                <select data-placeholder="Pilih Golongan Darah" class="form-control select"
                                    data-width="1%" name="golonganDarah">
                                    <option></option>
                                    <option value="1">Sumatera Utara</option>
                                    <option value="2">DKI Jakarta</option>
                                    <option value="3">NTB</option>
                                </select>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i>
                                </button>
                                <div class="invalid-feedback">Silahkan Pilih Jenis Status.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Ponsel/WhatsApp <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="nomorPonsel" placeholder="Masukkan Nomor Ponsel/WhatsApp"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan: <span class="text-danger">*</span></label>
                                    <textarea rows="8" cols="3" name="keterangan" class="form-control"
                                        placeholder="Masukkan Keterangan"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Foto Anggota Jemaat:</label>
                            <div class="dropzone" id="dropzone_single" style="display: flex;justify-content: center;">

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="addAnggota"><i
                                class="ph-plus-circle"></i><span class="d-none d-lg-inline-block ms-2">Tambah Anggota
                                Keluarga</span>
                        </button>
                    </div>
                    <div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-xs mt-2" id="tblAnggota">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="col-md-3">Nama Lengkap</th>
                                            <th class="col-md-2">Jenis Kelamin</th>
                                            <th class="col-md-2">Tanggal Lahir</th>
                                            <th class="col-md-3">Hubungan Keluarga</th>
                                            <th class="col-md-3">Foto</th>
                                            <th class="col-md-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text">

                                    </tbody>
                                </table>
                                </br>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <h6>Pernikahan</h6>
            <fieldset>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Suami: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select data-placeholder="Pilih Suami" class="form-control select" data-width="1%"
                                    name="suami">
                                    <option></option>
                                    <option value="1">Sumatera Utara</option>
                                    <option value="2">DKI Jakarta</option>
                                    <option value="3">NTB</option>
                                </select>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i>
                                </button>
                                <div class="invalid-feedback">Silahkan Pilih Jenis Status.</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Istri: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select data-placeholder="Pilih Istri" class="form-control select" data-width="1%"
                                    name="istri">
                                    <option></option>
                                    <option value="1">Sumatera Utara</option>
                                    <option value="2">DKI Jakarta</option>
                                    <option value="3">NTB</option>
                                </select>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i>
                                </button>
                                <div class="invalid-feedback">Silahkan Pilih Jenis Status.</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Menikah: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ph-calendar"></i>
                                </span>
                                <input type="text" class="form-control datepicker-autohide4"
                                    placeholder="Pilih Tanggal Menikah" name="tanggalMenikah">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="mb-3">
                            <label class="form-label">HKBP/Non HKBP <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline" style="padding-top: 9px; padding-bottom: 9px;">
                                <input type="checkbox" class="form-check-input" id="cc_li_c" checked>
                                <label class="form-check-label" for="cc_li_c">HKBP</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="mb-3">
                            <label class="form-label">Gereja HKBP: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select data-placeholder="Pilih Gereja HKBP" class="form-control select" data-width="1%"
                                    name="istri">
                                    <option></option>
                                    <option value="1">Sumatera Utara</option>
                                    <option value="2">DKI Jakarta</option>
                                    <option value="3">NTB</option>
                                </select>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i>
                                </button>
                                <div class="invalid-feedback">Silahkan Pilih Jenis Status.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="mb-3">
                            <label class="form-label">Gereja Non HKBP: <span class="text-danger">*</span></label>
                            <input type="text" name="gerejaNonHKBP" placeholder="Masukkan Nama Gereja Non HKBP"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Pendeta Yang Memberkati: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="namaPendeta" placeholder="Masukkan Nama Pendeta yang Memberkati"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Nats Pernikahan: <span class="text-danger">*</span></label>
                            <textarea rows="3" cols="3" name="natsPernikahan" class="form-control"
                                placeholder="Masukkan Nats Pernikahan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Keterangan: <span class="text-danger">*</span></label>
                            <textarea rows="3" cols="3" name="keteranganPernikahan" class="form-control"
                                placeholder="Masukkan Keterangan"></textarea>
                        </div>
                    </div>
                </div>
            </fieldset>

            <h6>Kelengkapan Administrasi</h6>
            <fieldset>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Dokumen:</label>
                            <select data-placeholder="Pilih Dokumen" class="form-control select" name="namaDokumen">
                                <option></option>
                                <option value="1">Sumatera Utara</option>
                                <option value="2">DKI Jakarta</option>
                                <option value="3">NTB</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Upload Dokumen:</label>
                            <input type="file" class="form-control" name="fileDokumen">
                            <span class="form-text text-muted">Format Dokumen: pdf, doc. Maksimum ukuran file 5Mb</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Keterangan:</label>
                            <textarea name="keteranganDokumen" rows="3" cols="5" placeholder="Masukkan Keterangan"
                                class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="addDokumen"><i
                                class="ph-plus-circle"></i><span class="d-none d-lg-inline-block ms-2">Tambah
                                Dokumen</span>
                        </button>
                    </div>
                    <div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-xs mt-2" id="tblDokumen">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="col-md-3">Nama Dokumen</th>
                                            <th class="col-md-2">Nama File</th>
                                            <th class="col-md-2">Keterangan</th>
                                            <th class="col-md-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text">

                                    </tbody>
                                </table>
                                </br>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <!-- /wizard with validation -->

</div>
<!-- /content area -->

{{-- Tambah Modal --}}
<div id="addModalJenis" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jenis Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="tambahJenisStatusForm" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <ul id="save_msgList"></ul>
                        <div class="row mb-2">
                            <label class="col-lg-4 col-form-label">Jenis Status<span class="text-danger">
                                    *</span></label>
                            <div class="col-lg-7">
                                <input type="text" name="jenisStatusModal" class="form-control"
                                    placeholder="Masukkan Jenis Status" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-lg-4 col-form-label">Keterangan</label>
                            <div class="col-lg-7">
                                <textarea rows="3" cols="3" name="keteranganModal" class="form-control"
                                    placeholder="Masukkan Keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary tambah_jenisStatus">Simpan <i
                            class="ph-check-circle ms-2"></i></button>
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal <i
                            class="ph-x-circle ms-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
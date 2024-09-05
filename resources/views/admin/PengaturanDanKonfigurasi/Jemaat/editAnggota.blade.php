@extends('layouts.admin.template')
@section('content')
<script>
    const DatatableBasic = function () {
        const _componentDatatableBasic = function () {
            if (!$().DataTable) {
                console.warn('Warning - datatables.min.js is not loaded.');
                return;
            }

            // Setting datatable defaults
            $.extend($.fn.dataTable.defaults, {
                autoWidth: false,
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [3]
                }],
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                    searchPlaceholder: 'Type to filter...',
                    lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                    paginate: {
                        'first': 'First',
                        'last': 'Last',
                        'next': document.dir == "rtl" ? '&larr;' : '&rarr;',
                        'previous': document.dir == "rtl" ? '&rarr;' : '&larr;'
                    }
                }
            });

            // Basic datatable
            $('.datatable-basic').DataTable();

            // Alternative pagination
            $('.datatable-pagination').DataTable({
                pagingType: "simple",
                language: {
                    paginate: {
                        'next': document.dir == "rtl" ? 'Next &larr;' : 'Next &rarr;',
                        'previous': document.dir == "rtl" ? '&rarr; Prev' : '&larr; Prev'
                    }
                }
            });

            // Datatable with saving state
            $('.datatable-save-state').DataTable({
                stateSave: true
            });

            // Scrollable datatable
            const table = $('.datatable-scroll-y').DataTable({
                autoWidth: true,
                scrollY: 300
            });

            // Resize scrollable table when sidebar width changes
            $('.sidebar-control').on('click', function () {
                table.columns.adjust().draw();
            });
        };

        //
        // Return objects assigned to module
        //
        return {
            init: function () {
                _componentDatatableBasic();
            }
        }
    }();

    // Initialize module
    // ------------------------------
    document.addEventListener('DOMContentLoaded', function () {
        DatatableBasic.init();
    });
</script>
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

    const DropzoneUploader = function () {


        //
        // Setup module components
        //

        // Dropzone file uploader
        const _componentDropzone = function () {
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
                init: function () {
                    this.on('addedfile', function (file) {
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
            init: function () {
                _componentDropzone();
            }
        }
    }();

    // Initialize module
    // ------------------------------

    document.addEventListener('DOMContentLoaded', function () {
        DropzoneUploader.init();
    });
</script>

<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Master - <span class="fw-normal">Jemaat</span>
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
                <span class="breadcrumb-item">Data Master</span>
                <a href="{{ route('Status.index') }}" class="breadcrumb-item active">Jemaat</a>
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

    <!-- Data Pribadi Anggota Jemaat-->
    <div class="card">
        <div class="card-header d-lg-flex">
            <h5 class="mb-0">Data Pribadi</h5>
        </div>
        <div class="card-body">
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
                        <input type="text" name="tempatLahir" placeholder="Masukkan Tempat Lahir" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="ph-calendar"></i>
                            </span>
                            <input type="text" class="form-control datepicker-autohide"
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
                        <label class="form-label">Bidang Pendidikan Lainnya: <span class="text-danger">*</span></label>
                        <input type="text" name="bidangPendidikanLain" placeholder="Masukkan Bidang Pendidikan Lainnya"
                            class="form-control">
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
                            <select data-placeholder="Pilih Golongan Darah" class="form-control select" data-width="1%"
                                name="golonganDarah">
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
                        <div style="display: flex;justify-content: center;">
                                <div class="card-img-actions d-inline-block mb-3">
                                    <img class="img-fluid"
                                        src="{{ asset('admin_resources/assets/images/general/no_picture.png') }}"
                                        width="200" height="220" alt="" id="previewFoto">
                                    <div class="card-img-actions-overlay card-img square">
                                        <button type="button" class="btn btn-outline-white btn-icon rounded-pill"
                                            onclick="javascript:document.getElementById('fotoJemaat').click();">
                                            <i class="ph-pencil"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{route('Jemaat.index')}}">
                <button type="submit" class="btn btn-primary">Simpan<i class="ph-check-circle ms-2"></i></button>
            </a>
            <button type="reset" class="btn btn-danger">Batal<i class="ph-x-circle ms-2"></i></button>
        </div>
    </div>
    <!-- /Data Pribadi Anggota Jemaat -->

    <!-- Data Baptis Anggota Jemaat-->
    <div class="card">
        <div class="card-header d-lg-flex">
            <h5 class="mb-0">Data Baptis</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat Baptis: <span class="text-danger">*</span></label>
                        <input type="text" name="noSuratBaptis" placeholder="Masukkan Nomor Surat Baptis"
                            class="form-control">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Baptis: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="ph-calendar"></i>
                            </span>
                            <input type="text" class="form-control datepicker-autohide2"
                                placeholder="Pilih Tanggal Baptis" name="tanggalBaptis">
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
                                name="gerejaHKBPBaptis">
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
                        <input type="text" name="gerejaNonHKBPBaptis" placeholder="Masukkan Nama Gereja Non HKBP"
                            class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Pendeta Yang Memberkati: <span class="text-danger">*</span></label>
                        <input type="text" name="namaPendetaBaptis" placeholder="Masukkan Nama Pendeta yang Memberkati"
                            class="form-control">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Upload Surat Baptis:</label>
                        <input type="file" class="form-control" name="fileDokumenBaptis">
                        <span class="form-text text-muted">Format Dokumen: pdf, doc. Maksimum ukuran file 5Mb</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Nats Baptis: <span class="text-danger">*</span></label>
                        <textarea rows="3" cols="3" name="natsBaptis" class="form-control"
                            placeholder="Masukkan Nats Baptis"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Keterangan: <span class="text-danger">*</span></label>
                        <textarea rows="3" cols="3" name="keteranganBaptis" class="form-control"
                            placeholder="Masukkan Keterangan"></textarea>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-footer text-end">
            <a href="{{route('Jemaat.index')}}">
                <button type="submit" class="btn btn-primary">Simpan<i class="ph-check-circle ms-2"></i></button>
            </a>
            <button type="reset" class="btn btn-danger">Batal<i class="ph-x-circle ms-2"></i></button>
        </div>
    </div>
    <!-- /Data Baptis Anggota Jemaat -->

    <!-- Data Sidi Anggota Jemaat-->
    <div class="card">
        <div class="card-header d-lg-flex">
            <h5 class="mb-0">Data Sidi</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat Sidi: <span class="text-danger">*</span></label>
                        <input type="text" name="noSuratSidi" placeholder="Masukkan Nomor Surat Baptis"
                            class="form-control">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Sidi: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="ph-calendar"></i>
                            </span>
                            <input type="text" class="form-control datepicker-autohide3"
                                placeholder="Pilih Tanggal Sidi" name="tanggalSidi">
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
                                name="gerejaSidi">
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
                        <input type="text" name="gerejaNonHKBPSidi" placeholder="Masukkan Nama Gereja Non HKBP"
                            class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Pendeta Yang Memberkati: <span class="text-danger">*</span></label>
                        <input type="text" name="namaPendetaSidi" placeholder="Masukkan Nama Pendeta yang Memberkati"
                            class="form-control">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Upload Surat Sidi:</label>
                        <input type="file" class="form-control" name="fileDokumenSidi">
                        <span class="form-text text-muted">Format Dokumen: pdf, doc. Maksimum ukuran file 5Mb</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Nats Sidi: <span class="text-danger">*</span></label>
                        <textarea rows="3" cols="3" name="natsSidi" class="form-control"
                            placeholder="Masukkan Nats Baptis"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Keterangan: <span class="text-danger">*</span></label>
                        <textarea rows="3" cols="3" name="keteranganSidi" class="form-control"
                            placeholder="Masukkan Keterangan"></textarea>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-footer text-end">
            <a href="{{route('Jemaat.index')}}">
                <button type="submit" class="btn btn-primary">Simpan<i class="ph-check-circle ms-2"></i></button>
            </a>
            <button type="reset" class="btn btn-danger">Batal<i class="ph-x-circle ms-2"></i></button>
        </div>
    </div>
    <!-- /Data Baptis Anggota Jemaat -->

</div>
<!-- /content area -->


{{--
<script src="{{ asset('admin_resources/assets/js/vendor/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('admin_resources/assets/demo/pages/form_select2.js') }}"></script>
<script src="{{ asset('admin_resources/assets/demo/pages/components_modals.js') }}"></script> --}}

<script>
    function clearModalContent() {
        var selectElement = document.querySelector('#modal_default_tab3 select');
        selectElement.selectedIndex = 0; // Resets the select element
        var selectElement = document.getElementById('jenisKartuIdentitas');
        selectElement.selectedIndex = 0; // Reset the select element

        var inputElements = document.querySelectorAll(
            '#modal_default_tab3 input:not([type="submit"]):not([type="reset"])');
        inputElements.forEach(function (input) {
            if (input.type === 'file') {
                input.value = ''; // Resets the file input
                document.getElementById('preview').style.display = 'none'; // Hide the preview image
            } else {
                input.value = ''; // Resets other input elements
            }
        });
    }

    document.querySelector('#modal_default_tab3 .btn-danger').addEventListener('click', clearModalContent);

    document.addEventListener('click', function (event) {
        var modal = document.getElementById('modal_default_tab3');
        var isClickInsideModal = modal.contains(event.target);

        if (!isClickInsideModal && window.getComputedStyle(modal).display !== 'none') {
            clearModalContent();
        }
    });
</script>
{{--
<script src="{{ asset('admin_resources/demo/pages/form_layouts.js')}}"></script> --}}
@endsection
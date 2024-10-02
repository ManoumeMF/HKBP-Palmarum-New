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

        var dataDokumenKelengkapan = {!! json_encode(Session::get('dokumenKelengkapan')) !!};
        var fotoPath = {!! json_encode(url('storage/')) !!};

        var len = dataDokumenKelengkapan.length;
        for (var i = 0; i < len; i++) {
            console.log(dataDokumenKelengkapan[i]["nama_jenis_dokumen"]);

            $("#tblDokumen tbody").append('<tr>' +
                '<td>' +
                '<div class="fw-semibold">' + dataDokumenKelengkapan[i]["nama_jenis_dokumen"] + '</div>' +
                '</td>' +
                '<td>' +
                '<div class="fw-semibold">  <a download="' + dataDokumenKelengkapan[i]["fileName"] + '" href="' + fotoPath + '/' + dataDokumenKelengkapan[i]["file_dokumen"] + '" title="' + dataDokumenKelengkapan[i]["fileName"] + '">' + dataDokumenKelengkapan[i]["fileName"] + '</a></div>' +
                '</td>' +
                '<td>' +
                '<div class="fw-semibold">' + dataDokumenKelengkapan[i]["keterangan_dokumen"] + '</div>' +
                '</td>' +
                '<td  style="text-align: center">' +
                '<a href="#"class="btn btn-flat-danger btn-icon w-24px h-24px rounded-pill" id="delAnggota"><i class="ph-x ph-sm"></i></a>' +
                '</td>' +
                '</tr>');
        }
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#previewFoto').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#fotoJemaat").change(function () {
            readURL(this);
        });
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

    <!-- Data Kelengkapan Administrasi Jemaat-->
    <div class="card">
        <div class="card-header d-lg-flex">
            <h5 class="mb-0">Langkah 4: Kelengkapan Administrasi</h5>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <form action="{{route('Jemaat.storeDokumenKelengkapan')}}" method="post" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Dokumen: <span class="text-danger">*</span></label>
                                <select data-placeholder="Pilih Dokumen" class="form-select form-select-sm select"
                                    name="namaDokumen" id="dokumenKelengkapan">
                                    <option></option>
                                    @foreach ($dokumen as $dK)
                                        <option value="{{ $dK->id_jenis_dokumen }}">
                                            {{ $dK->nama_jenis_dokumen }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Upload Dokumen: <span class="text-danger">*</span></label>
                                <input type="file" class="form-control form-control-sm" name="fileDokumen"
                                    id="fileDokumen">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Keterangan: <span class="text-danger">*</span></label>
                                <textarea rows="3" cols="2" name="keteranganDokumen" id="keteranganDokumen"
                                    class="form-control" placeholder="Masukkan Keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="tblDokumen"><i
                                    class="ph-plus-circle"></i><span class="d-none d-lg-inline-block ms-2">Tambah
                                    Dokumen</span>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-xs mt-2" id="tblDokumen">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="col-md-3">Nama Dokumen</th>
                                            <th class="col-md-2">Nama File</th>
                                            <th class="col-md-2">Keterangan</th>
                                            <th class="col-md-1" width="10px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer d-flex align-items-start flex-wrap">
            <!--<div class="col-lg-6">
                <button type="button" class="btn btn-light"> <i
                        class="ph-arrow-circle-left me-2"></i>Sebelumnya</button>
            </div>-->
            <div class="col-lg-6 ms-lg-auto text-end">
                <button type="button" class="btn btn-primary">
                    <a href="{{ route('Jemaat.finishRegistrasiJemaat') }}" style="color:inherit">Selesai <i
                    class="ph-check-circle ms-2"></i></a>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- /content area -->
@endsection
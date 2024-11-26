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

        //saat pilihan no registrasi di pilih, maka akan mengambil data anggota jemaat menggunakan ajax
        $('#noRegistrasi').on('change', function () {
            var id = $(this).val();

            if (id) {
                var data = {
                    'idJemaat': id,
                }

                $.ajax({
                    url: "{{ route('DropdownLokasi.jemaat_combobox') }}",
                    type: "GET",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            $('#jemaat').empty();
                            $('#jemaat').prop('disabled', false);
                            $('#jemaat').append('<option hidden>Pilih Jemaat</option>');
                            $.each(data, function (key, jemaat) {
                                $('#jemaat').append('<option value="' + jemaat.id_jemaat + '">' + jemaat.namaLengkap + '</option>');
                            });
                        } else {
                            $('#jemaat').empty();
                        }
                    }
                });
            } else {
                $('#jemaat').empty();
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

        };


        //
        // Return objects assigned to module
        //
        return {
            init: function () {
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

<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Adminstrasi Gereja - <span class="fw-normal">Jemaat Lahir</span>
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
                <span class="breadcrumb-item">Adminstrasi Gereja</span>
                <span class="breadcrumb-item">Jemaat Lahir</span>
                <a href="{{ route('JemaatLahir.index') }}" class="breadcrumb-item active">Tambah Jemaat Lahir</a>
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
<<div class="content">
    <!-- Basic layout -->
    <div class="card" style="height:100%;">
        <div class="card-header">
            <h5 class="mb-0">Tambah Jemaat Lahir</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{route('JemaatLahir.store')}}" method="post" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label class="form-label">Nama Keluarga: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select data-placeholder="Pilih Jenis Kegiatan" class="form-control select"
                                            data-width="1%" name="namaKeluarga" id="namaKeluarga" required>
                                            <option></option>
                                        </select>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addModalRegistrasi"><i class="ph-plus-circle"></i>
                                        </button>
                                        <div class="invalid-feedback">Nama Keluarga Tidak Boleh Kosong</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="mb-3">
                                    <label class="form-label">Nama Bayi: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="namaBayi" class="form-control" id="namaBayi"
                                            placeholder="Masukkan Nama Bayi">
                                        <div class="invalid-feedback">Nama Bayi Tidak Boleh Kosong!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin: <span class="text-danger">*</span></label>
                                    <div style="padding-top: 9px; padding-bottom: 10px;">
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="gender" value="L">
                                            <span class="form-check-label">Laki-laki</span>
                                        </label>

                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="gender" value="P">
                                            <span class="form-check-label">Perempuan</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="ph-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control datepicker-autohide"
                                            placeholder="Pilih Tanggal" name="tanggalLahir" id="tanggalLahir"
                                            required>
                                        <div class="invalid-feedback">Tanggal Kegiatan Tidak Boleh Kosong.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label class="form-label">Tempat Lahir: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="tempatLahir">
                                        <div class="invalid-feedback">Tempat Lahir Tidak Boleh Kosong.</div>
                                    </div>
                                </div>
                            </div><div class="col-lg-7">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Diwartakan:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="ph-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control datepicker-autohide"
                                            placeholder="Pilih Tanggal" name="tanggalDiwartakan" id="tanggalDiwartakan"
                                            required>
                                        <div class="invalid-feedback">Tanggal Diwartakan Tidak Boleh Kosong.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <textarea rows="6" cols="3" name="keterangan" class="form-control"
                                            id="keteranganJemaat" placeholder="Masukkan Keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="text-end">
                <a href="{{route('Majelis.index')}}">
                    <button type="submit" class="btn btn-primary">Simpan<i class="ph-check-circle ms-2"></i></button>
                </a>
                <button type="reset" class="btn btn-danger">Batal<i class="ph-x-circle ms-2"></i></button>
            </div>
            </form>
        </div>
    </div>
    </div>
    @endsection
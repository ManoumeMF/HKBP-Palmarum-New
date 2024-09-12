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

    <!-- Data Pribadi Anggota Jemaat-->
    <div class="card">
        <div class="card-header d-lg-flex">
            <h5 class="mb-0">Langkah 3: Pernikahan</h5>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <form action="{{route('Jemaat.storeDataRegistrasi')}}" method="post" class="needs-validation"
                    novalidate>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Menikah: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ph-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control datepicker-autohide"
                                        placeholder="Pilih Tanggal Menikah" name="tanggalMenikah" id="tanggalMenikah">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label class="form-label">HKBP/Bukan HKBP<span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline"
                                    style="padding-top: 9px; padding-bottom: 9px;">
                                    <input type="checkbox" class="form-check-input" id="isHKBP" name="isHKBP" checked>
                                    <label class="form-check-label" for="isHKBP">HKBP</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Gereja HKBP: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select data-placeholder="Pilih Gereja HKBP" class="form-control select"
                                        data-width="1%" name="gerejaHKBP" id="gerejaHKBP">
                                        <option></option>
                                        @foreach ($gereja as $gR)
                                            <option value="{{ $gR->id_gereja }}">
                                                {{ $gR->nama_gereja }}
                                            </option>
                                        @endforeach
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
                                <label class="form-label">Gereja Non HKBP: <span class="text-danger">*</span></label>
                                <input type="text" name="gerejaNonHKBP" id="gerejaNonHKBP"
                                    placeholder="Masukkan Nama Gereja Non HKBP" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Pendeta Yang Memberkati: <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="namaPendeta" id="namaPendeta"
                                    placeholder="Masukkan Nama Pendeta yang Memberkati" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Nats Pernikahan: <span class="text-danger">*</span></label>
                                <textarea rows="3" cols="3" name="natsPernikahan" class="form-control"
                                    id="natsPernikahan" placeholder="Masukkan Nats Pernikahan"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Keterangan: <span class="text-danger">*</span></label>
                                <textarea rows="3" cols="2" name="keteranganPernikahan" id="keteranganPernikahan"
                                    class="form-control" placeholder="Masukkan Keterangan"></textarea>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
        <div class="card-footer d-flex align-items-start flex-wrap">
            <div class="col-lg-6">
                <button type="button" class="btn btn-light"> <i
                        class="ph-arrow-circle-left me-2"></i>Sebelumnya</button>
            </div>
            <div class="col-lg-6 ms-lg-auto text-end">
                <button type="button" class="btn btn-primary">Berikutnya <i
                        class="ph-arrow-circle-right ms-2"></i></button>
            </div>
        </div>
        </form>
    </div>
    <!-- /Data Pribadi Anggota Jemaat -->



</div>
<!-- /content area -->
@endsection
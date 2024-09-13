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
            <h5 class="mb-0">Langkah 2: Anggota Keluarga</h5>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <form action="{{route('Jemaat.storeDataRegistrasi')}}" method="post" class="needs-validation"
                    novalidate>
                    {{ csrf_field() }}
                    <input type="hidden" name="idRegistrasi" value="{{ $idRegistrasi }}">
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
                                <input type="text" name="gelarBelakang" placeholder="Gelar Belakang"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
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
                                    <select data-placeholder="Pilih Pendidikan" class="form-control select"
                                        data-width="1%" name="pendidikan" id="pendidikan">
                                        <option></option>
                                        @foreach ($pendidikan as $pD)
                                            <option value="{{ $pD->id_pendidikan }}">
                                                {{ $pD->pendidikan }}
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
                                <label class="form-label">Bidang Pendidikan:</label>
                                <div class="input-group">
                                    <select data-placeholder="Pilih Bidang Pendidikan" class="form-control select"
                                        data-width="1%" name="bidangPendidikan" id="bidangPendidikan">
                                        <option></option>
                                        @foreach ($bidangPendidikan as $bP)
                                            <option value="{{ $bP->id_bidang_pendidikan }}">
                                                {{ $bP->nama_bidang_pendidikan }}
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
                                    <select data-placeholder="Pilih Pekerjaan" class="form-control select"
                                        data-width="1%" name="pekerjaan" id="pekerjaan">
                                        <option></option>
                                        @foreach ($pekerjaan as $pK)
                                            <option value="{{ $pK->id_pekerjaan }}">
                                                {{ $pK->pekerjaan }}
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
                                        data-width="1%" name="golonganDarah" id="golonganDarah">
                                        <option></option>
                                        @foreach ($golonganDarah as $gD)
                                            <option value="{{ $gD->id_gol_darah }}">
                                                {{ $gD->golongan_darah }}
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
                    </div>

                    <div class="row">
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Hubungan Dalam:</label>
                                        <div class="input-group">
                                            <select data-placeholder="Pilih Hubungan Keluarga"
                                                class="form-control select" data-width="1%" name="hubunganKeluarga"
                                                id="hubunganKeluarga">
                                                <option></option>
                                                @foreach ($hubunganKeluarga as $hK)
                                                    <option value="{{ $hK->id_hub_keluarga }}">
                                                        {{ $hK->nama_hub_keluarga }}
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
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Ponsel/WhatsApp <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="nomorPonsel"
                                            placeholder="Masukkan Nomor Ponsel/WhatsApp" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Keterangan: <span class="text-danger">*</span></label>
                                        <textarea rows="6" cols="3" name="keterangan" class="form-control"
                                            id="keteranganJemaat" placeholder="Masukkan Keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label" style="display: flex;justify-content: center;">Foto Anggota
                                    Jemaat:</label>
                                <div style="display: flex;justify-content: center;">
                                    <div class="card-img-actions d-inline-block mb-3">
                                        <img class="img-fluid"
                                            src="{{ asset('admin_resources/assets/images/general/no_picture.png') }}"
                                            width="180" height="100%" alt="" id="previewFoto">
                                        <div class="card-img-actions-overlay card-img square">
                                            <button type="button" class="btn btn-outline-white btn-icon rounded-pill"
                                                onclick="javascript:document.getElementById('fotoJemaat').click();">
                                                <i class="ph-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <input id="fotoJemaat" type="file" style='visibility: hidden;' name="fotoJemaat" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="addAnggota"><i
                                    class="ph-plus-circle"></i><span class="d-none d-lg-inline-block ms-2">Tambah
                                    Anggota Keluarga</span>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-xs mt-2" id="tblAnggota">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="col-md-3">Nama Lengkap</th>
                                            <th class="col-md-2">Jenis Kelamin</th>
                                            <th class="col-md-2">Tanggal Lahir</th>
                                            <th class="col-md-3">Hubungan Keluarga</th>
                                            <th class="col-md-1" style="width:10px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text">

                                    </tbody>
                                </table>
                                </br>
                            </div>
                        </div>
                    </div>
                </form>
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
    </div>
    <!-- /Data Pribadi Anggota Jemaat -->



</div>
<!-- /content area -->
@endsection
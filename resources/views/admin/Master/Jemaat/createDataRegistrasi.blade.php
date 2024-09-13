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


        //saat pilihan provinsi di pilih, maka akan mengambil data kota menggunakan ajax
        $('#provinsi').on('change', function () {
            var id = $(this).val();

            if (id) {
                var data = {
                    'idProvinsi': id,
                }

                $.ajax({
                    url: "{{ route('DropdownLokasi.kota') }}",
                    type: "GET",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            $('#kota').empty();
                            //$("#kota>optgroup>option[value='1']").removeAttr('disabled');
                            $('#kota').prop('disabled', false);
                            //$('#kota').append('<option hidden>Choose Course</option>');
                            $.each(data, function (key, kota) {
                                $('#kota').append('<option value="' + kota.city_id + '">' + kota.city_name + '</option>');
                            });
                        } else {
                            $('#kota').empty();
                        }
                    }
                });
            } else {
                $('#kota').empty();
            }
        });

        //saat pilihan kota di pilih, maka akan mengambil data kota menggunakan ajax
        $('#kota').on('change', function () {
            var idK = $(this).val();

            if (idK) {
                var data = {
                    'idKota': idK,
                }

                $.ajax({
                    url: "{{ route('DropdownLokasi.kecamatan') }}",
                    type: "GET",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            $('#kecamatan').empty();
                            $('#kecamatan').prop('disabled', false);
                            $.each(data, function (key, kecamatan) {
                                $('#kecamatan').append('<option value="' + kecamatan.dis_id + '">' + kecamatan.dis_name + '</option>');
                            });
                        } else {
                            $('#kecamatan').empty();
                        }
                    }
                });
            } else {
                $('#kecamatan').empty();
            }
        });

        //saat pilihan kecamatan di pilih, maka akan mengambil data kota menggunakan ajax
        $('#kecamatan').on('change', function () {
            var idKel = $(this).val();

            if (idKel) {
                var data = {
                    'idKelurahan': idKel,
                }

                $.ajax({
                    url: "{{ route('DropdownLokasi.kelurahan') }}",
                    type: "GET",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            $('#kelurahan').empty();
                            $('#kelurahan').prop('disabled', false);
                            $.each(data, function (key, kelurahan) {
                                $('#kelurahan').append('<option value="' + kelurahan.subdis_id + '">' + kelurahan.subdis_name + '</option>');
                            });
                        } else {
                            $('#kelurahan').empty();
                        }
                    }
                });
            } else {
                $('#kelurahan').empty();
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
            <h5 class="mb-0">Langkah 1: Data Registrasi Jemaat</h5>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <form action="{{route('Jemaat.storeDataRegistrasi')}}" method="post" class="needs-validation"
                    novalidate>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Nomor Registrasi: <span class="text-danger">*</span></label>
                                <input type="text" name="noRegistrasi" class="form-control"
                                    placeholder="Masukkan Nomor Registrasi" required>
                                <div class="invalid-feedback">Nomor Registrasi Tidak Boleh Kosong.</div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Registrasi:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ph-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control datepicker-autohide"
                                        placeholder="Pilih Tanggal" name="tanggalRegistrasi" id="tanggalRegistrasi"
                                        required>
                                    <div class="invalid-feedback">Tanggal Registrasi Tidak Boleh Kosong.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Nomor Registrasi Sebelumya (Jika Ada): <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="noRegistrasiSebelumnya" class="form-control"
                                    id="noRegistrasiSebelumnya" placeholder="Masukkan Nomor Registrasi">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="form-label">Nama Keluarga: <span class="text-danger">*</span></label>
                                <input type="text" name="namaKeluarga" class="form-control" id="namaKeluarga"
                                    placeholder="Masukkan Nomor Registrasi" required>
                                <div class="invalid-feedback">Nama Keluarga Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Lingkungan/Lunggu/Wijk: <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select data-placeholder="Pilih Lingkungan/Lunggu/Wijk" class="form-control select"
                                        data-width="1%" name="wijk" id="wijk" required>
                                        <option></option>
                                        @foreach ($wijk as $wK)
                                            <option value="{{ $wK->id_wijk }}">
                                                {{ $wK->nama_wijk }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i>
                                    </button>
                                    <div class="invalid-feedback">Silahkan Pilih Lingkungan/Lunggu/Wijk.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Propinsi:</label>
                                <select data-placeholder="Pilih Propinsi" class="form-control select" name="propinsi"
                                    id="provinsi" required>
                                    <option></option>
                                    @foreach ($provinces as $pV)
                                        <option value="{{ $pV->prov_id }}">
                                            {{ $pV->prov_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Silahkan Pilih Propinsi.</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Kota/Kabupaten:</label>
                                <select data-placeholder="Pilih Kota/Kabupaten" class="form-control select" id="kota"
                                    name="kotaKabupaten" required>
                                    <option></option>
                                </select>
                                <div class="invalid-feedback">Silahkan Pilih Kota/Kabupaten.</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Kecamatan:</label>
                                <select data-placeholder="Pilih Kecamatan" class="form-control select" name="kecamatan"
                                    id="kecamatan" required>
                                    <option></option>
                                </select>
                                <div class="invalid-feedback">Silahkan Pilih Kecamatan.</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Kelurahan/Desa:</label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <select data-placeholder="Pilih Kelurahan/Desa" class="form-control select"
                                            name="kelurahan" id="kelurahan" required>
                                            <option></option>
                                        </select>
                                        <div class="invalid-feedback">Silahkan Pilih Kelurahan/Desa.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Alamat: <span class="text-danger">*</span></label>
                                <textarea rows="3" cols="3" name="alamat" class="form-control" id="alamat"
                                    placeholder="Masukkan Alamat" required></textarea>
                            </div>
                            <div class="invalid-feedback">Alamat Tidak Boleh Kosong.</div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon: <span class="text-danger">*</span></label>
                                <input type="text" name="nomorTelepon" class="form-control" id="nomorTelepon"
                                    placeholder="Masukkan Nomor Telepon" required>
                                <div class="invalid-feedback">Nama Keluarga Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Diwartakan: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ph-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control datepicker-autohide2"
                                        name="tanggalDiwartakan" id="tanggalDiwartakan"
                                        placeholder="Pilih Tanggal Diwartakan" required>
                                        <div class="invalid-feedback">Tanggal Diwartakan Tidak Boleh Kosong.</div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Berikutnya <i class="ph-arrow-circle-right ms-2"></i></button>
        </div>
        </form>
    </div>
    <!-- /Data Pribadi Anggota Jemaat -->
</div>
<!-- /content area -->
@endsection
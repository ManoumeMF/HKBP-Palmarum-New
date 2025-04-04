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
                    targets: [1]
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
                });
            }

            const dpAutoHideElement2 = document.querySelector('.datepicker-autohide2');
            if (dpAutoHideElement2) {
                const dpAutoHide2 = new Datepicker(dpAutoHideElement2, {
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
                <span class="breadcrumb-item">Master</span>
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

    <!-- Course overview -->
    <div class="card" style="min-height: 500px;">
        <div class="card-header d-lg-flex">
            <h5 class="mb-0">Edit Jemaat</h5>
        </div>

        <div class="nav-tabs-responsive">
            <ul class="nav nav-tabs nav-tabs-underline flex-nowrap mb-0">
                <li class="nav-item">
                    <a href="#data-registrasi" class="nav-link active" data-bs-toggle="tab">
                        <i class="ph-list me-2"></i>
                        Data Registrasi
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#anggota_keluarga" class="nav-link" data-bs-toggle="tab">
                        <i class="ph-users-three me-2"></i>
                        Anggota Keluarga
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#pernikahan" class="nav-link" data-bs-toggle="tab">
                        <i class="ph-calendar me-2"></i>
                        Pernikahan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#dokumen-kelengkapan" class="nav-link" data-bs-toggle="tab">
                        <i class="ph-archive me-2"></i>
                        Kelengkapan Adminstrasi
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="data-registrasi">
                <div class="card-body">
                    <!--<div class="mt-1 mb-4">
                        <h6>Data Registrasi</h6>
                    </div>-->

                    <form action="" method="post" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Registrasi: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Masukkan Nomor Registrasi"
                                        value="{{ $registrasiJemaat->no_registrasi }}">
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
                                        <input type="text" class="form-control datepicker-autohide"
                                            placeholder="Pilih Tanggal" value="{{ $registrasiJemaat->tgl_registrasi }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Registrasi Sebelumya: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name1" class="form-control" placeholder="John Doe"
                                        value="{{ $registrasiJemaat->no_register_sebelumnya }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label">Nama Keluarga: <span class="text-danger">*</span></label>
                                    <input type="text" name="namaKeluarga" class="form-control" id="namaKeluarga"
                                        value="{{ $registrasiJemaat->nama_keluarga }}"
                                        placeholder="Masukkan Nomor Registrasi" required>
                                    <div class="invalid-feedback">Nama Keluarga Tidak Boleh Kosong.</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Lingkungan/Lunggu/Wijk: <span
                                            class="text-danger">*</span></label>

                                    <div class="input-group">
                                        <select data-placeholder="Pilih Lingkungan/Lunggu/Wijk"
                                            class="form-control select" data-width="1%" name="wijk" id="wijk" required>
                                            <option></option>
                                            @foreach ($wijk as $wK)
                                                <option value="{{ $wK->id_wijk }}" {{ $wK->id_wijk === $registrasiJemaat->id_wijk ? 'selected' : '' }}>
                                                    {{ $wK->nama_wijk }}
                                                </option>
                                            @endforeach
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
                                    <select data-placeholder="Pilih Propinsi" class="form-control select"
                                        name="propinsi" id="provinsi" required>
                                        <option></option>
                                        @foreach ($provinces as $pV)
                                            <option value="{{ $pV->prov_id }}" {{  $pV->prov_id === $registrasiJemaat->prov_id ? 'selected' : '' }}>
                                                {{ $pV->prov_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Kota/Kabupaten:</label>
                                    <select data-placeholder="Pilih Kota/kabupaten" class="form-control select"
                                        name="kota" id="kotaKabupaten" required>
                                        <option></option>
                                        @foreach ($kota as $kT)
                                            <option value="{{ $kT->city_id }}" {{  $kT->city_id === $registrasiJemaat->city_id ? 'selected' : '' }}>
                                                {{ $kT->city_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Kecamatan:</label>
                                    <select data-placeholder="Pilih Kecamatan" class="form-control select"
                                        name="kecamatan" id="kecamatan" required>
                                        <option></option>
                                        @foreach ($kecamatan as $kC)
                                            <option value="{{ $kC->dis_id }}" {{  $kC->dis_id === $registrasiJemaat->dis_id ? 'selected' : '' }}>
                                                {{ $kC->dis_name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                                @foreach ($kelurahan as $kL)
                                                    <option value="{{ $kL->subdis_id }}" {{  $kL->subdis_id === $registrasiJemaat->subdis_id ? 'selected' : '' }}>
                                                        {{ $kL->subdis_name }}
                                                    </option>
                                                @endforeach
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
                                    <textarea rows="3" cols="3" name="alamat" class="form-control"
                                        placeholder="Masukkan Alamat">{{ $registrasiJemaat->alamat }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon: <span class="text-danger">*</span></label>
                                    <input type="text" name="nomorTelepon" class="form-control" id="nomorTelepon"
                                        value="{{ $registrasiJemaat->no_telepon }}" placeholder="Masukkan Nomor Telepon"
                                        required>
                                    <div class="invalid-feedback">Nama Keluarga Tidak Boleh Kosong.</div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Diwartakan: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="ph-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control datepicker-autohide2"
                                            value="{{ $registrasiJemaat->tgl_warta }}"
                                            placeholder="Pilih Tanggal Diwartakan">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="card-footer text-end">
                    <a href="{{route('Jemaat.index')}}">
                        <button type="submit" class="btn btn-primary">Simpan<i
                                class="ph-check-circle ms-2"></i></button>
                    </a>
                    <button type="reset" class="btn btn-danger">Batal<i class="ph-x-circle ms-2"></i></button>
                </div>

                </form>
            </div>

            <div class="tab-pane fade" id="anggota_keluarga">
                <div class="card-body">
                    <div class="mt-1 mb-4">
                        <h6>Data Anggota Keluarga</h6>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="addAnggota"><i
                                    class="ph-plus-circle"></i><span class="d-none d-lg-inline-block ms-2">Tambah
                                    Anggota
                                    Keluarga</span>
                            </button>
                        </div>
                    </div>
                    <table id="jemaatTable" class="table datatable-basic table-striped">
                        <thead>
                            <tr>
                                <th class="col-md-3">Nama Lengkap</th>
                                <th class="col-md-3">Tanggal Lahir</th>
                                <th class="col-md-3">Umur</th>
                                <th class="col-md-1">Baptis</th>
                                <th class="col-md-1">Sidi</th>
                                <th class="col-md-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($anggotaJemaat) && count($anggotaJemaat) > 0)
                                @foreach ($anggotaJemaat as $aT)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="user_pages_profile_tabbed.html" class="d-block me-3">
                                                    <img src="{{ asset('admin_resources/assets/images/demo/users/face1.jpg') }}"
                                                        width="40" height="40" class="rounded-circle" alt="">
                                                </a>

                                                <div class="flex-fill">
                                                    <a href="user_pages_profile_tabbed.html"
                                                        class="fw-semibold">{{ $aT->namaLengkap }}</a>
                                                    <div class="fs-sm text-muted">
                                                        @if($aT->jenis_kelamin == 'L')
                                                            Laki-laki - {{ $aT->nama_hub_keluarga }}
                                                        @else
                                                            Perempuan - {{ $aT->nama_hub_keluarga }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ date('d F Y', strtotime($aT->tanggal_lahir)) }}</td>
                                        <td>{{ $aT->umur }}</td>
                                        <td>
                                            @if($aT->isBaptis === 1)
                                                <i class="ph-check text-success"></i>
                                            @else
                                                <i class="ph-x text-danger"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($aT->isSidi === 1)
                                                <i class="ph-check text-success"></i>
                                            @else
                                                <i class="ph-x text-danger"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex">
                                                <div class="dropdown">
                                                    <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                        <i class="ph-list"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <button type="button" value=""
                                                            class="dropdown-item text-info detailBtn">
                                                            <i class="ph-list me-2"></i>Detail
                                                        </button>
                                                        <button type="button" value="" class="dropdown-item text-secondary">
                                                            <a href="{{ route('Jemaat.editAnggota', 0) }}"
                                                                style="color:inherit"><i class="ph-pencil me-2"></i>
                                                                Edit</a>
                                                        </button>
                                                        <button type="button" value=""
                                                            class="dropdown-item text-danger deleteBtn">
                                                            <i class="ph-trash me-2"></i>Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="pernikahan">
                <div class="card-body">
                    <div class="mt-1 mb-4">
                        <h6>Data Pernikahan</h6>
                    </div>

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
                                <div class="form-check form-check-inline"
                                    style="padding-top: 9px; padding-bottom: 9px;">
                                    <input type="checkbox" class="form-check-input" id="cc_li_c" checked>
                                    <label class="form-check-label" for="cc_li_c">HKBP</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label class="form-label">Gereja HKBP: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select data-placeholder="Pilih Gereja HKBP" class="form-control select"
                                        data-width="1%" name="istri">
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
                                <input type="text" name="namaPendeta"
                                    placeholder="Masukkan Nama Pendeta yang Memberkati" class="form-control">
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
                </div>

                <div class="card-footer text-end">
                    <a href="{{route('Jemaat.index')}}">
                        <button type="submit" class="btn btn-primary">Simpan<i
                                class="ph-check-circle ms-2"></i></button>
                    </a>
                    <button type="reset" class="btn btn-danger">Batal<i class="ph-x-circle ms-2"></i></button>
                </div>
            </div>

            <div class="tab-pane fade" id="dokumen-kelengkapan">
                <div class="card-body">
                    <div class="mt-1 mb-4">
                        <h6>Kelengkapan Adminstrasi</h6>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="addDokumen"><i
                                    class="ph-plus-circle"></i><span class="d-none d-lg-inline-block ms-2">Tambah
                                    Dokumen</span>
                            </button>
                        </div>
                        <table id="jemaatTable" class="table datatable-basic table-striped">
                            <thead>
                                <tr>
                                    <th class="col-md-3">Nama Dokumen</th>
                                    <th class="col-md-4">Nama File</th>
                                    <th class="col-md-4">Keterangan</th>
                                    <th class="col-md-1" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nama Dokumen</td>
                                    <td>Nama File</td>
                                    <td>Keterangan</td>
                                    <td class="text-center">
                                        <div class="d-inline-flex">
                                            <div class="dropdown">
                                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                    <i class="ph-list"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <button type="button" value=""
                                                        class="dropdown-item text-info detailBtn">
                                                        <i class="ph-list me-2"></i>Detail
                                                    </button>
                                                    <button type="button" value="" class="dropdown-item text-secondary">
                                                        <a href="" style="color:inherit"><i class="ph-pencil me-2"></i>
                                                            Edit</a>
                                                    </button>
                                                    <button type="button" value=""
                                                        class="dropdown-item text-danger deleteBtn">
                                                        <i class="ph-trash me-2"></i>Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- /course overview -->

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
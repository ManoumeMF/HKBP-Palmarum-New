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

    const dataAnggota = [];
    const dataDokumen = [];
    const reader = new FileReader();

    // Setup module
    // ------------------------------
    const FormWizard = function () {
        //
        // Setup module components
        //

        // Wizard
        const _componentWizard = function () {
            if (!$().steps) {
                console.warn('Warning - steps.min.js is not loaded.');
                return;
            }
            //
            // Wizard with validation
            //

            // Stop function if validation is missing
            if (!$().validate) {
                console.warn('Warning - validate.min.js is not loaded.');
                return;
            }

            // Show form
            const validationExampleElement = $('.steps-validation');
            const form = validationExampleElement.show();


            // Initialize wizard
            validationExampleElement.steps({
                headerTag: 'h6',
                bodyTag: 'fieldset',
                titleTemplate: '<span class="number">#index#</span> #title#',
                labels: {
                    previous: document.dir == 'rtl' ? '<i class="ph-arrow-circle-right me-2"></i>Sebelumnya' : '<i class="ph-arrow-circle-left me-2"></i>Sebelumnya',
                    next: document.dir == 'rtl' ? 'Next <i class="ph-arrow-circle-left ms-2"></i>' : 'Berikutnya <i class="ph-arrow-circle-right ms-2"></i>',
                    finish: 'Simpan <i class="ph-paper-plane-tilt ms-2"></i>'
                },
                transitionEffect: 'fade',
                autoFocus: true,
                onStepChanging: function (event, currentIndex, newIndex) {

                    // Allways allow previous action even if the current form is not valid!
                    if (currentIndex > newIndex) {
                        return true;
                    }

                    // Needed in some cases if the user went back (clean up)
                    if (currentIndex < newIndex) {

                        // To remove error styles
                        form.find('.body:eq(' + newIndex + ') label.error').remove();
                        form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                    }

                    form.validate().settings.ignore = ':disabled,:hidden';
                    return form.valid();
                },
                onFinishing: function (event, currentIndex) {
                    form.validate().settings.ignore = ':disabled';
                    return form.valid();
                },
                onFinished: function (event, currentIndex) {
                    //alert('Submitted!');

                    let namaDokumen = document.getElementsByName('namaDokumen[]');
                    let fileDokumen = document.getElementsByName('fileDokumen[]');
                    let keteranganDok = document.getElementsByName('keteranganDokumen[]');

                    for (let i = 0; i < namaDokumen.length; i++) {
                        dataDokumen[i] = {
                            'namaDokumen': namaDokumen[i].value,
                            'fileDokumen': fileDokumen[i].files[0],
                            'keteranganDokumen': keteranganDok[i].value,
                        }
                    }

                    //console.log(dataDokumen);
                    var isHKBP = 0;

                    $('input:checkbox[name=isHKBP]').each(function () {
                        if ($(this).is(':checked'))
                            isHKBP = 1;
                    });

                    var dataRegistrasiJemaat = {
                        'NoRegistrasi': $("input[name='noRegistrasi']").val(),
                        'TanggalRegistrasi': $("input[name='tanggalRegistrasi']").val(),
                        'NoRegistrasiSebelumnya': $("input[name='noRegistrasiSebelumnya']").val(),
                        'NamaKeluarga': $("input[name='namaKeluarga']").val(),
                        'Wijk': $("#wijk option:selected").val(),
                        'IdKelurahan': $("#kelurahan option:selected").val(),
                        'Alamat': $('textarea#alamat').val(),
                        'TanggalDiwartakan': $("input[name='tanggalDiwartakan']").val(),
                        'TanggalMenikah': $("input[name='tanggalMenikah']").val(),
                        'isHKBP': isHKBP,
                        'GerejaHKBP': $("#gerejaHKBP option:selected").val(),
                        'GerejaNonHKBP': $("input[name='gerejaNonHKBP']").val(),
                        'NamaPendeta': $("input[name='namaPendeta']").val(),
                        'NatsPernikahan': $('textarea#natsPernikahan').val(),
                        'KeteranganPernikahan': $('textarea#keteranganPernikahan').val(),
                        'DataAnggotaJemaat': dataAnggota,
                    }

                    //-------------------------------------------------------------------------------------------------
                    //Ajax Form Store Data
                    //-------------------------------------------------------------------------------------------------
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    //var dataRegistrasi = JSON.parse(JSON.stringify(dataRegistrasiJemaat));

                    //dataRegistrasi.fd.append('dataAnggota', dataAnggota);
                    //dataRegistrasi.fd.append('kelengkapanDokumen', dataDokumen);

                    $.ajax({
                        method: "POST",
                        url: "{{ route('Jemaat.store') }}",
                        data: JSON.parse(JSON.stringify(dataRegistrasiJemaat)),
                        success: function (response) {
                            if (response.status == 400) {
                                console.log(response);
                                $.each(response.errors, function (key, err_value) {
                                    //$('#save_msgList').append('<li>' + err_value + '</li>');
                                    /*new Noty({
                                        text: err_value,
                                        type: 'error',
                                        modal: true
                                    }).show();*/
                                });
                            } else {
                                new Noty({
                                    text: response.message,
                                    type: 'success',
                                    modal: true
                                }).show();

                                setTimeout("window.location='{{ route('Jemaat.index') }}'", 1500);
                            }
                        }

                    });

                    console.log(dataRegistrasiJemaat);

                    //console.log(isHKBP);
                }
            });


            // Initialize validation
            validationExampleElement.validate({
                ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
                errorClass: 'validation-invalid-label',
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },

                // Different components require proper error label placement
                errorPlacement: function (error, element) {

                    // Input with icons and Select2
                    if (element.hasClass('select2-hidden-accessible')) {
                        error.appendTo(element.parent());
                    }

                    // Input group, form checks and custom controls
                    else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                        error.appendTo(element.parent().parent());
                    }

                    // Other elements
                    else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    email: {
                        email: true
                    }
                }
            });
        };
        //
        // Return objects assigned to module
        //

        return {
            init: function () {
                _componentWizard();
            }
        }
    }();

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
                    format: 'j F Y'
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
                    format: 'j F Y'
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
                    format: 'j F Y'
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
                    format: 'j F Y'
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

        FormWizard.init();
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

        //Function Clear Form Add Anggota Keluarga
        $.fn.clearFormAnggotaKeluarga = function () {
            return this.each(function () {
                $("input[name='gelarDepan']").val("");
                $("input[name='namaDepan']").val("");
                $("input[name='namaBelakang']").val("");
                $("input[name='gelarBelakang']").val("");
                $("input[type=radio][name=gender]").prop('checked', false);
                $("input[name='tempatLahir']").val("");
                $("input[name='tanggalLahir']").val("");
                $("#pendidikan").val('').trigger('change')
                $("#pendidikan").val('').trigger('change')
                $("input[name='bidangPendidikanLain']").val("");
                $("#pekerjaan").val('').trigger('change')
                $("input[name='pekerjaanLain']").val("");
                $("#golonganDarah").val('').trigger('change');
                $("#hubunganKeluarga").val('').trigger('change');
                $("input[name='nomorPonsel']").val("");
                $("textarea#keteranganJemaat").val("");
                //$("#fotoJemaat").val("");
                $('#previewFoto').attr('src', '{{ asset('admin_resources/assets/images/general/no_picture.png') }}');
            });
        };

        var index = 0;

        // jQuery button click event to add Anggota Keluarga row
        $("#addAnggota").on("click", function () {

            var fileInput = $('input[name="fotoJemaat"]')[0];
            var fileFoto = fileInput.files[0];

            //Read the file as a binary string
            reader.readAsBinaryString(fileFoto);

            reader.onload = function (event) {
                var filePhotoContent = event.target.result;

                var filePhotoVar = filePhotoContent;

                dataAnggota[index] = {
                    'gelarDepan': $("input[name='gelarDepan']").val(),
                    'namaDepan': $("input[name='namaDepan']").val(),
                    'namaBelakang': $("input[name='namaBelakang']").val(),
                    'gelarBelakang': $("input[name='namaBelakang']").val(),
                    'jenisKelamin': $('input[name="gender"]:checked').val(),
                    'tempatLahir': $("input[name='tempatLahir']").val(),
                    'tanggalLahir': $("input[name='tanggalLahir']").val(),
                    'tanggalLahir': $("input[name='tanggalLahir']").val(),
                    'pendidikan': $("#pendidikan option:selected").val(),
                    'bidangPendidikan': $("#bidangPendidikan option:selected").val(),
                    'bidangPendidikanLain': $("input[name='bidangPendidikanLain']").val(),
                    'pekerjaan': $("#pekerjaan option:selected").val(),
                    'pekerjaanLain': $("input[name='pekerjaanLain']").val(),
                    'golonganDarah': $("#golonganDarah option:selected").val(),
                    'hubunganKeluarga': $("#hubunganKeluarga option:selected").val(),
                    'nomorPonsel': $("input[name='nomorPonsel']").val(),
                    'keterangan': $('textarea#keteranganJemaat').val(),
                    'fileFoto': filePhotoVar,
                }

                index++;
            };

            var namaLengkap = $("input[name='gelarDepan']").val() + ' ' + $("input[name='namaDepan']").val() + ' ' + $("input[name='namaBelakang']").val() + ' ' + $("input[name='namaBelakang']").val();
            if ($('input[name="gender"]:checked').val() == "L") {
                var jenisKelamin = "Laki-laki";
            } else {
                var jenisKelamin = "Perempuan";
            }
            var hubKeluarga = $("#hubunganKeluarga option:selected").text();
            // Adding a row inside the tbody.
            $("#tblAnggota tbody").append('<tr>' +
                '<td class="rowIndex">' +
                (index) +
                '</td>' +
                '<td>' +
                namaLengkap +
                '</td>' +
                '<td>' +
                jenisKelamin +
                '</td>' +
                '<td>' +
                $("input[name='tanggalLahir']").val() +
                '</td>' +
                '<td>' +
                hubKeluarga +
                '</td>' +
                '<td  style="text-align: center">' +
                '<a href="#"class="btn btn-flat-danger btn-icon w-24px h-24px rounded-pill" id="delAnggota"><i class="ph-x ph-sm"></i></a>' +
                '</td>' +
                '</tr>');

            $('#formJemaat').clearFormAnggotaKeluarga();

            //console.log(dataAnggota);
            //console.log(dropzoneSingle.files[1]);
        });

        $(document).on('click', '#delAnggota', function () {
            var idx = $(this).closest('tr').index();
            dataAnggota.splice(idx, 1);
            $(this).closest('tr').remove();

            console.log(dataAnggota);
            return false;
        });



        // jQuery button click event to add Anggota Keluarga row
        $("#addDokumen").on("click", function () {
            // Adding a row inside the tbody.
            $("#tblDokumen tbody").append('<tr>' +
                '<td>' +
                '<select data-placeholder="Pilih Dokumen" class="form-select form-select-sm" name="namaDokumen[]" id="dokumenKelengkapan">' +
                '<option></option>' +
                '@foreach ($dokumen as $dK)' +
                    '<option value="{{ $dK->id_jenis_dokumen }}">' +
                    '{{ $dK->nama_jenis_dokumen }}' +
                    '</option>' +
                '@endforeach' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<input type="file" class="form-control form-control-sm" name="fileDokumen[]" id="fileDokumen">' +
                '</td>' +
                '<td>' +
                '<textarea name="keteranganDokumen[]" rows="1" cols="5" placeholder="Masukkan Keterangan" class="form-control form-control-sm" id="keteranganDokumen"></textarea>' +
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

        <form class="wizard-form steps-validation" action="#" id="formJemaat" method="post">
            {{ csrf_field() }}
            <h6>Data Registrasi</h6>
            <fieldset>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Nomor Registrasi: <span class="text-danger">*</span></label>
                            <input type="text" name="noRegistrasi" class="form-control"
                                placeholder="Masukkan Nomor Registrasi">
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
                                <input type="text" class="form-control datepicker-autohide " placeholder="Pilih Tanggal"
                                    name="tanggalRegistrasi" id="tanggalRegistrasi">
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
                    <div class="col-lg-9">
                        <div class="mb-3">
                            <label class="form-label">Nama Keluarga: <span class="text-danger">*</span></label>
                            <input type="text" name="namaKeluarga" class="form-control" id="namaKeluarga"
                                placeholder="Masukkan Nomor Registrasi">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Lingkungan/Lunggu/Wijk: <span class="text-danger">*</span></label>

                            <div class="input-group">
                                <select data-placeholder="Pilih Lingkungan/Lunggu/Wijk" class="form-control select"
                                    data-width="1%" name="wijk" id="wijk">
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
                            <select data-placeholder="Pilih Propinsi" class="form-control select" name="propinsi"
                                id="provinsi">
                                <option></option>
                                @foreach ($provinces as $pV)
                                    <option value="{{ $pV->prov_id }}">
                                        {{ $pV->prov_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Kota/Kabupaten:</label>
                            <select data-placeholder="Pilih Kota/Kabupaten" class="form-control select" id="kota"
                                name="kotaKabupaten">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Kecamatan:</label>
                            <select data-placeholder="Pilih Kecamatan" class="form-control select" name="kecamatan"
                                id="kecamatan">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Kelurahan/Desa:</label>
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <select data-placeholder="Pilih Kelurahan/Desa" class="form-control select"
                                        name="kelurahan" id="kelurahan">
                                        <option></option>
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
                            <textarea rows="3" cols="3" name="alamat" class="form-control" id="alamat"
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
                                <input type="text" class="form-control datepicker-autohide2" name="tanggalDiwartakan"
                                    id="tanggalDiwartakan" placeholder="Pilih Tanggal Diwartakan">
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
                                    name="pendidikan" id="pendidikan">
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
                                <select data-placeholder="Pilih Pekerjaan" class="form-control select" data-width="1%"
                                    name="pekerjaan" id="pekerjaan">
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
                                        <select data-placeholder="Pilih Hubungan Keluarga" class="form-control select"
                                            data-width="1%" name="hubunganKeluarga" id="hubunganKeluarga">
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
                                    <input type="text" name="nomorPonsel" placeholder="Masukkan Nomor Ponsel/WhatsApp"
                                        class="form-control">
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
                                        width="200" height="220" alt="" id="previewFoto">
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
                                            <th class="col-md-3" style="width:10px;">No.</th>
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
                </div>
            </fieldset>

            <h6>Pernikahan</h6>
            <fieldset>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Menikah: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ph-calendar"></i>
                                </span>
                                <input type="text" class="form-control datepicker-autohide4"
                                    placeholder="Pilih Tanggal Menikah" name="tanggalMenikah" id="tanggalMenikah">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="mb-3">
                            <label class="form-label">HKBP/Bukan HKBP<span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline" style="padding-top: 9px; padding-bottom: 9px;">
                                <input type="checkbox" class="form-check-input" id="isHKBP" name="isHKBP" checked>
                                <label class="form-check-label" for="isHKBP">HKBP</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Gereja HKBP: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select data-placeholder="Pilih Gereja HKBP" class="form-control select" data-width="1%"
                                    name="gerejaHKBP" id="gerejaHKBP">
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
                            <textarea rows="3" cols="3" name="natsPernikahan" class="form-control" id="natsPernikahan"
                                placeholder="Masukkan Nats Pernikahan"></textarea>
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
            </fieldset>

            <h6>Kelengkapan Administrasi</h6>
            <fieldset>
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
                                            <th>Nama Dokumen</th>
                                            <th>Nama File</th>
                                            <th>Keterangan</th>
                                            <th width="10px">Aksi</th>
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
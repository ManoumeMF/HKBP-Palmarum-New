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
    });
</script>
<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Pengaturan dan Konfigurasi - <span class="fw-normal">Status</span>
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
                <span class="breadcrumb-item">Pengaturan dan Konfigurasi</span>
                <span class="breadcrumb-item">General</span>
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
    <!-- Basic layout -->
    <div class="card" style="height:100%;">
        <div class="card-header">
            <h5 class="mb-0">Tambah Status</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <form action="{{route('Status.store')}}" method="post" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Jenis Status<span class="text-danger">
                                    *</span></label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <select data-placeholder="Pilih Jenis Status" class="form-control select"
                                        data-width="1%" name="jenisStatus" required>
                                        <option></option>
                                        @foreach ($statusType as $sT)
                                            <option value="{{ $sT->id_jenis_status }}">{{ $sT->jenis_status }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i></button>
                                    <div class="invalid-feedback">Silahkan Pilih Jenis Status.</div>
                                </div>

                                <!--<div class="valid-feedback">Valid feedback</div>-->
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Nama Status<span class="text-danger">
                                    *</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Status" required
                                    name="namaStatus">
                                <div class="invalid-feedback">Status Tidak Boleh Kosong.</div>
                                <!--<div class="valid-feedback">Valid feedback</div>-->
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Keterangan</label>
                            <div class="col-lg-9">
                                <textarea rows="3" cols="3" class="form-control" placeholder="Masukkan Keterangan"
                                    name="keterangan"></textarea>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{route('BidangPendidikan.index')}}">
                                <button type="submit" class="btn btn-primary">Simpan<i
                                        class="ph-check-circle ms-2"></i></button>
                            </a>
                            <button type="reset" class="btn btn-danger">Batal<i class="ph-x-circle ms-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
@extends('layouts.admin.template')

@section('content')
{{-- <script>


</script> --}}
<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Pengaturan dan Konfigurasi - <span class="fw-normal">Gereja</span>
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
                <span class="breadcrumb-item">Organisasi</span>
                <a href="{{ route('Gereja.index') }}" class="breadcrumb-item active">Gereja</a>
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
            <h5 class="mb-0">Tambah Gereja</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <form action="{{route('Gereja.store')}}" method="post" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Ressort<span class="text-danger">
                                    *</span></label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <select data-placeholder="Pilih Gereja" class="form-control select"
                                        data-width="1%" name="ressort" required>
                                        <option></option>
                                        @foreach ($ressort as $rS)
                                        <option value="{{ $rS->id_ressort }}">{{ $rS->nama_ressort }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addModalRessort"><i class="ph-plus-circle"></i></button>
                                    <div class="invalid-feedback">Silahkan Pilih Ressort.</div>
                                </div>
                               </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Jenis Gereja<span class="text-danger">
                                    *</span></label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <select data-placeholder="Pilih Jenis Gereja" class="form-control select"
                                        data-width="1%" name="jenisGereja" required>
                                        <option></option>
                                        @foreach ($chruchType as $cT)
                                        <option value="{{ $cT->id_jenis_gereja }}">{{ $cT->jenis_gereja }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i></button>
                                    <div class="invalid-feedback">Silahkan Pilih Jenis Gereja.</div>
                                </div>
                               </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Nama Gereja<span class="text-danger">
                                    *</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Gereja" required
                                    name="namaGereja">
                                <div class="invalid-feedback">Nama Gereja Tidak Boleh Kosong.</div>
                                <!--<div class="valid-feedback">Valid feedback</div>-->
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Alamat Gereja<span class="text-danger">
                                *</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Alamat Gereja" required
                                    name="alamatGereja">
                                <div class="invalid-feedback">Nama Gereja Tidak Boleh Kosong.</div>
                                <!--<div class="valid-feedback">Valid feedback</div>-->
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Subdistrik<span class="text-danger">
                                    *</span></label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <select data-placeholder="Pilih Subdistrik" class="form-control select"
                                        data-width="1%" name="SubDistrictId" required>
                                        <option></option>
                                        @foreach ($subdistricts as $sD)
                                        <option value="{{ $sD->subdis_id }}">{{ $sD->subdis_name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addModalKelurahan"><i class="ph-plus-circle"></i></button>
                                    <div class="invalid-feedback">Silahkan Pilih Kelurahan.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Nama Pendeta<span class="text-danger">
                                    *</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Pendeta" required
                                    name="namaPendeta">
                                <div class="invalid-feedback">Nama Pendeta Tidak Boleh Kosong.</div>
                                <!--<div class="valid-feedback">Valid feedback</div>-->
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Tanggal Berdiri<span class="text-danger">
                                    *</span></label>
                            <div class="col-lg-9">
                                <input type="date" class="form-control" placeholder="Masukkan Tanggal Berdiri" required
                                    name="tanggalBerdiri">
                                <div class="invalid-feedback">Tanggal Berdiri Tidak Boleh Kosong.</div>
                                <!--<div class="valid-feedback">Valid feedback</div>-->
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
                                <textarea rows="3" cols="3" name="keteranganModal" class="form-control" placeholder="Masukkan Keterangan"></textarea>
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
@extends('layouts.admin.template')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Home - <span class="fw-normal">Dashboard</span>
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
                <a href="#" class="breadcrumb-item">Home</a>
                <span class="breadcrumb-item active">Dashboard</span>
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
            <h5 class="mb-0">Edit Jenis Registrasi</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <form action="{{ route('JenisRegistrasi.update', $jenisRegistrasi->id_jenis_registrasi) }}" method="post" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Nama Jenis Registrasi<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Jenis Registrasi"
                                    required name="nama_jenis_registrasi" value="{{ $jenisRegistrasi->nama_jenis_registrasi }}">
                                <div class="invalid-feedback">Nama Jenis Registrasi Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Sub Jenis Registrasi<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Sub Jenis Registrasi"
                                    required name="sub_jenis_registrasi" value="{{ $jenisRegistrasi->sub_jenis_registrasi }}">
                                <div class="invalid-feedback">Sub Registrasi Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Keterangan:</label>
                            <div class="col-lg-9">
                                <textarea rows="3" cols="3" class="form-control" placeholder="Masukkan Keterangan"
                                    name="keterangan">{{ $jenisRegistrasi->keterangan }}</textarea>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('JenisRegistrasi.index') }}">
                                <button type="submit" class="btn btn-primary">Simpan<i class="ph-check-circle ms-2"></i></button>
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
@endsection

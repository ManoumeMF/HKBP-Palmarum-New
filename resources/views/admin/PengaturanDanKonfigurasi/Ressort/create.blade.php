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
            <h5 class="mb-0">Tambah Ressort</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <form action="{{route('Ressort.store')}}" method="post" class="needs-validation"
                        novalidate>
                        {{ csrf_field() }}
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Distrik<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="id_distrik" class="form-select" required>
                                    <option value="">Pilih Distrik</option>
                                    @foreach($distrik as $d)
                                        <option value="{{ $d->id_distrik }}">{{ $d->nama_distrik }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Distrik Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Kode Ressort<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Kode Ressort" required name="kode_ressort">
                                <div class="invalid-feedback">Kode Ressort Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Nama Ressort<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Ressort" required name="nama_ressort">
                                <div class="invalid-feedback">Nama Ressort Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Alamat<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea rows="3" cols="3" class="form-control" placeholder="Masukkan Alamat" required name="alamat"></textarea>
                                <div class="invalid-feedback">Alamat Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Subdistrict ID<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Subdistrict ID" required name="id_subdis">
                                <div class="invalid-feedback">Subdistrict ID Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Pendeta Ressort<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Pendeta Ressort" required name="pendeta_ressort">
                                <div class="invalid-feedback">Pendeta Ressort Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Tanggal Berdiri<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="date" class="form-control" required name="tgl_berdiri">
                                <div class="invalid-feedback">Tanggal Berdiri Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{route('Ressort')}}">
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
@endsection
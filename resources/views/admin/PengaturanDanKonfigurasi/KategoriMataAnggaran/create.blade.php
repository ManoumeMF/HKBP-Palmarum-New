@extends('layouts.admin.template')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Pengaturan dan Konfigurasi - <span class="fw-normal">Jenis Gereja</span>
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
                <a href="{{ route('KategoriMataAnggaran.index') }}" class="breadcrumb-item active">Kategori Mata Anggaran</a>
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
            <h5 class="mb-0">Tambah Kategori Mata Anggaran</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <form action="{{route('KategoriMataAnggaran.store')}}" method="post" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Induk Kategori Anggaran</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" placeholder="Masukkan Induk Kategori Anggaran" name="IndukKategoriAnggaran">
                                {{-- <div class="invalid-feedback">Induk Kategori Anggaran Tidak Boleh Kosong.</div> --}}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Kode Kategori Anggaran
                                <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Kode Kategori Anggaran" required name="KodeKategoriAnggaran">
                                <div class="invalid-feedback">Kode Kategori Anggaran Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Nama Kategori Anggaran
                                <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Kategori Anggaran" required name="NamaKategoriAnggaran">
                                <div class="invalid-feedback">Nama Kategori Anggaran Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Keterangan</label>
                            <div class="col-lg-9">
                                <textarea rows="3" cols="3" class="form-control" placeholder="Masukkan Keterangan" name="Keterangan"></textarea>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="">
                                <button type="submit" class="btn btn-primary">Simpan<i
                                        class="ph-check-circle ms-2"></i></button>
                            </a>
                            <a href="{{ route("KategoriMataAnggaran.index") }}">
                            <button type="reset" class="btn btn-danger">Batal<i class="ph-x-circle ms-2"></i></button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content area -->
@endsection
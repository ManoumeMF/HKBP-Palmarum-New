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
            <h5 class="mb-0">Edit Ressort</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    @if (isset($ressort))
                    <form action="{{ route('Ressort.update', $ressort->id_ressort) }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Kode Ressort<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Kode Ressort" required value="{{ $ressort->kode_ressort }}" name="kodeRessort">
                                <div class="invalid-feedback">Kode Ressort Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Nama Ressort<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Ressort" required value="{{ $ressort->nama_ressort }}" name="namaRessort">
                                <div class="invalid-feedback">Nama Ressort Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Alamat<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Alamat" required value="{{ $ressort->alamat }}" name="alamat">
                                <div class="invalid-feedback">Alamat Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Subdistrict<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select class="form-select select2" required name="subdistrict" id="subdistrict">
                                    @foreach ($subdistricts as $subdistrict)
                                        <option value="{{ $subdistrict->subdis_id }}" {{ $subdis_id == $subdistrict->subdis_id ? 'selected' : '' }}>
                                            {{ $subdistrict->subdis_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Subdistrict Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Pendeta Ressort<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Pendeta" required value="{{ $ressort->pendeta_ressort }}" name="pendetaRessort">
                                <div class="invalid-feedback">Nama Pendeta Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Tanggal Berdiri<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="date" class="form-control" required value="{{ $ressort->tgl_berdiri }}" name="tglBerdiri">
                                <div class="invalid-feedback">Tanggal Berdiri Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan<i class="ph-check-circle ms-2"></i></button>
                            <a href="{{route('Ressort')}}" class="btn btn-danger">Batal<i class="ph-x-circle ms-2"></i></a>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content area -->
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#subdistrict').select2();
});
</script>
@endsection

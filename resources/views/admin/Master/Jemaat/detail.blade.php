@extends('layouts.admin.template')
@section('content')

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
            <h5 class="mb-0">Detail Data Jemaat</h5>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
               
            </div>
        </div>
    </div>
    <!-- Data Pribadi Anggota Jemaat -->
</div>
<!-- content area -->
@endsection
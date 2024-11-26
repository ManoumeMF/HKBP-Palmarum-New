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
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-primary text-white">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-fill">
                        <h6 class="mb-0">Ulang Tahun Kelahiran</h6>
                        <span class="opacity-75">18 November 24 - 24 November 2024</span>
                    </div>

                    <i class="ph-gift ph-2x ms-3"></i>
                </div>

                <div class="progress bg-primary mb-2" style="height: 0.125rem;">
                    <div class="progress-bar bg-white" style="width: 100%"></div>
                </div>

                <div>
                    <span class="float-end">2 Orang</span>
                    Jumlah
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-purple text-white">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-fill">
                        <h6 class="mb-0">Ulang Tahun Pernikahan</h6>
                        <span class="opacity-75">18 November 24 - 24 November 2024</span>
                    </div>

                    <i class="ph-heart ph-2x ms-3"></i>
                </div>

                <div class="progress bg-purple mb-2" style="height: 0.125rem;">
                    <div class="progress-bar bg-white" style="width: 100%"></div>
                </div>

                <div>
                    <span class="float-end">80%</span>
                    Jumlah
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-success text-white">
                <div class="d-flex align-items-center mb-3">
                    <i class="ph-gear ph-2x me-3"></i>

                    <div class="flex-fill">
                        <h6 class="mb-0">Pemasukan</h6>
                        <span class="opacity-75">November 2024</span>
                    </div>
                </div>

                <div class="progress bg-success mb-2" style="height: 0.125rem;">
                    <div class="progress-bar bg-white" style="width: 100%"></div>
                </div>

                <div>
                    <span class="float-end">Rp. 5.609.000</span>
                    Total Pemasukan
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-danger text-white">
                <div class="d-flex align-items-center mb-3">
                    <i class="ph-activity ph-2x me-3"></i>

                    <div class="flex-fill">
                        <h6 class="mb-0">Pengeluaran</h6>
                        <span class="opacity-75">November 2024</span>
                    </div>
                </div>

                <div class="progress bg-danger mb-2" style="height: 0.125rem;">
                    <div class="progress-bar bg-white" style="width: 100%"></div>
                </div>

                <div>
                    <span class="float-end">Rp. 4.909.000</span>
                    Total Pemasukan
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content area -->
@endsection
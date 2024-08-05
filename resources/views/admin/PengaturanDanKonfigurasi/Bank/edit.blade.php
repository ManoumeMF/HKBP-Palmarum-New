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
            <h5 class="mb-0">Edit Bank</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    @if (isset($bank))
                    <form action="{{ route('Bank.update', $bank->id_bank_gereja) }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Nama Gereja<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="id_gereja" class="form-control" required>
                                    <option value="">Pilih Gereja</option>
                                    @foreach($gerejaList as $gereja)
                                        <option value="{{ $gereja->id_gereja }}" {{ $id_gereja == $gereja->id_gereja ? 'selected' : '' }}>{{ $gereja->nama_gereja }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Nama Gereja Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Nama Bank<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="id_bank" class="form-control" required>
                                    <option value="">Pilih Bank</option>
                                    @foreach($bankList as $bankItem)
                                        <option value="{{ $bankItem->id_bank }}" {{ $id_bank == $bankItem->id_bank ? 'selected' : '' }}>{{ $bankItem->nama_bank }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Nama Bank Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Nama Pemilik<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Pemilik" required value="{{ $bank->nama_pemilik }}" name="namaPemilik">
                                <div class="invalid-feedback">Nama Pemilik Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Nomor Rekening<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Nomor Rekening" required value="{{ $bank->nomor_rekening }}" name="nomorRekening">
                                <div class="invalid-feedback">Nomor Rekening Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Keterangan<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Keterangan" required value="{{ $bank->keterangan }}" name="keterangan">
                                <div class="invalid-feedback">Keterangan Tidak Boleh Kosong.</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan<i class="ph-check-circle ms-2"></i></button>
                            <a href="{{route('Bank')}}" class="btn btn-danger">Batal<i class="ph-x-circle ms-2"></i></a>
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
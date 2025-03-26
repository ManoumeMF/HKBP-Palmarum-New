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
                    <span class="breadcrumb-item active">Permission</span>
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
                <h5 class="mb-0">Role: {{ $role->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-9 offset-lg-1">
                        <form action="{{ url('roles/' . $role->id . '/give-permissions') }}" method="post"
                            class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">Nama Permission<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-9">
                                    <label>
                                        @foreach ($permissions as $permission)
                                            <input type="checkbox" class="form-control" required name="permission[]" value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                            /> {{ $permission->name }}
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="text-end">
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
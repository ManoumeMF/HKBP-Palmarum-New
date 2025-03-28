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
    });
</script>
<script>
        const DatatableBasic = function () {
            const _componentDatatableBasic = function () {
                if (!$().DataTable) {
                    console.warn('Warning - datatables.min.js is not loaded.');
                    return;
                }

                // Setting datatable defaults
                $.extend($.fn.dataTable.defaults, {
                    autoWidth: false,
                    columnDefs: [{
                        orderable: false,
                        width: 100,
                        targets: [0]
                    }],
                    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                    language: {
                        search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                        searchPlaceholder: 'Type to filter...',
                        lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                        paginate: {
                            'first': 'First',
                            'last': 'Last',
                            'next': document.dir == "rtl" ? '&larr;' : '&rarr;',
                            'previous': document.dir == "rtl" ? '&rarr;' : '&larr;'
                        }
                    }
                });

                // Basic datatable
                $('.datatable-basic').DataTable();

                // Alternative pagination
                $('.datatable-pagination').DataTable({
                    pagingType: "simple",
                    language: {
                        paginate: {
                            'next': document.dir == "rtl" ? 'Next &larr;' : 'Next &rarr;',
                            'previous': document.dir == "rtl" ? '&rarr; Prev' : '&larr; Prev'
                        }
                    }
                });

                // Datatable with saving state
                $('.datatable-save-state').DataTable({
                    stateSave: true
                });

                // Scrollable datatable
                const table = $('.datatable-scroll-y').DataTable({
                    autoWidth: true,
                    scrollY: 300
                });

                // Resize scrollable table when sidebar width changes
                $('.sidebar-control').on('click', function () {
                    table.columns.adjust().draw();
                });
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function () {
                    _componentDatatableBasic();
                }
            }
        }();


        // Initialize module
        // ------------------------------

        document.addEventListener('DOMContentLoaded', function () {
            DatatableBasic.init();
        });
    </script>

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
                    <span class="breadcrumb-item active">Hak Akses</span>
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
                <h5 class="mb-0">Tambah Hak Akses</h5>
            </div>
            <div class="card-body">
                <div class="row-mb-3">
                    <div class="col-lg-12">
                        <form action="" method="post"
                            class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                            <label class="col-lg-2 col-form-label">Nama Role<span class="text-danger">
                                    *</span></label>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <select data-placeholder="Pilih Nama Role" class="form-control select"
                                        data-width="1%" name="namaRole" required>
                                        <option></option>
                                        @foreach ($role as $rL)
                                            <option value="{{ $rL->id }}">{{ $rL->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addModalJenis"><i class="ph-plus-circle"></i></button>
                                    <div class="invalid-feedback">Silahkan Pilih Nama Role.</div>
                                </div>

                                <!--<div class="valid-feedback">Valid feedback</div>-->
                            </div>
                            </div>
                            <div class="row mb-3">
                                <table id="permissionTable" class="table datatable-basic table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 10px;">
                                                <input type="checkbox" class="form-check-input" id="cc_lss_u">
                                            </th>
                                            <th>Nama Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($permissions  as $permission)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input" id="cc_lss_u">
                                            </td>
                                            <td>{{ $permission->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
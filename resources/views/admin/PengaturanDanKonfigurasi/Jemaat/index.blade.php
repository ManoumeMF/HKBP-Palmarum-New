@extends('layouts.admin.template')
@section('content')
<script>
const DatatableBasic = function() {
    const _componentDatatableBasic = function() {
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
                targets: [6]
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
        $('.sidebar-control').on('click', function() {
            table.columns.adjust().draw();
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDatatableBasic();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    DatatableBasic.init();
});

//=================================================================================================
//CRUD AJAX
//=================================================================================================

//-------------------------------------------------------------------------------------------------
//Ajax Form Detail Data
//-------------------------------------------------------------------------------------------------
$(document).on('click', '.detailBtn', function(e) {
    e.preventDefault();

    var fe_id = $(this).val();

    $("#detailModal").modal('show');

    $.ajax({
        method: "GET",
        url: "{{ route('Bank.detail') }}",
        data: {
            id: fe_id
        },
        success: function(response) {
            //console.log(response);
            if (response.status == 404) {
                new Noty({
                    text: response.message,
                    type: 'warning',
                    modal: true
                }).show();
                $('#editModal').modal('hide');
            } else {
                //console.log(response.fieldBank.nama_bank)
                $('#detail_nama_bank').text(response.fieldBank
                    .nama_bank);
                $('#detail_keterangan').text(response.fieldBank.keterangan);
            }
        }
    });
    //$('.detail-btn-close').find('input', 'textarea').val('');
});

//-------------------------------------------------------------------------------------------------
//Ajax Form Delete Data
//-------------------------------------------------------------------------------------------------
$(document).on('click', '.deleteBtn', function(e) {
    var fe_id = $(this).val();

    $('#deleteModal').modal('show');
    $('#deleting_id').val(fe_id);
});

//-------------------------------------------------------------------------------------------------
//Ajax Delete Data
//-------------------------------------------------------------------------------------------------
$(document).on('click', '.delete_bank', function(e) {
    e.preventDefault();

    var id = $('#deleting_id').val();

    var data = {
        'idBank': id,
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    console.log(id);

    $.ajax({
        type: "DELETE",
        url: "{{ route('Bank.delete') }}",
        data: data,
        dataType: "json",
        success: function(response) {
            if (response.status == 400) {
                //$('#save_msgList').html("");
                //$('#save_msgList').addClass('alert alert-danger');
                $.each(response.errors, function(key, err_value) {
                    //$('#save_msgList').append('<li>' + err_value + '</li>');
                    new Noty({
                        text: err_value,
                        type: 'error',
                        modal: true
                    }).show();
                });
                $('.delete_bank').text('Hapus');
            } else {
                //$('#save_msgList').html("");
                //$('#success_message').addClass('alert alert-success');
                //$('#success_message').text(response.message);

                //$('#deleteModal').find('input', 'textarea').val('');
                $('.delete_bank').text('Hapus');
                $('#deleteModal').modal('hide');

                    new Noty({
                        text: response.message,
                        type: 'success',
                        modal: true
                    }).show();

                    setTimeout("window.location='{{ route('Bank.index') }}'", 1500);
            }
        }
    });
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
    <div class="card">
        <div class="card-header d-flex">
            <h5 class="mb-0">Daftar Jemaat</h5>
            <div class="ms-auto">
                <a class="btn btn-primary" href="{{ route('Jemaat.create') }}"><i
                        class="ph-plus-circle"></i><span class="d-none d-lg-inline-block ms-2">Tambah Jemaat Baru</span></a>
            </div>
        </div>
        <table id="bankTable" class="table datatable-basic table-striped">
            <thead>
                <tr>
                    <th>No. Registrasi</th>
                    <th>Nama Keluarga</th>
                    <th>Lingkungan</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Jumlah Anggota</th>
                    <th class="text-center">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($fieldBank) && count($fieldBank) > 0)
                @foreach ($fieldBank as $fB)
                <tr>
                    <td>{{ $fB -> nama_bank }}</td>
                    <td>{{ $fB -> keterangan }}</td>
                    <td class="text-center">
                        <div class="d-inline-flex">
                            <div class="dropdown">
                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                    <i class="ph-list"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <button type="button" value="{{ $fB -> id_bank }}"
                                        class="dropdown-item text-info detailBtn">
                                        <i class="ph-list me-2"></i>Detail
                                    </button>
                                    <button type="button" value="{{ $fB -> id_bank }}"
                                        class="dropdown-item text-secondary">
                                        <a href="{{ route('Bank.edit', $fB -> id_bank) }}"
                                            style="color:inherit"><i class="ph-pencil me-2"></i> Edit</a>
                                    </button>
                                    <button type="button" value="{{ $fB -> id_bank }}"
                                        class="dropdown-item text-danger deleteBtn">
                                        <i class="ph-trash me-2"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- Detail Modal --}}
    <div id="detailModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-2">
                            <label for="detail_nama_bank" class="col-lg-4 col-form-label">
                                Bank:</label>
                            <div class="col-lg-7">
                                <label id="detail_nama_bank" class="col-form-label"></label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="detail_keterangan" class="col-lg-4 col-form-label">Keterangan:</label>
                            <div class="col-lg-7">
                                <label id="detail_keterangan" class="col-form-label"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div id="deleteModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="deleteBankForm">
                    @csrf
                    <div class="modal-body">
                        <h4>Konfirmasi untuk Menghapus Data?</h4>
                        <input type="hidden" id="deleting_id" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary delete_bank">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /content area -->
@endsection
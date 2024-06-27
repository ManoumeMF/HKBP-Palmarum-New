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
                targets: [3]
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
//Ajax Form Store Data
//-------------------------------------------------------------------------------------------------
// $(document).on('click', '.tambah_status', function(e) {
//     e.preventDefault();
//     var data = {
//         'jenisStatus': $("select[name='jenisStatus']").val(),
//         'namaStatus': $("input[name='namaStatus']").val(),
//         'keterangan': $("textarea[name='keterangan']").val(),
//     }

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     console.log(data);

//     $.ajax({
//         method: "POST",
//         url: "{{ route('Status.store') }}",
//         data: data,
//         dataType: "json",
//         contentType: false,
//         cache: false,
//         processData: false,
//         success: function(response) {
//             console.log(response);
//             if (response.status == 400) {
//                 console.log(response);
//                 $.each(response.errors, function(key, err_value) {
//                     new Noty({
//                         text: err_value,
//                         type: 'error',
//                         modal: true
//                     }).show();
//                 });
//                 $('.tambah_status').text('Simpan');
//             } else {
//                 console.log(response);
//                 $('#addModal').find('input', 'textarea', 'select').val('');
//                 $('.tambah_status').text('Simpan');
//                 $('#addModal').modal('hide');

//                 if (document.readyState === 'complete') {
//                     new Noty({
//                         text: response.message,
//                         type: 'success',
//                         modal: true
//                     }).show();
//                 }
//             }
//         }
//     });
// });

// -------------------------------------------------------------------------------------------------
// Ajax Form Detail Data
// -------------------------------------------------------------------------------------------------
$(document).on('click', '.detailBtn', function(e) {
    e.preventDefault();

    var st_id = $(this).val();

    $("#detailModal").modal('show');

    $.ajax({
        method: "GET",
        url: "{{ route('KategoriMataAnggaran.detail') }}",
        data: {
            id: st_id
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
                //console.log(response.fieldEducation.nama_bidang_pendidikan)
                $('#detail_induk_kategori_mata_anggaran').text(response.kategori_mata_anggaran.induk_kategori_anggaran);
                $('#detail_kode_kategori_mata_anggaran').text(response.kategori_mata_anggaran.kode_kategori_anggaran);
                $('#detail_nama_kategori_mata_anggaran').text(response.kategori_mata_anggaran.nama_kategori_Anggaran);
                $('#detail_keterangan').text(response.kategori_mata_anggaran.keterangan);
            }
        }
    });
    //$('.detail-btn-close').find('input', 'textarea').val('');
});

// -------------------------------------------------------------------------------------------------
// Ajax Form Delete Data
// -------------------------------------------------------------------------------------------------
$(document).on('click', '.deleteBtn', function(e) {
    var st_id = $(this).val();

    $('#deleteModal').modal('show');
    $('#deleting_id').val(st_id);
});

// -------------------------------------------------------------------------------------------------
// Ajax Delete Data
// -------------------------------------------------------------------------------------------------
$(document).on('click', '.delete_kategori_mata_anggaran', function(e) {
    e.preventDefault();

    var id = $('#deleting_id').val();

    var data = {
        'IdKategoriMataAnggaran': id,
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "DELETE",
        url: "{{ route('KategoriMataAnggaran.delete') }}",
        data: data,
        dataType: "json",
        success: function(response) {
            if (response.status == 400) {
                //$('#save_msgList').html("");
                //$('#save_msgList').addClass('alert alert-danger');
                $.each(response.errors, function(key, err_value) {
                    //$('#save_msgList').append('<li>' + err_value + '</li>');
                    /*new Noty({
                        text: err_value,
                        type: 'error',
                        modal: true
                    }).show();*/
                });
                $('.delete_kategori_mata_anggaran').text('Hapus');
            } else {
                //$('#save_msgList').html("");
                //$('#success_message').addClass('alert alert-success');
                //$('#success_message').text(response.message);

                //$('#deleteModal').find('input', 'textarea').val('');
                $('.delete_kategori_mata_anggaran').text('Hapus');
                $('#deleteModal').modal('hide');

                new Noty({
                        text: response.message,
                        type: 'success',
                        modal: true
                    }).show();

                    setTimeout("window.location='{{ route('KategoriMataAnggaran.index') }}'", 1500);
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
                Pengaturan dan Konfigurasi - <span class="fw-normal">Kategori Mata Anggaran</span>
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
                <a href="{{ route('JenisGereja.index') }}" class="breadcrumb-item active">Kategori Mata Anggaran</a>
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
            <h5 class="mb-0">Daftar Kategori Mata Anggaran</h5>
            <div class="ms-auto">
            <a class="btn btn-primary" href="{{ route("KategoriMataAnggaran.create") }}"><i
                        class="ph-plus-circle"></i><span class="d-none d-lg-inline-block ms-2">Tambah Baru</span></a>
            </div>
        </div>
        <table id="statusTable" class="table datatable-basic table-striped">
            <thead>
                <tr>
                    <th>Induk Kategori Anggaran</th>
                    <th>Kode Kategori Anggaran</th>
                    <th>Nama Kategori Anggaran</th>
                    <th>Keterangan</th>
                    <th class="text-center">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($kategoriMataAnggaran) && count($kategoriMataAnggaran) > 0)
                @foreach ($kategoriMataAnggaran as $kma)
                <tr>
                    <td>{{ $kma -> induk_kategori_anggaran }}</td>
                    <td>{{ $kma -> kode_kategori_anggaran }}</td>
                    <td>{{ $kma -> nama_kategori_Anggaran }}</td>
                    <td>{{ $kma -> keterangan }}</td>
                    <td class="text-center">
                        <div class="d-inline-flex">
                            <div class="dropdown">
                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                    <i class="ph-list"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <button type="button" value="{{ $kma -> id_kategori_anggaran }}"
                                        class="dropdown-item text-info detailBtn">
                                        <i class="ph-list me-2"></i>Detail
                                    </button>
                                    <button type="button" value="{{ $kma -> id_kategori_anggaran }}"
                                        class="dropdown-item text-secondary">
                                        <a href="{{ route('KategoriMataAnggaran.edit', $kma -> id_kategori_anggaran) }}"
                                            style="color:inherit"><i class="ph-pencil me-2"></i> Edit</a>
                                    </button>
                                    <button type="button" value="{{ $kma -> id_kategori_anggaran }}"
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
                    <h5 class="modal-title">Detail Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-2">
                            <label for="detail_induk_kategori_mata_anggaran" class="col-lg-4 col-form-label">
                                Jenis Gereja:</label>
                            <div class="col-lg-7">
                                <label id="detail_induk_kategori_mata_anggaran" class="col-form-label"></label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="detail_kode_kategori_mata_anggaran" class="col-lg-4 col-form-label">Keterangan:</label>
                            <div class="col-lg-7">
                                <label id="detail_kode_kategori_mata_anggaran" class="col-form-label"></label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="detail_nama_kategori_mata_anggaran" class="col-lg-4 col-form-label">Nama :</label>
                            <div class="col-lg-7">
                                <label id="detail_nama_kategori_mata_anggaran" class="col-form-label"></label>
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
                    <h5 class="modal-title">Hapus Data Kategori Mata Anggaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="deleteKategoriMataAnggaranForm">
                    @csrf
                    <div class="modal-body">
                        <h4>Konfirmasi untuk Menghapus Data?</h4>
                        <input type="hidden" id="deleting_id" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary delete_kategori_mata_anggaran">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /content area -->
@endsection
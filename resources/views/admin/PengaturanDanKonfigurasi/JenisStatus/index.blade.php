@extends('layouts.admin.template')
@section('content')
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
                    targets: [2]
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

    //=================================================================================================
    //CRUD AJAX
    //=================================================================================================

    //-------------------------------------------------------------------------------------------------
    //Ajax Form Store Data
    //-------------------------------------------------------------------------------------------------
    $(document).on('click', '.tambah_jenisStatus', function (e) {
        e.preventDefault();
        var data = {
            'jenisStatus': $("input[name='jenisStatus']").val(),
            'keterangan': $("textarea[name='keterangan']").val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "{{ route('JenisStatus.store') }}",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if(response.status == 400){
                    console.log(response);
                    //$('#save_msgList').html("");
                    //$('#save_msgList').addClass('alert alert-danger');
                    $.each(response.errors, function(key, err_value){
                        //$('#save_msgList').append('<li>' + err_value + '</li>');
                        new Noty({
                            text: err_value,
                            type: 'error',
                            modal: true
                        }).show();
                    });
                    $('.tambah_jenisStatus').text('Simpan');
                }else{
                    console.log(response);
                    //$('#save_msgList').html("");
                    //$('#success_message').addClass('alert alert-success');
                    //$('#success_message').text(response.message);
                    //location.reload();
                    $('#addModal').find('input', 'textarea').val('');
                    $('.tambah_jenisStatus').text('Simpan');
                    $('#addModal').modal('hide');  

                    if(document.readyState === 'complete'){
                        new Noty({
                            text: response.message,
                            type: 'success',
                            modal: true
                        }).show();
                    }                 
                }
            }
        });
    });

    //-------------------------------------------------------------------------------------------------
    //Ajax Form Detail Data
    //-------------------------------------------------------------------------------------------------
    $(document).on('click', '.detailBtn', function (e) {
        e.preventDefault();

        var st_id = $(this).val();

        $("#detailModal").modal('show');

        $.ajax({
            method: "GET",
            url: "{{ route('JenisStatus.detail') }}",
            data: {
                id: st_id
            },
            success: function (response) {
                //console.log(response);
                if(response.status == 404){
                        new Noty({
                            text: response.message,
                            type: 'warning',
                            modal: true
                        }).show();
                        $('#editModal').modal('hide'); 
                }else{
                    //console.log(response.fieldEducation.nama_bidang_pendidikan)
                    $('#detail_jenis_status').text(response.statusType.jenis_status);
                    $('#detail_keterangan').text(response.statusType.keterangan);                        
                }
            }
        });
        //$('.detail-btn-close').find('input', 'textarea').val('');
    });

   //-------------------------------------------------------------------------------------------------
    //Ajax Form Edit Data
    //-------------------------------------------------------------------------------------------------
    $(document).on('click', '.editBtn', function (e) {
        e.preventDefault();

        var st_id = $(this).val();

        $("#editModal").modal('show');

        $.ajax({
            method: "GET",
            url: "{{ route('JenisStatus.edit') }}",
            data: {
                id: st_id
            },
            success: function (response) {
                //console.log(response);
                if(response.status == 404){
                        new Noty({
                            text: response.message,
                            type: 'warning',
                            modal: true
                        }).show();
                        $('#editModal').modal('hide'); 
                }else{
                    console.log(response.statusType)
                    $('#jenisStatusEdit').val(response.statusType.jenis_status);
                    $('#keteranganEdit').val(response.statusType.keterangan);                
                    $('#jenisStatus_id').val(response.statusType.id_jenis_status);                
                }
            }
        });
        $('.btn-close').find('input', 'textarea').val('');
        //$('.btn-close').find('textarea').val('');
    });

    //-------------------------------------------------------------------------------------------------
    //Ajax update Data
    //-------------------------------------------------------------------------------------------------
    $(document).on('click', '.update_jenisStatus', function (e) {
        e.preventDefault();

        var id = $('#jenisStatus_id').val();

        var data = {
            'idJenisStatus': id,
            'jenisStatus': $('#jenisStatusEdit').val(),
            'keterangan': $('#keteranganEdit').val(),
        }

        console.log(data);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",
            url: "{{ route('JenisStatus.update') }}",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 400){
                    //$('#save_msgList').html("");
                    //$('#save_msgList').addClass('alert alert-danger');
                    $.each(response.errors, function(key, err_value){
                        //$('#save_msgList').append('<li>' + err_value + '</li>');
                        new Noty({
                            text: err_value,
                            type: 'error',
                            modal: true
                        }).show();
                    });
                    $('.update_jenisStatus').text('Ubah');
                }else{
                    //$('#save_msgList').html("");
                    //$('#success_message').addClass('alert alert-success');
                    //$('#success_message').text(response.message);
                    
                    $('#editModal').find('input', 'textarea').val('');
                    $('.update_jenisStatus').text('Ubah');
                    $('#editModal').modal('hide');  

                    if(document.readyState == "complete"){
                        new Noty({
                            text: response.message,
                            type: 'success',
                            modal: true
                        }).show();
                    }   
                    
                    location.reload();
                }
            }
        });
    });

    //-------------------------------------------------------------------------------------------------
    //Ajax Form Delete Data
    //-------------------------------------------------------------------------------------------------
    $(document).on('click', '.deleteBtn', function (e) {
        var st_id = $(this).val();

        $('#deleteModal').modal('show');
        $('#deleting_id').val(st_id);
    });

    //-------------------------------------------------------------------------------------------------
    //Ajax Delete Data
    //-------------------------------------------------------------------------------------------------
    $(document).on('click', '.delete_jenisStatus', function (e) {
        e.preventDefault();

        var id = $('#deleting_id').val();

        var data = {
            'idJenisStatus': id,
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        console.log(id);

        $.ajax({
            type: "DELETE",
            url: "{{ route('JenisStatus.delete') }}",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 400){
                    //$('#save_msgList').html("");
                    //$('#save_msgList').addClass('alert alert-danger');
                    $.each(response.errors, function(key, err_value){
                        //$('#save_msgList').append('<li>' + err_value + '</li>');
                        new Noty({
                            text: err_value,
                            type: 'error',
                            modal: true
                        }).show();
                    });
                    $('.delete_jenisStatus').text('Hapus');
                }else{
                    //$('#save_msgList').html("");
                    //$('#success_message').addClass('alert alert-success');
                    //$('#success_message').text(response.message);
                    
                    //$('#deleteModal').find('input', 'textarea').val('');
                    $('.delete_jenisStatus').text('Hapus');
                    $('#deleteModal').modal('hide');  

                    if(document.readyState == "complete"){
                        new Noty({
                            text: response.message,
                            type: 'success',
                            modal: true
                        }).show();
                    }   
                    
                    location.reload();
                }
            }
        });
    });
</script>

<!-- Content area -->
<div class="content">
<div class="card">
    <div class="card-header d-flex">
        <h5 class="mb-0">Daftar Jenis Status</h5>
        <div class="ms-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i
                    class="ph-plus-circle"></i><span class="d-none d-lg-inline-block ms-2">Tambah Baru</span></button>
        </div>
    </div>
    <table id="jenisStatusTable" class="table datatable-basic table-striped">
        <thead>
            <tr>
                <th>Jenis Status</th>
                <th>Keterangan</th>
                <th class="text-center">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($statusType) && count($statusType) > 0)
            @foreach ($statusType as $st)
            <tr>
                <td>{{ $st -> jenis_status }}</td>
                <td>{{ $st -> keterangan }}</td>
                <td class="text-center">
                    <div class="d-inline-flex">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <button type="button" value="{{ $st -> id_jenis_status }}"
                                    class="dropdown-item text-info detailBtn">
                                    <i class="ph-list me-2"></i>Detail
                                </button>
                                <button type="button" value="{{ $st -> id_jenis_status }}"
                                    class="dropdown-item text-secondary editBtn">
                                    <i class="ph-pencil me-2"></i>Edit
                                </button>
                                <button type="button" value="{{ $st -> id_jenis_status }}"
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

{{-- Tambah Modal --}}
<div id="addModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jenis Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="tambahJenisStatusForm">
                @csrf
                <div class="modal-body">
                    <div class="container">
                    <ul id="save_msgList"></ul>
                        <div class="row mb-2">
                            <label class="col-lg-4 col-form-label">Jenis Status:</label>
                            <div class="col-lg-7">
                                <input type="text" name="jenisStatus" class="form-control"
                                    placeholder="Masukkan Jenis Status">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-lg-4 col-form-label">Keterangan:</label>
                            <div class="col-lg-7">
                                <textarea rows="3" cols="3" name="keterangan" class="form-control"
                                    placeholder="Masukkan Keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary tambah_jenisStatus">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Jenis Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editJenisStatusForm">
                @csrf
                <input type="hidden" id="jenisStatus_id" />
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-2">
                            <label class="col-lg-4 col-form-label">Jenis Status:</label>
                            <div class="col-lg-7">
                                <input type="text" id="jenisStatusEdit" name="jenisStatusEdit" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-lg-4 col-form-label">Keterangan:</label>
                            <div class="col-lg-7">
                                <textarea rows="3" cols="3" id="keteranganEdit" name="keteranganEdit"
                                    class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary update_jenisStatus">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Detail Modal --}}
<div id="detailModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Bidang Pendidikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-2">
                        <label for="detail_jenis_status" class="col-lg-4 col-form-label">
                            Bidang Pendidikan:</label>
                        <div class="col-lg-7">
                            <label id="detail_jenis_status" class="col-form-label"></label>
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
                <h5 class="modal-title">Hapus Data Jenis Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="deleteJenisStatusForm">
                @csrf
            <div class="modal-body">
                <h4>Konfirmasi untuk Menghapus Data?</h4>
                <input type="hidden" id="deleting_id" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary delete_jenisStatus">Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- /content area -->
@endsection
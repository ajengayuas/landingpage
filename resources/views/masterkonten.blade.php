@extends('adminlte::page')

@section('title', 'Master Konten')

@section('content_header')
<h2>Konten</h2>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary" id="btntambah">
                    Tambah
                </button><br><br>
                <table class="table table-hover table-bordered table-stripped" id="datatables">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul</th>
                            <th>Alias</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addkonten" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Konten</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="kontenform" name="kontenform" class="form-horizontal" method="post">
                    @csrf
                    <input type="hidden" id="id">
                    <table width="700" align="center">
                        <tr>
                            <td style="padding-left:40px">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" class="form-control" id="judul" placeholder="Judul" name="judul" style="width:400px;">
                                </div>
                                <div class="form-group">
                                    <label>Alias</label>
                                    <input type="text" class="form-control" id="alias" placeholder="Alias" name="alias" style="width:400px;">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="desk" cols="40" rows="5" class="form-control" id="desk" placeholder="Deskripsi"></textarea>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnsimpan">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('listkonten') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'alias',
                    name: 'alias'
                },
                {
                    data: 'desk',
                    name: 'desk'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#btntambah').click(function(e) {
            $('.kode_edit').hide();
            $('#id').val('');
            $('#judul').val('');
            $('#alias').val('');
            $('#desk').val('');
            $('#exampleModalLabel').text('Tambah Konten');
            $('#addkonten').modal({
                show: true,
                backdrop: 'static'
            });
        });

        $('#btnsimpan').click(function(e) {
            $('#btnsimpan').html('<i class="fas fa-hourglass"></i> Please Wait')
            $('#btnsimpan').prop('disabled', true);
            let id = $('#id').val();
            let judul = $('#judul').val();
            let alias = $('#alias').val();
            let desk = $('#desk').val();
            if (judul == '' || judul == null) {
                $('#btnsimpan').html('Simpan')
                $('#btnsimpan').prop('disabled', false);
                notifalert('Judul');
            } else if (alias == '' || alias == null) {
                $('#btnsimpan').html('Simpan')
                $('#btnsimpan').prop('disabled', false);
                notifalert('Alias');
            } else {
                $.ajax({
                    type: "post",
                    url: (id == null || id == '') ? "{!! route('simpankonten') !!}" : "{!! route('updatekonten') !!}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id,
                        'judul': judul,
                        'alias': alias,
                        'desk': desk
                    },
                    dataType: "json",
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: (response.status == 'error') ? 'error' : 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            if (response.status == 'success') {
                                $('#btnsimpan').html('Simpan')
                                $('#btnsimpan').prop('disabled', false);
                                $('#kontenform').trigger("reset");
                                $('#addkonten').modal('hide');
                                $("#datatables").DataTable().ajax.reload(null, false);
                            } else {
                                $('#btnsimpan').html('Simpan');
                                $('#btnsimpan').prop('disabled', false);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Data Gagal Disimpan!',
                            text: 'Cek Data',
                            icon: 'error'
                        });
                        $('#btnsimpan').html('Simpan');
                        $('#btnsimpan').prop('disabled', false);
                        return;
                    }
                });
            }
        });

        $('body').on('click', '#btnedit', function() {
            $('#exampleModalLabel').text('Edit Konten');
            let id = $(this).attr('data-id');
            $.ajax({
                type: "post",
                url: "{!! route('editkonten') !!}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    let datakonten = response.data;
                    $('#id').val(datakonten.id);
                    $('#judul').val(datakonten.judul);
                    $('#alias').val(datakonten.alias);
                    $('#desk').val(datakonten.desk);
                    $('#addkonten').modal({
                        show: true,
                        backdrop: 'static'
                    });
                    $('.kode_edit').show();
                }
            });
        });

        $('body').on('click', '#btndelete', function() {
            let id = $(this).attr('data-id');
            Swal.fire({
                title: 'Perhatian',
                text: "Apakah Anda Yakin Menghapus Data Ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{!! url('hapuskonten') !!}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            Swal.fire({
                                title: response.title,
                                icon: (response.status == 'error') ? 'error' : 'success',
                                text: response.message,
                            }).then((result) => {
                                if (response.status == 'success') {
                                    $("#datatables").DataTable().ajax.reload(null, false);
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Data Gagal Disimpan!',
                                text: 'Cek Data',
                                icon: 'error'
                            });
                            return;
                        }
                    })
                }
            });
        });

        function notifalert(params) {
            Swal.fire({
                title: 'Informasi',
                text: params + ' Tidak Boleh Kosong',
                icon: 'warning'
            });
            return;
        }
    });
</script>
@endpush

@section('css')
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
@stop
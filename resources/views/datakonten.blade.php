@extends('adminlte::page')

@section('title', 'Data Konten')

@section('content_header')
<h2>Data Konten</h2>
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
                            <th>Subjudul</th>
                            <th>Isi</th>
                            <th>Gambar</th>
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
            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" id="kontenform" name="kontenform">
                <div class="modal-body">

                    @csrf
                    <input type="hidden" id="id">
                    <table width="700" align="center">
                        <tr>
                            <td style="padding-left:40px">
                                <div class="form-group">
                                    <label>Judul</label><br>
                                    {!! Form::select('id', $id,$idkonten, array('class' => 'form-control', 'id'=>'idkonten', 'style'=>'width:250px;')) !!}
                                </div>
                                <div class="form-group">
                                    <label>Sub Judul</label>
                                    <input type="text" class="form-control" id="subjudul" placeholder="Sub Judul" name="subjudul" style="width:400px;">
                                </div>
                                <div class="form-group">
                                    <label>Isi</label>
                                    <textarea name="isi" cols="40" rows="5" class="form-control" id="isi" placeholder="Isi"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="block mb-4">
                                        <span class="sr-only">Pilih Gambar</span>
                                        <input type="file" name="image" id="image" class="form-control" />
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnsimpan">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                </div>
            </form>
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
            ajax: "{{ route('listdatakonten') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'subjudul',
                    name: 'subjudul'
                },
                {
                    data: 'isi',
                    name: 'isi'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#btnsimpan').click(function(e) {
            $('#btnsimpan').html('<i class="fas fa-hourglass"></i> Please Wait')
            $('#btnsimpan').prop('disabled', true);
            var id = $('#id').val();
            var idkonten = $('#idkonten').val();
            var subjudul = $('#subjudul').val();
            var isi = $('#isi').val();
            var image = $('#image').prop('files')[0];
            console.log('subjudul', subjudul);

            var formData = new FormData();
            formData.append('fileData', image);
            formData.append('variable1', id);
            formData.append('variable2', idkonten);
            formData.append('variable3', subjudul);
            formData.append('variable4', isi);
            console.log('gambar', image);
            if (idkonten == '' || idkonten == null) {
                $('#btnsimpan').html('Simpan')
                $('#btnsimpan').prop('disabled', false);
                notifalert('Judul');
            } else if (subjudul == '' || subjudul == null) {
                $('#btnsimpan').html('Simpan')
                $('#btnsimpan').prop('disabled', false);
                notifalert('Subjudul');
            } else {
                $.ajax({
                    url: (id == null || id == '') ? "{!! route('simpandatakonten') !!}" : "{!! route('updatedatakonten') !!}",
                    method: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
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

        $('#btntambah').click(function(e) {
            $('.kode_edit').hide();
            $('#id').val('');
            $('#idkonten').val('');
            $('#subjudul').val('');
            $('#isi').val('');
            $('#image').val('');
            $('#exampleModalLabel').text('Tambah Konten');
            $('#addkonten').modal({
                show: true,
                backdrop: 'static'
            });
        });

        $('body').on('click', '#btnedit', function() {
            $('#exampleModalLabel').text('Edit Konten');
            let id = $(this).attr('data-id');
            $.ajax({
                type: "post",
                url: "{!! route('editdatakonten') !!}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    let datakonten = response.data;
                    let data2 = response.datajudul;
                    $('#id').val(datakonten.id);
                    $('#idkonten').val(data2.judul);
                    $('#subjudul').val(datakonten.subjudul);
                    $('#isi').val(datakonten.isi);

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
                        url: "{!! url('hapusdatakonten') !!}",
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
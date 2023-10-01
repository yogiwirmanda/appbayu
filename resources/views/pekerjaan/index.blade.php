@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Data Pekerjaan</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Pekerjaan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{asset('pekerjaan/create')}}" class="btn btn-primary btn-pill">Tambah</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="table-dokter" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Pekerjaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    var table = $('#table-dokter').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajax_load_pekerjaan') }}",
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'pekerjaan',
                name: 'nama',
                class : 'no-uppercase'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

    $(document).on('click', '.table-action-delete', function(e){
        let dataPekerjaanId = $(this).attr('data-pekerjaan-id');
        let namaPekerjaan = $(this).attr('data-pekerjaan-nama');
        swal({
            title: 'Apakah anda yakin?',
            text: 'Menghapus data pekerjaan '+namaPekerjaan,
            type: 'question',
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success btn-delete-pasien',
            confirmButtonText: 'Hapus',
            cancelButtonClass: 'btn btn-danger',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value == true){
            $.ajax({
                url : "pekerjaan/destroy/"+dataPekerjaanId,
                method : "GET",
                dataType : "json",
                data : {dataPekerjaanId: dataPekerjaanId},
                success : function (response) {
                if (response.errCode == 0){
                    $.notify('Pekerjaan Berhasil dihapus', 'success');
                    setTimeout(() => {
                    window.location.reload();
                    }, 2000);
                }
                }
            });
            }
        })
    });
</script>
@endsection
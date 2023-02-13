@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Data PRB</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">PRB</li>
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
                    <a href="{{asset('prb/create')}}" class="btn btn-pill btn-primary">
                        <span class="btn-inner--text">Tambah PRB</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="table-prb" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>No RM</th>
                                    <th>Name</th>
                                    <th>Alamat</th>
                                    <th>Nama Dokter</th>
                                    <th>Download</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
    var table = $('#table-prb').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajax_load_prb') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'noRm',
                name: 'noRm'
            },
            {
                data: 'namaPasien',
                name: 'namaPasien'
            },
            {
                data: 'alamatPasien',
                name: 'alamatPasien'
            },
            {
                data: 'namaDokter',
                name: 'namaDokter'
            },
            {
                data: 'download',
                name: 'download'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

    $(document).on('click', '.table-action-delete', function(){
      let dataPasienId = $(this).attr('data-pasien-id');
      let namaPasien = $(this).attr('data-pasien-nama');
      swal({
          title: 'Apakah anda yakin?',
          text: 'Menghapus data pasien atas nama '+namaPasien,
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
            url : "pasien/destroy/"+dataPasienId,
            method : "GET",
            dataType : "json",
            data : {dataPasienId: dataPasienId},
            success : function (response) {
              if (response.errCode == 0){
                $.notify('Pasien Berhasil dihapus', 'success');
                setTimeout(() => {
                  window.location.reload();
                }, 2000);
              }
            }
          });
        }
      })
    })
</script>
@endsection

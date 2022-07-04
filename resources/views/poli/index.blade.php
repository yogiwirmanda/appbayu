@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Data Poli</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Poli</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header pb-0">
                    <a href="{{asset('poli/create')}}" class="btn btn-pill btn-primary">
                        <span class="btn-inner--text">Tambah Poli</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="table-poli" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
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
    var table = $('#table-poli').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajax_load_poli') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nama',
                name: 'nama'
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
      let dataPoliId = $(this).attr('data-poli-id');
      let namaPoli = $(this).attr('data-poli-nama');
      swal({
          title: 'Apakah anda yakin?',
          text: 'Menghapus data poli '+namaPoli,
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
            url : "poli/destroy/"+dataPoliId,
            method : "GET",
            dataType : "json",
            data : {dataPoliId: dataPoliId},
            success : function (response) {
              if (response.errCode == 0){
                $.notify('Poli Berhasil dihapus', 'success');
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

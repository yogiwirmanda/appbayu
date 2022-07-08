@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Data Obat</h3>
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
                    <a href="{{asset('obat/create')}}" class="btn btn-pill btn-primary">
                        <span class="btn-inner--text">Tambah Obat</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="table-obat" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
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
    var table = $('#table-obat').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajax_load_obat') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'keterangan',
                name: 'keterangan'
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
      let dataObatId = $(this).attr('data-obat-id');
      let namaObat = $(this).attr('data-obat-nama');
      swal({
          title: 'Apakah anda yakin?',
          text: 'Menghapus data obat '+namaObat,
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
            url : "obat/destroy/"+dataObatId,
            method : "GET",
            dataType : "json",
            data : {dataObatId: dataObatId},
            success : function (response) {
              if (response.errCode == 0){
                $.notify('Obat Berhasil dihapus', 'success');
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

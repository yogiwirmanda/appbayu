@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8 text-left">
                            <h3 class="mb-0">Obt</h3>
                            <p class="text-sm mb-0">
                                This is an exmaple of datatable using the well known datatables.net plugin.
                            </p>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{asset('obat/create')}}" class="btn btn-sm btn-neutral btn-round btn-icon" data-toggle="tooltip" data-original-title="Tambah Poli">
                                <span class="btn-inner--icon"><i class="fas fa-user-edit"></i></span>
                                <span class="btn-inner--text">Tambah</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic" style="text-transform: uppercase;">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataObat as $key => $obat)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$obat->nama}}</td>
                                <td>{{$obat->keterangan}}</td>
                                <td class="table-actions">
                                    <a href="{{route('edit_obat', $obat->id)}}" class="table-action" data-toggle="tooltip" data-original-title="Edit obat">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="table-action table-action-delete" data-obat-id="{{$obat->id}}" data-obat-nama="{{$obat->nama}}" data-toggle="tooltip" data-original-title="Delete obat">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $('.table-action-delete').each(function(){
    $(this).click(function(){
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
  })
</script>
@endsection

@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8 text-left">
                            <h3 class="mb-0">Dokter</h3>
                            <p class="text-sm mb-0">
                                This is an exmaple of datatable using the well known datatables.net plugin.
                            </p>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{asset('dokter/create')}}" class="btn btn-sm btn-neutral btn-round btn-icon" data-toggle="tooltip" data-original-title="Tambah Dokter">
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
                                <th>NIP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataDokter as $key => $dokter)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$dokter->nama}}</td>
                                <td>{{$dokter->nip}}</td>
                                <td class="table-actions">
                                    <a href="{{route('edit_dokter', $dokter->id)}}" class="table-action" data-toggle="tooltip" data-original-title="Edit product">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="table-action table-action-delete" data-dokter-id="{{$dokter->id}}" data-dokter-nama="{{$dokter->nama}}" data-toggle="tooltip" data-original-title="Delete product">
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
  })
</script>
@endsection

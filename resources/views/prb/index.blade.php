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
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic" style="text-transform: uppercase;">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>No RM</th>
                                <th>Name</th>
                                <th>Alamat</th>
                                <th>Nama Dokter</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataPasienPrb as $key => $pasien)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$pasien->noRm}}</td>
                                <td>{{$pasien->namaPasien}}</td>
                                <td>{{$pasien->alamatPasien}}</td>
                                <td>{{$pasien->namaDokter}}</td>
                                <td class="table-actions">
                                    <a href="{{route('edit_prb', $pasien->id)}}" class="table-action"
                                        data-toggle="tooltip" data-original-title="Edit product">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="table-action table-action-delete" data-pasien-id="{{$pasien->id}}" data-pasien-nama="{{$pasien->nama}}" data-toggle="tooltip"
                                        data-original-title="Delete product">
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

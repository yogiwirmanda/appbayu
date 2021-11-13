@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8 text-left">
                            <h3 class="mb-0">Surat Sehat</h3>
                            <p class="text-sm mb-0">
                                This is an exmaple of datatable using the well known datatables.net plugin.
                            </p>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{asset('surat-sehat/create')}}" class="btn btn-sm btn-neutral btn-round btn-icon" data-toggle="tooltip" data-original-title="Tambah Surat Sehat">
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataSuratSehat as $key => $surat)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$surat->nama}}</td>
                                <td class="table-actions">
                                    <a href="{{route('edit_surat_sehat', $surat->id)}}" class="table-action" data-toggle="tooltip" data-original-title="Edit surat sehat">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="table-action table-action-delete" data-surat-id="{{$surat->id}}" data-surat-nama="{{$surat->nama}}" data-toggle="tooltip" data-original-title="Delete Surat Sehat">
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
      let dataSuratSehatId = $(this).attr('data-surat-id');
      let namaSuratSehat = $(this).attr('data-surat-nama');
      swal({
          title: 'Apakah anda yakin?',
          text: 'Menghapus data suratSehat '+namaSuratSehat,
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
            url : "surat-sehat/destroy/"+dataSuratId,
            method : "GET",
            dataType : "json",
            data : {dataSuratSehatId: dataSuratSehatId},
            success : function (response) {
              if (response.errCode == 0){
                $.notify('Surat Sehat Berhasil dihapus', 'success');
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

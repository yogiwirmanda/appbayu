@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8 text-left">
                            <h3 class="mb-0">Diagnosa</h3>
                            <p class="text-sm mb-0">
                                This is an exmaple of datatable using the well known datatables.net plugin.
                            </p>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{asset('diagnosa/create')}}" class="btn btn-sm btn-neutral btn-round btn-icon" data-toggle="tooltip" data-original-title="Tambah Diagnosa">
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
                                <th>Kode ICD</th>
                                <th>Diagnosa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataDiagnosa as $key => $diagnosa)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$diagnosa->kode_icd}}</td>
                                <td>{{$diagnosa->diagnosa}}</td>
                                <td class="table-actions">
                                    <a href="{{route('edit_diagnosa', $diagnosa->id)}}" class="table-action" data-toggle="tooltip" data-original-title="Edit diagnosa">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="table-action table-action-delete" data-diagnosa-id="{{$diagnosa->id}}" data-diagnosa-nama="{{$diagnosa->diagnosa}}" data-toggle="tooltip" data-original-title="Delete diagnosa">
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
      let dataDiagnosaId = $(this).attr('data-diagnosa-id');
      let namaDiagnosa = $(this).attr('data-diagnosa-nama');
      swal({
          title: 'Apakah anda yakin?',
          text: 'Menghapus data diagnosa '+namaDiagnosa,
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
            url : "diagnosa/destroy/"+dataDiagnosaId,
            method : "GET",
            dataType : "json",
            data : {dataDiagnosaId: dataDiagnosaId},
            success : function (response) {
              if (response.errCode == 0){
                $.notify('Diagnosa Berhasil dihapus', 'success');
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

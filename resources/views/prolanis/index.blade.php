@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Filter</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <div class="col-6 d-flex justify-content-around">
                        <select name="jenis_prolanis" class="form-control" id="jenis_prolanis">
                            <option value="Diabetes Melitus">Diabetes Melitus</option>
                            <option value="Hipertensi">Hipertensi</option>
                        </select>
                        <a href="javascript:;"
                            class="btn btn-info btn-fill pull-right btn-submit-filter ml-2">Filter</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8 text-left">
                            <h3 class="mb-0">Pasien Prolanis</h3>
                            <p class="text-sm mb-0">
                                This is an exmaple of datatable using the well known datatables.net plugin.
                            </p>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{asset('prolanis/create')}}" class="btn btn-sm btn-neutral btn-round btn-icon"
                                data-toggle="tooltip" data-original-title="Tambah Prolanis">
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
                                <th>No RM</th>
                                <th>Name</th>
                                <th>Umur</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataPasien as $key => $pasien)
                            @php
                                $yearBorn = (int) Date('Y', strtotime($pasien->tgl_lahir));
                                $yearNow = (int) Date('Y');
                                $age = $yearNow - $yearBorn;
                            @endphp
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$pasien->no_rm}}</td>
                                <td>{{$pasien->nama}}</td>
                                <td>{{$age}}</td>
                                <td>{{$pasien->alamat}}</td>
                                <td class="table-actions">
                                    <a href="javascript:;" class="btn btn-primary btn-sm btn-send-whatsapp" data-pasien-id="{{$pasien->id}}" data-toggle="tooltip" data-original-title="Kirim WA">
                                        Kirim WA
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
    $('.btn-submit-filter').click(function () {
        let value = $('#jenis_prolanis').val();
        window.location.href = '/prolanis/filter/' + value;
    });

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

  $('.btn-send-whatsapp').click(function(e){
    let dataPasienId = $(this).attr('data-pasien-id');
    $.ajax({
        url : "/send/whatsapp/"+dataPasienId,
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
  });
</script>
@endsection

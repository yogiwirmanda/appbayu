@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Data Diagnosa</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Diagnosa</li>
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
                            <a href="{{route('create_diagnosa')}}" class="btn btn-primary btn-pill">Tambah</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="table-diagnosa" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode ICD</th>
                                    <th>Diagnosa</th>
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
    var table = $('#table-diagnosa').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajax_load_diagnosa') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'kode_icd',
                name: 'kode_icd'
            },
            {
                data: 'diagnosa',
                name: 'diagnosa'
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
    });
</script>
@endsection

@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Set Kepala Keluarga</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Setting</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="table-pasien" style="text-transform: uppercase;">
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
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-set-kk" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Set Kepala Keluarga</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body px-lg-4 py-lg-3">
                    <form action="{{route('setting_save_kk')}}" id="form-set-kk" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="hidden" name="id_pasien" id="set-id-pasien">
                            <input class="form-control" name="kepala_keluarga" placeholder="Nama Kepala Keluarga" type="text">
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary btn-cari-obat my-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    var table = $('#table-pasien').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajax_load_set_kk') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'no_rm',
                name: 'no_rm'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'umur',
                name: 'umur'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

    $(document).on('click', '.table-action-setkk', function(){
        let dataId = $(this).attr('data-pasien-id');
        $('#set-id-pasien').val(dataId);
        $('#modal-set-kk').modal('show');
    })

    $('#form-set-kk').submit(function(e){
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/setting/kk');
        $('#modal-set-kk').modal('hide');
    });
</script>
@endsection

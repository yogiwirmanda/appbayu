@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8 text-left">
                            <h3 class="mb-0">Pasien</h3>
                            <p class="text-sm mb-0">
                                This is an exmaple of datatable using the well known datatables.net plugin.
                            </p>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{asset('pasien/create')}}" class="btn btn-sm btn-neutral btn-round btn-icon"
                                data-toggle="tooltip" data-original-title="Tambah Pasien">
                                <span class="btn-inner--icon"><i class="fas fa-user-edit"></i></span>
                                <span class="btn-inner--text">Tambah</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
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
@endsection
@section('page-scripts')
<script>
    var table = $('#table-pasien').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajax_load_pasien') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'no_rm', name: 'no_rm'},
            {data: 'nama', name: 'nama'},
            {data: 'umur', name: 'umur'},
            {data: 'alamat', name: 'alamat'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

    $(document).on('click', '.table-action-delete', function () {
        let dataPasienId = $(this).attr('data-pasien-id');
        let namaPasien = $(this).attr('data-pasien-nama');
        swal({
            title: 'Apakah anda yakin?',
            text: 'Menghapus data pasien atas nama ' + namaPasien,
            type: 'question',
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success btn-delete-pasien',
            confirmButtonText: 'Hapus',
            cancelButtonClass: 'btn btn-danger',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    url: "pasien/destroy/" + dataPasienId,
                    method: "GET",
                    dataType: "json",
                    data: {
                        dataPasienId: dataPasienId
                    },
                    success: function (response) {
                        if (response.errCode == 0) {
                            $.notify('Pasien Berhasil dihapus', 'success');
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

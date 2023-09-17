@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Kunjungan Pasien</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Pasien</li>
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
                    <div class="row">
                        <div class="col-4">
                            <div class="d-flex justify-content-around m-b-20">
                                <input class="datepicker-here form-control digits" type="text" data-range="true"
                                    data-multiple-dates-separator=" - " data-language="en"
                                    value="{{ Date('m/d/Y') }} - {{ Date('m/d/Y') }}">
                                <a href="javascript:;"
                                    class="btn btn-info btn-fill pull-right btn-submit-filter m-l-15">Filter</a>
                            </div>
                        </div>
                        <div class="col-4">
                            <a href="javascript:;" class="btn btn-primary btn-fill m-l-15 btn-modal-cari">Tambah
                                Kunjungan</a>
                        </div>
                        <div class="col-4">
                            <a href="javascript:;" class="btn btn-pill btn-success btn-export-pasien"
                                data-toggle="tooltip" data-original-title="Export Pasien">
                                <span class="btn-inner--text">Export Pasien</span>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush" id="table-kunjungan">
                            <thead>
                                <th>No</th>
                                <th>No RM</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jenis Bayar</th>
                                <th>Nama Poli</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="modal-cari-data" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cari Pasien</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" id="form-cari-data" class="form form-theme">
                    <div class="form-group mb-3">
                        <input class="form-control" name="noRm" placeholder="No RM" type="text">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="namaPasien" placeholder="Nama Pasien" type="text">
                    </div>
                    <div class="text-left">
                        <button type="button" class="btn btn-primary btn-cari-data my-4">Cari</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-flush table-cari-data" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>No RM</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    function loadTable(tanggalAwal, tanggalAkhir){
        $('#table-kunjungan').dataTable().fnClearTable();
        $('#table-kunjungan').dataTable().fnDestroy();
        var table = $('#table-kunjungan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('ajax_load_kunjungan') }}",
                type: "GET",
                data: function(d){
                    d.tanggalAwal = tanggalAwal;
                    d.tanggalAkhir = tanggalAkhir;
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'no_rmk',
                    name: 'no_rm'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'namaPoli',
                    name: 'namaPoli'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'bayar',
                    name: 'bayar'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    }
    loadTable();
    $('.btn-submit-filter').click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var tanggal = $('.datepicker-here').val();
        tanggal = tanggal.replace(/\s+/g, '');
        let separateTanggal = tanggal.split("-");
        let separateAwal = '';
        let separateAkhir = '';
        if (separateTanggal.length > 1){
            separateAwal = separateTanggal[0].split("/");
            separateAkhir = separateTanggal[1].split("/");
        } else {
            separateAwal = separateTanggal[0].split("/");
            separateAkhir = separateAwal;
        }

        let tanggalAwal = separateAwal[2] + '-' + separateAwal[0] + '-' + separateAwal[1];
        let tanggalAkhir = separateAkhir[2] + '-' + separateAkhir[0] + '-' + separateAkhir[1];

        loadTable(tanggalAwal, tanggalAkhir);
    });

    $('.btn-export-pasien').click(function(e){
        e.stopImmediatePropagation();
        var tanggal = $('.datepicker-here').val();
        tanggal = tanggal.replace(/\s+/g, '');
        let separateTanggal = tanggal.split("-");
        let separateAwal = '';
        let separateAkhir = '';
        if (separateTanggal.length > 1){
            separateAwal = separateTanggal[0].split("/");
            separateAkhir = separateTanggal[1].split("/");
        } else {
            separateAwal = separateTanggal[0].split("/");
            separateAkhir = separateAwal;
        }

        let tanggalAwal = separateAwal[2] + '-' + separateAwal[0] + '-' + separateAwal[1];
        let tanggalAkhir = separateAkhir[2] + '-' + separateAkhir[0] + '-' + separateAkhir[1];
        let tglFix = tanggalAwal + '|||' + tanggalAkhir;
        if (tanggal.length > 0){
            if (tglFix.length > 0){
                window.location.href = '/pasien/export/' + tglFix;
            } else {
                window.location.href = '/pasien/export/';
            }
        } else {
            $.notify('Isi Tanggal Terlebih Dahulu', 'error');
        }
    });

    var options = {
        theme:"sk-bounce",
        message:'Mohon tunggu, sedang memproses data...',
        backgroundColor:"#5e72e4",
        textColor:"#ffffff"
    };

    $('.btn-cari-data').click(function(e){
        let form = $('#form-cari-data');
        let tbody = $('.table-cari-data').find('tbody');
        $.ajax({
            url : '{{route("cari_data_pasien")}}',
            method : 'GET',
            dataType : 'json',
            data : form.serialize(),
            beforeSend : function(){
                HoldOn.open(options);
            },
            success : function(response){
                tbody.html('');
                response.forEach(function(element, index) {
                    let tr = $('<tr>');
                    let td1 = $('<td>', {text : index + 1});
                    let td2 = $('<td>', {text : element.no_rm});
                    let td3 = $('<td>', {text : element.nama});
                    let td4 = $('<td>', {text : element.alamat});
                    let td5 = $('<td>');
                    let action = $('<a>', {href:'javascript:;', text:'Pilih', class:'btn btn-sm btn-neutral btn-pilih-member', member_id:element.id});
                    tr.append(td1);
                    tr.append(td2);
                    tr.append(td3);
                    tr.append(td4);
                    td5.append(action);
                    tr.append(td5);
                    tbody.append(tr);
                });
            },
            complete : function(){
                HoldOn.close();
            }
        });
    });

    $(document).on('click', '.btn-pilih-member', function(e){
        e.preventDefault();
        let memberId = $(this).attr('member_id');
        window.location.href = '/kunjungan/create/' + memberId;
    })

    $('.btn-modal-cari').click(function (e) {
        $('#modal-cari-data').modal('show');
    });
</script>
@endsection
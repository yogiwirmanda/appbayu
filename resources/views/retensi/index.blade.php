@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>List Retensi</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Retensi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-around align-items-center action-retensi">
                        <a href="javascript:;" class="btn btn-danger btn-reset-retensi m-r-10">Reset</a>
                        <a href="javascript:;" class="btn btn-success btn-select-all m-r-10">Select All</a>
                        <a href="javascript:;" class="btn btn-info btn-retensi">Retensi</a>
                    </div>
                </div>
                <form action="{{route('retensi_save')}}" method="POST" class="form-retensi">
                    @csrf
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table-list-retensi">
                                <thead class="thead-light">
                                    <th>No</th>
                                    <th>Pilih</th>
                                    <th>No RM</th>
                                    <th>Nama Pasien</th>
                                    <th>Diagnosa</th>
                                    <th>Keterangan</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    console.log($('#table-list-retensi'));
    var table = $('#table-list-retensi').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajax_load_retensi') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'pilih',
                name: 'pilih'
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
                data: 'diagnosa',
                name: 'diagnosa'
            },
            {
                data: 'keterangan',
                name: 'keterangan'
            }
        ]
    });

    function totalChecked(){
        let count = 0;
        let elmCheckbox = $('.checkbox-retensi');
        elmCheckbox.each(function(e){
            if ($(this).is(':checked')){
                count = count + 1;
            }
        });
        return count;
    }

    function reset(){
        let elmCheckbox = $('.checkbox-retensi');
        elmCheckbox.each(function(e){
            if ($(this).is(':checked')){
                $(this).prop('checked', false);
            }
        });
    }

    function selectAll(){
        $('.checkbox-retensi').prop('checked', true);
    }

    $(document).on('change', '.checkbox-retensi', function(e) {
        let checked = $(this).is(':checked');
    });

    $('.btn-select-all').click(function(e){
        selectAll();
    })

    $('.btn-retensi').click(function(e){
        let getTotal = totalChecked();
        let elmForm = $('.form-retensi');
        if (getTotal == 0){
            alert('Belum ada pasien yang di pilih');
        } else {
            var options = {
                theme:"sk-bounce",
                message:'Mohon tunggu, sedang memproses data...',
                backgroundColor:"#5e72e4",
                textColor:"#ffffff"
            };

            HoldOn.open(options);

            $.ajax({
                url : elmForm.attr('action'),
                method : 'GET',
                dataType : 'json',
                data : elmForm.serialize(),
                success : function (response) {
                    setTimeout(() => {
                        HoldOn.close();
                        window.location.reload();
                    }, 1500);
                }
            })
        }
    });

    $('.btn-reset-retensi').click(function(e){
        reset();
    });
</script>
@endsection

@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Laporan Prb</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Laporan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="col-6 d-flex justify-content-around m-b-10">
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{$tanggal}}">
                <a href="javascript:;"
                    class="btn btn-info btn-fill pull-right btn-submit-filter m-l-10">Filter</a>
            </div>
            <div class="tab-content" id="top-tabContent">
                <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                    <div class="table-responsive" id="load-table">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    $('.btn-submit-filter').click(function (e) {
        e.preventDefault();
        loadTable();
    });

    function loadTable(){
        $.ajax({
            url : '{{route("loadPrb")}}',
            dataType : 'json',
            method : 'GET',
            data : [],
            success : function(response){
                $('#load-table').html('');
                $('#load-table').html(response.html);
            }
        })
    }

    loadTable();
</script>
@endsection

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
                <select name="tahun" id="select-tahun" class="form-control select2">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023" selected>2023</option>
                </select>
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
        let getTahun = $('#select-tahun').val();
        $.ajax({
            url : '{{route("loadPrb")}}',
            dataType : 'json',
            method : 'GET',
            data : {year : getTahun},
            success : function(response){
                $('#load-table').html('');
                $('#load-table').html(response.html);
            }
        })
    }

    loadTable();

    $('#select-tahun').change(function(){
        loadTable();
    });
</script>
@endsection

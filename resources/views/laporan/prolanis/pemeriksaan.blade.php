@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Laporan Pemeriksaaan</h3>
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
            <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                <li class="nav-item"><a class="nav-link active btn-load-dm" id="top-home-tab" data-bs-toggle="tab" href="#top-home"
                        role="tab" aria-controls="top-home" aria-selected="true">DM</a></li>
                <li class="nav-item"><a class="nav-link btn-load-ht" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile"
                        role="tab" aria-controls="top-profile" aria-selected="false">HT</a></li>
            </ul>
            <div class="tab-content" id="top-tabContent">
                <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                    <div class="table-responsive" id="load-dm">

                    </div>
                </div>
                <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                    <div class="table-responsive" id="load-ht">

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
        let tanggal = $('#tanggal').val();
        let type = $('#type').val();
        // window.location.href = '/laporan/klpcm/' + type + '/' + tanggal;
    });

    function loadDM(){
        $.ajax({
            url : '{{route("laporan_pemeriksaan_dm")}}',
            dataType : 'json',
            method : 'GET',
            data : [],
            success : function(response){
                $('#load-dm').html('');
                $('#load-dm').html(response.html);
            }
        })
    }

    function loadHT(){
        $.ajax({
            url : '{{route("laporan_pemeriksaan_ht")}}',
            dataType : 'json',
            method : 'GET',
            data : [],
            success : function(response){
                $('#load-ht').html('');
                $('#load-ht').html(response.html);
            }
        })
    }

    loadDM();

    $('.btn-load-dm').click(function(e){
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        loadDM();
    });
    $('.btn-load-ht').click(function(e){
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        loadHT();
    });
</script>
@endsection

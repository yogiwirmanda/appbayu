@extends('master.customer.main')
@section('content')
<div class="row py-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center">
                <h2>Nomor Antrean</h2>
                <h1>{{$antrean->kode}}</h1>
            </div>
            <div class="card-body text-center pt-0">
                <h3>Poli : {{$antrean->namaPoli}}</h3>
                <h3 class="mb-5">Tanggal : {{Date('d F Y', strtotime($antrean->tanggal))}}</h3>
                {!! QrCode::size(200)->generate($antrean->nik) !!}
            </div>
        </div>
    </div>
</div>
@endsection
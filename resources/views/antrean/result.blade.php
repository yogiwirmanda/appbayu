@extends('master.customer.main')
@section('content')
<div class="row py-5 result-antrean" id="saveantrean">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center">
                <div class="d-flex justify-content-between">
                    <img src="{{asset('image/logo-pemkot.png')}}" alt="logo-pemkot" class="logo-result">
                    <img src="{{asset('image/logo-puskesmas.png')}}" alt="logo-puskesmas" class="logo-result">
                </div>
                <h2>Nomor Antrean</h2>
                <h1>{{$antrean->kode}}</h1>
            </div>
            <div class="card-body text-center pt-0">
                <h3>Poli : {{$antrean->namaPoli}}</h3>
                <h3 class="mb-5">Tanggal : {{Date('d F Y', strtotime($antrean->tanggal))}}</h3>
                {!! QrCode::size(200)->generate($antrean->nik) !!}
            </div>
        </div>
        <div class="w-100 text-center">
            <a href="javascript:;" class="btn btn-primary btn-download mt-4 px-5">Print</a>
        </div>
    </div>
</div>
@endsection
@section('push-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.min.js"></script>
<script>
    $('.btn-download').click(function(e){
        e.preventDefault();
        window.print()
    })

    function getPDF() {
        var doc = new jsPDF();
        var specialElementHandlers = {
            '#getPDF': function(element, renderer){
            return true;
            },
            '.controls': function(element, renderer){
            return true;
            }
        };

        doc.fromHTML($('#saveantrean').get(0), 15, 15, {
            'width': 170,
            'elementHandlers': specialElementHandlers
        });

        doc.save('Generated.pdf');
        }
</script>
@endsection
<style>
    .result-antrean {
        margin-top: 100px !important;
    }

    .logo-result {
        width: 60px;
        height: auto;
    }
</style>
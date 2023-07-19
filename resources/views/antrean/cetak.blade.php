@extends('master.customer.cetak')
@section('content')
<div class="row py-2 result-antrean" id="saveantrean">
    <div class="col-md-9 mx-auto">
        <div class="card">
            <div class="card-header text-center">
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="{{asset('image/logo-pemkot.png')}}" alt="logo-pemkot" class="logo-result">
                        <img src="{{asset('image/logo-puskesmas.png')}}" alt="logo-puskesmas" class="logo-result">
                    </div>
                    <div>
                        <h4>Nomor Antrean Online</h4>
                        <h3>{{$antrean->kode}}</h3>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                <h5>Poli : {{$antrean->namaPoli}}</h5>
                <h4 class="<?php echo($antrean->ceklab) ? '' : 'd-none' ?>">Cek Lab</h4>
                <h4 class="mb-5">Tanggal : {{Date('d F Y', strtotime($antrean->tanggal))}}</h4>
                {!! QrCode::size(200)->generate($antrean->nik) !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('push-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.min.js"></script>
<script>
    $(document).ready(function(e){
        window.print()
    })
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
    #main {
        width: 500px !important;
    }

    section {
        padding: 10px 0px !important;
    }

    .logo-result {
        width: 60px;
        height: fit-content;
    }
</style>
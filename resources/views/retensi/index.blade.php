@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary d-flex justify-content-between">
                    <div class="header-pasien">
                        <h4 class="card-title ">Data Pasien</h4>
                        <p class="card-category"> Here is a subtitle for this table</p>
                    </div>
                    <div class="d-flex justify-content-around align-items-center action-retensi">
                        <a href="javascript:;" class="btn btn-danger btn-reset-retensi mr-2">Reset</a>
                        <a href="javascript:;" class="btn btn-success btn-select-all mr-2">Select All</a>
                        <a href="javascript:;" class="btn btn-info btn-retensi">Retensi</a>
                    </div>
                </div>
                <form action="{{route('retensi_save')}}" method="POST" class="form-retensi">
                    @csrf
                    <div class="card-body">
                        <div class="table-responsive py-4">
                            <table class="table table-flush" id="datatable-basic" style="text-transform: uppercase;">
                                <thead class="thead-light">
                                    <th>Pilih</th>
                                    <th>No</th>
                                    <th>No RM</th>
                                    <th>Nama Pasien</th>
                                    <th>Diagnosa</th>
                                    <th>Keterangan</th>
                                </thead>
                                <tbody>
                                    @foreach($dataRetensi as $key => $pasien)
                                    @php
                                        $diagnosaGet = json_decode($pasien->diagnosa);
                                    @endphp
                                    <tr>
                                        <td><input type="checkbox" name="pasien[]" class="checkbox-retensi" value="{{$pasien->id_pasien}}"></td>
                                        <td>{{$key+1}}</td>
                                        <td>{{$pasien->no_rm}}</td>
                                        <td>{{$pasien->nama}}</td>
                                        <td>
                                            @if (is_array($diagnosaGet))
                                                @foreach($diagnosaGet as $item)
                                                    {{$item->diagnosa . ', '}}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{$pasien->keterangan}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
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

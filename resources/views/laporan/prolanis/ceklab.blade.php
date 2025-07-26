
<table class="table table-flush table-bordered mt-5" id="table-ht" style="text-transform: uppercase;">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Hasil</th>
        </tr>
    </thead>
    <tbody>
        @if (count($dataCekLab) > 0)
            @foreach($dataCekLab as $key => $data)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$data['tanggal']}}</td>
                @if($data['hasil'] == null)
                <td><button class="brn btn-primary btn-input-hasil" ceklabid="{{$data['id']}}">Input Hasil</button></td>
                @else
                <td>{{$data['hasil']}}</td>
                @endif
            </tr>
            @endforeach
        @else
            <tr class="text-center">
                <td colspan="15">Tidak Ada Data</td>
            </tr>
        @endif
    </tbody>
</table>
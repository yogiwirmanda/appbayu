
<table class="table table-flush table-bordered mt-5" id="table-ht" style="text-transform: uppercase;">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @if (count($dataCekLab) > 0)
            @foreach($dataCekLab as $key => $data)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$data['tanggal']}}</td>
            </tr>
            @endforeach
        @else
            <tr class="text-center">
                <td colspan="15">Tidak Ada Data</td>
            </tr>
        @endif
    </tbody>
</table>
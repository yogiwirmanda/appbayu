<table>
    <thead>
        <tr>
            <td rowspan="3">Kode</td>
            <td rowspan="3">Nama Penyakit</td>
            <td colspan="4">0-7 Hari</td>
            <td colspan="4">28 Hari</td>
        </tr>
        <tr>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
        </tr>
        <tr>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
        </tr>
    </thead>
    <tbody>
        @foreach($lb1 as $data)
            <tr>
                <td>{{$data['kode_icd']}}</td>
                <td>{{$data['diagnosa']}}</td>
                <td>{{$data['7DaysNewMale']}}</td>
                <td>{{$data['7DaysNewFemale']}}</td>
                <td>{{$data['7DaysOldMale']}}</td>
                <td>{{$data['7DaysOldFemale']}}</td>
                <td>{{$data['28DaysNewdMale']}}</td>
                <td>{{$data['28DaysNewFemale']}}</td>
                <td>{{$data['28DaysOldMale']}}</td>
                <td>{{$data['28DaysOldFemale']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
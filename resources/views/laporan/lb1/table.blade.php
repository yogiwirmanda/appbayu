<table>
    <thead>
        <tr>
            <td rowspan="3">Kode</td>
            <td rowspan="3">Nama Penyakit</td>
            <td colspan="4">0-7 Hari</td>
            <td colspan="4">28 Hari</td>
            <td colspan="4">29 - 1Thn</td>
            <td colspan="4">1 - 4Thn</td>
            <td colspan="4">5 - 9Thn</td>
            <td colspan="4">10 - 14Thn</td>
            <td colspan="4">15 - 19Thn</td>
            <td colspan="4">20 - 44Thn</td>
            <td colspan="4">45 - 54Thn</td>
            <td colspan="4">55 - 59Thn</td>
            <td colspan="4">60 - 69Thn</td>
            <td colspan="4">> 70Thn</td>
        </tr>
        <tr>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
            <td colspan="2">BARU</td>
            <td colspan="2">LAMA</td>
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
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
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
                <td>{{$data['below1YearOldMale']}}</td>
                <td>{{$data['below1YearOldFemale']}}</td>
                <td>{{$data['below1YearNewMale']}}</td>
                <td>{{$data['below1YearNewFemale']}}</td>
                <td>{{$data['startFrom1to4YearOldMale']}}</td>
                <td>{{$data['startFrom1to4YearOldFemale']}}</td>
                <td>{{$data['startFrom1to4YearNewMale']}}</td>
                <td>{{$data['startFrom1to4YearNewFemale']}}</td>
                <td>{{$data['startFrom5to9YearOldMale']}}</td>
                <td>{{$data['startFrom5to9YearOldFemale']}}</td>
                <td>{{$data['startFrom5to9YearNewMale']}}</td>
                <td>{{$data['startFrom5to9YearNewFemale']}}</td>
                <td>{{$data['startFrom10to14YearOldMale']}}</td>
                <td>{{$data['startFrom10to14YearOldFemale']}}</td>
                <td>{{$data['startFrom10to14YearNewMale']}}</td>
                <td>{{$data['startFrom10to14YearNewFemale']}}</td>
                <td>{{$data['startFrom15to19YearOldMale']}}</td>
                <td>{{$data['startFrom15to19YearOldFemale']}}</td>
                <td>{{$data['startFrom15to19YearNewMale']}}</td>
                <td>{{$data['startFrom15to19YearNewFemale']}}</td>
                <td>{{$data['startFrom20to44YearOldMale']}}</td>
                <td>{{$data['startFrom20to44YearOldFemale']}}</td>
                <td>{{$data['startFrom20to44YearNewMale']}}</td>
                <td>{{$data['startFrom20to44YearNewFemale']}}</td>
                <td>{{$data['startFrom45to54YearOldMale']}}</td>
                <td>{{$data['startFrom45to54YearOldFemale']}}</td>
                <td>{{$data['startFrom45to54YearNewMale']}}</td>
                <td>{{$data['startFrom45to54YearNewFemale']}}</td>
                <td>{{$data['startFrom55to59YearOldMale']}}</td>
                <td>{{$data['startFrom55to59YearOldFemale']}}</td>
                <td>{{$data['startFrom55to59YearNewMale']}}</td>
                <td>{{$data['startFrom55to59YearNewFemale']}}</td>
                <td>{{$data['startFrom60to69YearOldMale']}}</td>
                <td>{{$data['startFrom60to69YearOldFemale']}}</td>
                <td>{{$data['startFrom60to69YearNewMale']}}</td>
                <td>{{$data['startFrom60to69YearNewFemale']}}</td>
                <td>{{$data['startFrom70to150YearOldMale']}}</td>
                <td>{{$data['startFrom70to150YearOldFemale']}}</td>
                <td>{{$data['startFrom70to150YearNewMale']}}</td>
                <td>{{$data['startFrom70to150YearNewFemale']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
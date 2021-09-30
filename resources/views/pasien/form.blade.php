<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pasien</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<style>
    .box-logo{
        display : flex;
        align-items :center;
        justify-content : center;
        height : 100%;
    }
    .logo-pemkot{
        width : 100px;
        height: 100px;
    }
    .logo-puskesmas{
        width : 90px;
        height: auto;
    }
    .box-rm{
        width : 120px;
        height : 50px;
        background-color : grey;
        font-weight : 600;
        display : flex;
        justify-content : center;
        align-items : center;
        margin-right : 35px;
    }
    .container-form{
        padding : 10px 20px;
    }
</style>
<body class="container-form">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <div class="box-rm">RM 01</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="box-logo">
                <img src="{{asset('image/logo-pemkot.png')}}" class="logo-pemkot" alt="">
            </div>
        </div>
        <div class="col-md-8">
            <div class="text-center">
                <div>PEMERINTAH KOTA MALANG</div>
                <div>DINAS KESEHATAN</div>
                <div>UPT PUSKESMAS RAMPAL CELAKET</div>
                <div>Jl. Simpang Kasembon No.5 Telp. (0341) 356380</div>
                <div>www.puskrampalcelaket.malangkota.go.id  e-mail : puskrampalcelaket@malangkota.go.id</div>
                <div class="w-100 d-flex justify-content-around">
                    <div>MALANG</div>
                    <div>Kode Pos : 6511</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box-logo">
                <img src="{{asset('image/logo-puskesmas.png')}}" class="logo-puskesmas" alt="">
            <div>
        </div>
        <hr>
    </div>
</body>
</html>
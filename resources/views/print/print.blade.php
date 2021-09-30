<style>
    .image{
        width: 100%;
        height : auto;
    }
    .position-absolute{
        position: absolute;
        font-size : 25px;
    }
    .image-box{
        position: relative;
        width : 832px;
        height : 1248px;
    }
</style>
<?php
$noRM = $pasien->no_rm;
$explodeNoRM = str_split($noRM);
?>
<div class="image-box">
    <img src="{{asset('image/form-1.jpg')}}" class="image" alt="">
    <div class="position-absolute noRMKode1" style="top: 18.4%;right: 30.5%;">{{$noRM[0]}}</div>
    <div class="position-absolute noRMKode2">{{$noRM[1]}}</div>
    <div class="position-absolute noRMUrut1">{{$noRM[3]}}</div>
    <div class="position-absolute noRMUrut2">{{$noRM[4]}}</div>
    <div class="position-absolute noRMUrut3">{{$noRM[5]}}</div>
    <div class="position-absolute noRMUrut4">{{$noRM[6]}}</div>
    <div class="position-absolute noRMTahun1">{{$noRM[8]}}</div>
    <div class="position-absolute noRMTahun2">{{$noRM[9]}}</div>
</div>
@php
if (!isset($navActive)){
  $navActive = '';
}
@endphp
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <input type="hidden" id="navActive" value="{{$navActive}}">
    <div class="scrollbar-inner">
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="/home">
                <img src="{{asset('image/prcv3.png')}}" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">Dashboards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link master-menu" href="#navbar-master" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-master">
                            <i class="ni ni-ungroup text-orange"></i>
                            <span class="nav-link-text">Master</span>
                        </a>
                        <div class="collapse navbar-pasien" id="navbar-master">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{asset('pasien')}}" class="nav-link">Pasien</a>
                                </li>
                            </ul>
                        </div>
                        <div class="collapse navbar-dokter" id="navbar-master">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{asset('dokter')}}" class="nav-link">Dokter</a>
                                </li>
                            </ul>
                        </div>
                        <div class="collapse navbar-diagnosa" id="navbar-master">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('show_diagnosa')}}" class="nav-link">Diagnosa</a>
                                </li>
                            </ul>
                        </div>
                        <div class="collapse navbar-poli" id="navbar-master">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('show_poli')}}" class="nav-link">Poli</a>
                                </li>
                            </ul>
                        </div>
                        <div class="collapse navbar-obat" id="navbar-master">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('show_obat')}}" class="nav-link">Obat</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link transaksi-menu" href="#navbar-components" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-components">
                            <i class="ni ni-ui-04 text-info"></i>
                            <span class="nav-link-text">Transaksi</span>
                        </a>
                        <div class="collapse navbar-kunjungan" id="navbar-components">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{asset('kunjungan')}}" class="nav-link">Kunjungan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="collapse navbar-prolanis" id="navbar-components">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{asset('prolanis')}}" class="nav-link">Prolanis</a>
                                </li>
                            </ul>
                        </div>
                        <div class="collapse navbar-prb" id="navbar-components">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{asset('prb')}}" class="nav-link">PRB</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link laporan-menu" href="#navbar-laporan" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-laporan">
                            <i class="ni ni-ui-04 text-info"></i>
                            <span class="nav-link-text">Laporan</span>
                        </a>
                        <div class="collapse navbar-klpcm" id="navbar-laporan">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{asset('laporan/klpcm')}}" class="nav-link">Klpcm</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link setting-menu" href="#navbar-setting" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-setting">
                            <i class="ni ni-settings-gear-65 text-danger"></i>
                            <span class="nav-link-text">Setting</span>
                        </a>
                        <div class="collapse navbar-nomor" id="navbar-setting">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{asset('setting/nomor')}}" class="nav-link">Nomor RM</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
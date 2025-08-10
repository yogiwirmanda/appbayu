<div class="sidebar-wrapper">
  <div>
    <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light"
          src="{{asset('zeta/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark"
          src="../assets/images/logo/small-white-logo.png" alt=""></a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid"
          src="{{asset('zeta/images/logo/logo.png')}}" alt=""></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'rm')
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn"><a href="index.html"><img class="img-fluid" src="../assets/images/logo-icon.png"
                alt=""></a>
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true">
              </i></div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link" href="/home">
              <i data-feather="home"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="javascript:;">
              <i data-feather="book"></i>
              <span>Master</span>
            </a>
            <ul class="sidebar-submenu">
              @if (Auth::user()->role == 'admin')
                <li><a href="/poli">Poli</a></li>
                <li><a href="/diagnosa">Diagnosa</a></li>
                <li><a href="/obat">Obat</a></li>
                <li><a href="/poli-rujukan">Poli Rujukan</a></li>
                <li><a href="/rumahsakit">Rumah Sakit</a></li>
              @endif
              @if(Auth::user()->role == 'admin' || Auth::user()->role == 'rm')
              <li><a href="/pekerjaan">Pekerjaan</a></li>
              @endif
            </ul>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="javascript:;">
              <i data-feather="book"></i>
              <span>Data</span>
            </a>
            <ul class="sidebar-submenu">
              <li><a href="/pasien">Pasien</a></li>
              <li><a href="/dokter">Dokter</a></li>
              <li><a href="/prolanis">Prolanis</a></li>
              <li><a href="/ceklab">Cek Lab</a></li>
              <li><a href="/prb">PRB</a></li>
            </ul>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link" href="/antrean">
              <i data-feather="list"></i>
              <span>Antrean</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link" href="/kunjungan">
              <i data-feather="navigation"></i>
              <span>Kunjungan</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="javascript:;">
              <i data-feather="book"></i>
              <span>Laporan</span>
            </a>
            <ul class="sidebar-submenu">
              <li><a href="/laporan/pemeriksaan">Prolanis</a></li>
              <li><a href="/laporan/pemeriksaanPrb">PRB</a></li>
              @if (Auth::user()->role == 'admin')
              <li><a href="/laporan/klpcm">KLPCM</a></li>
              @endif
              <li><a href="/laporan/kunjungan">Kunjungan</a></li>
              @if(Auth::user()->role == 'admin')
              <li><a href="/laporan/lb1">LB1</a></li>
              @endif
            </ul>
          </li>
          @if(Auth::user()->role == 'admin')
          <li class="sidebar-list">
            <a class="sidebar-link" href="/retensi">
              <i data-feather="shield"></i>
              <span>Retensi</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="javascript:;">
              <i data-feather="settings"></i>
              <span>Setting</span>
            </a>
            <ul class="sidebar-submenu">
              <li><a href="/setting/nomor">Nomor RM</a></li>
              <li><a href="/setting/kk">Kepala Keluarga</a></li>
            </ul>
          </li>
          @endif
        </ul>
        @endif
        @if(Auth::user()->role == 'lab')
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn"><a href="index.html"><img class="img-fluid" src="../assets/images/logo-icon.png"
                alt=""></a>
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true">
              </i></div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="javascript:;">
              <i data-feather="book"></i>
              <span>Data</span>
            </a>
            <ul class="sidebar-submenu">
              <li><a href="/ceklab">Cek Lab</a></li>
            </ul>
          </li>
        </ul>
        @endif
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>
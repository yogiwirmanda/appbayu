
<div class="sidebar-wrapper">
  <div>
    <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{asset('zeta/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="../assets/images/logo/small-white-logo.png" alt=""></a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('zeta/images/logo/logo.png')}}" alt=""></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn"><a href="index.html"><img class="img-fluid" src="../assets/images/logo-icon.png" alt=""></a>
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true">        </i></div>
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
              <li><a href="/dokter">Dokter</a></li>
              <li><a href="/pasien">Pasien</a></li>
              <li><a href="/prolanis">Prolanis</a></li>
            </ul>
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
              <li><a href="/laporan/prolanis">Prolanis</a></li>
              <li><a href="/laporan/pemeriksaan">Pemeriksaan</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>
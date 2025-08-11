@extends('master.main')
@section('content')
@php
if(!isset($tanggal)){
$tanggal = Date('Y-m-d');
}
@endphp
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h3>Detail Pasien</h3>
      </div>
      <div class="col-12 col-sm-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="feather feather-home">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg></a></li>
          <li class="breadcrumb-item">Pasien</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-xl-7 xl-100">
          <div class="card">
            <div class="card-body">
              <div class="media mb-4">
                <div class="media-body">
                  <div class="d-flex w-100">
                    <div class="m-r-15">
                      <h3>{{$pasien->nama}}</h3>
                      <p>{{$pasien->no_rm}}</p>
                    </div>
                    <div class="d-flex align-items-start ml-2">
                      @if($pasien->status_prolanis == 1)
                      <span class="badge badge-danger">Prolanis</span>
                      @endif
                      @if($pasien->status_prb == 1)
                      <span class="badge badge-success">Prb</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <h6>Data Pasien</h6>
              <div class="details">
                <div class="row">
                  <div class="col-3"><span> Kepala Keluarga</span></div>
                  <div class="col-9">{{$pasien->kepala_keluarga}}</div>
                </div>
                <div class="row">
                  <div class="col-3"><span> No KTP</span></div>
                  <div class="col-9">{{$pasien->no_ktp}}</div>
                </div>
                <div class="row">
                  <div class="col-3"><span> Tanggal Lahir</span></div>
                  @php
                  $tglLahir = date_create($pasien->tgl_lahir);
                  $dateNow = date_create(Date('Y-m-d'));
                  $dateDiff = date_diff($tglLahir, $dateNow);
                  @endphp
                  <div class="col-9">{{Date('d-m-Y', strtotime($pasien->tgl_lahir))}} ({{$dateDiff->y . ' Tahun '.
                    $dateDiff->m. ' Bulan '. $dateDiff->d . ' Hari'}})</div>
                </div>
                <div class="row">
                  <div class="col-3"><span> Alamat</span></div>
                  <div class="col-9">{{$pasien->alamat}}</div>
                </div>
                <div class="row">
                  <div class="col-3"><span> No HP</span></div>
                  <div class="col-9">{{$pasien->no_hp}}</div>
                </div>
                <div class="row">
                  <div class="col-3"><span> Jenis Bayar</span></div>
                  <div class="col-9">{{$pasien->cara_bayar}} {{($pasien->cara_bayar == 'BPJS') ? $pasien->no_bpjs : ''}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-3"><span>Keterangan Prolanis</span></div>
                  <div class="col-9">{{$pasien->keterangan_prolanis}}
                  </div>
                </div>
              </div>
              <div class="row mt-4">
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'rm')
                <div class="col-md-3">
                  <a href="/pasien/download/gigimulut/{{$pasien->id}}" target="_blank"
                    class="btn btn-primary mb-2 btn-download-poli-gigi">Poli Gigi & Mulut</a>
                </div>
                <div class="col-md-3">
                  <a href="/pasien/download/ci/{{$pasien->id}}" target="_blank"
                    class="btn btn-primary mb-2 btn-download-catatan-integrasi">Catatan Integrasi</a>
                </div>
                <div class="col-md-3">
                  <a href="/pasien/download/ci2/{{$pasien->id}}" target="_blank"
                    class="btn btn-primary mb-2 btn-download-catatan-integrasi-2">Catatan Integrasi 2</a>
                </div>
                <div class="col-md-3">
                  <a href="/pasien/download/cet/{{$pasien->id}}" target="_blank"
                    class="btn btn-primary mb-2 btn-download-catatan-integrasi-2">Catatan Edukasi Terintegrasi</a>
                </div>
                <div class="col-md-3">
                  <a href="/pasien/download/gc/{{$pasien->id}}" target="_blank"
                    class="btn btn-primary mb-2 btn-download-catatan-integrasi-2">General Consent</a>
                </div>
                <div class="col-md-3">
                  <a href="/pasien/download/pak/{{$pasien->id}}" target="_blank"
                    class="btn btn-primary mb-2 btn-download-catatan-integrasi-2">Pengkajian Awal Klinis</a>
                </div>
                @endif
                @if($pasien->status_prolanis == 1)
                <div class="col-md-3">
                  <a href="/pasien/download/prolanis/{{$pasien->id}}" target="_blank"
                    class="btn btn-primary btn-download-catatan-integrasi-2">Berkas Prolanis</a>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-12">
          <div class="card basic-tab-sect">
            <div class="card-header pb-0">
              <h5>Riwayat Pasien</h5>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'rm')
                <li class="nav-item"><a class="nav-link <?php echo (Auth::user()->role == 'admin' || Auth::user()->role == 'rm' ? 'active' : '') ?>" id="home-tab" data-bs-toggle="tab" href="#home"
                    role="tab" aria-controls="home" aria-selected="true">Kunjungan</a></li>
                @endif
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'rm' || Auth::user()->role == 'lab')
                <li class="nav-item"><a class="nav-link <?php echo (Auth::user()->role == 'lab' ? 'active' : '') ?>" id="profile-tabs" data-bs-toggle="tab" href="#profile"
                    role="tab" aria-controls="profile" aria-selected="false">Prolanis</a></li>
                @endif
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'rm')
                <li class="nav-item"><a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact"
                    role="tab" aria-controls="contact" aria-selected="false">PRB</a></li>
                @endif
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'rm' || Auth::user()->role == 'lab')
                <li class="nav-item"><a class="nav-link" id="ceklab-tab" data-bs-toggle="tab" href="#ceklab"
                    role="tab" aria-controls="ceklab" aria-selected="false">Cek Lab</a></li>
                @endif
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show <?php echo (Auth::user()->role == 'admin' || Auth::user()->role == "rm" ? 'active' : '') ?> m-t-10" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <table class="table table-bordered table-responsive" id="table-kunjungan">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Poli</th>
                        <th>Diagnosa</th>
                        <th>Rujukan</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
                <div class="tab-pane fade show <?php echo (Auth::user()->role == 'lab' ? 'active' : '') ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <input type="hidden" name="type" id="type" value="dm">
                  <div class="card">
                    <div class="card-body">
                      <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active btn-load-dm" id="top-home-tab"
                            data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home"
                            aria-selected="true">DM</a></li>
                        <li class="nav-item"><a class="nav-link btn-load-ht" id="profile-top-tab" data-bs-toggle="tab"
                            href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false">HT</a></li>
                      </ul>
                      <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                          aria-labelledby="top-home-tab">
                          <div class="table-responsive" id="load-dm">

                          </div>
                        </div>
                        <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                          <div class="table-responsive" id="load-ht">

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="table-responsive" id="load-table-prb">

                  </div>
                </div>
                <div class="tab-pane fade" id="ceklab" role="tabpanel" aria-labelledby="ceklab-tab">
                  <div class="table-responsive" id="load-table-ceklab">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('page-scripts')
<script>
  let role = "<?= Auth::user()->role ?>";
  if (role == 'admin' || role == 'rm'){
  var table = $('#table-kunjungan').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/pasiens/dtAjaxKunjungan/{{$pasien->id}}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'diagnosa',
                name: 'diagnosa'
            },
            {
                data: 'rs_rujukan',
                name: 'rs_rujukan'
            }
        ]
    });

  }
    function loadDM(){
        $.ajax({
            url : '/laporan/pemeriksaan/dm/{{$pasien->id}}',
            dataType : 'json',
            method : 'GET',
            data : [],
            success : function(response){
                $('#load-dm').html('');
                $('#load-dm').html(response.html);
            }
        })
    }

    function loadHT(){
        $.ajax({
            url : '/laporan/pemeriksaan/ht/{{$pasien->id}}',
            dataType : 'json',
            method : 'GET',
            data : [],
            success : function(response){
                $('#load-ht').html('');
                $('#load-ht').html(response.html);
            }
        })
    }
    loadDM();

    $('.btn-load-dm').click(function(e){
        $('#type').val('dm');
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        loadDM();
    });
    $('.btn-load-ht').click(function(e){
        $('#type').val('ht');
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        loadHT();
    });

    function loadTablePrb(){
        $.ajax({
            url : '/laporan/pemeriksaan/prb/{{$pasien->id}}',
            dataType : 'json',
            method : 'GET',
            data : [],
            success : function(response){
                $('#load-table-prb').html('');
                $('#load-table-prb').html(response.html);
            }
        })
    }

    function loadTableCeklab(){
        $.ajax({
            url : '/laporan/pemeriksaan/ceklab/{{$pasien->id}}',
            dataType : 'json',
            method : 'GET',
            data : [],
            success : function(response){
                $('#load-table-ceklab').html('');
                $('#load-table-ceklab').html(response.html);
            }
        })
    }
    if (role == 'admin' || role == 'rm'){
      loadTablePrb();
    }
    if (role == 'lab'){
      loadTableCeklab();
    }
</script>
@endsection
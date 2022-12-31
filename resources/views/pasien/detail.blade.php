@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Detail Pasien</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
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
        <div class="row projectmore">
              <div class="col-xl-7 xl-100">
                <div class="card">
                  <div class="card-body">
                    <div class="media mb-4">
                        <div class="media-body">
                            <div class="d-flex w-100">
                              <div class="m-r-15">
                                <h5>Yogi Wirmanda</h5>
                                <p>01-0001-22 U</p>
                              </div>
                              <div class="d-flex align-items-start ml-2">
                                <span class="badge badge-danger">Prolanis</span>
                                <span class="badge badge-success">Prb</span>
                              </div>
                            </div>
                        </div>
                    </div>
                    <h6>Data Pasien</h6>
                    <div class="details">
                        <div class="row">
                          <div class="col-3"><span> Kepala Keluarga</span></div>
                          <div class="col-4">Bayu Yudha</div>
                        </div>
                        <div class="row">
                          <div class="col-3"><span> No KTP</span></div>
                          <div class="col-4">3573012010960004</div>
                        </div>
                        <div class="row">
                          <div class="col-3"><span> Tanggal Lahir</span></div>
                          <div class="col-6">20-10-1996 (Umur 26 Tahun 10 Bulan 5 Hari)</div>
                        </div>
                        <div class="row">
                          <div class="col-3"><span> Alamat</span></div>
                          <div class="col-4">Jalan Teluk Pelabuhan Ratu no 38 B</div>
                        </div>
                        <div class="row">
                          <div class="col-3"><span> No HP</span></div>
                          <div class="col-4">08121708168</div>
                        </div>
                        <div class="row">
                          <div class="col-3"><span> Jenis Bayar</span></div>
                          <div class="col-4">BPJS (1738817263172312)</div>
                        </div>
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
                      <li class="nav-item"><a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Kunjungan</a></li>
                      <li class="nav-item"><a class="nav-link" id="profile-tabs" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Prolanis</a></li>
                      <li class="nav-item"><a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">PRB</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-bordered table-responsive mt-2">
                          <thead>
                            <tr>
                              <th>Tanggal Kunjungan</th>
                              <th>Poli</th>
                              <th>Diagnosa</th>
                              <th>Rujukan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="mb-0 m-t-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                      </div>
                      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <p class="mb-0 m-t-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
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

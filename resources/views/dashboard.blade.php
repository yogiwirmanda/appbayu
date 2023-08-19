@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Dashboard</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="home-item" href="index.html"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid ecommerce-dash">
    <div class="row">
        <div class="col-xl-3 col-md-6 dash-xl-33 dash-lg-50">
            <div class="card sales-state">
                <div class="row m-0">
                    <div class="col-12 p-0">
                        <div class="card bg-primary">
                            <div class="card-header card-no-border bg-primary">
                                <div class="media media-dashboard">
                                    <div class="media-body">
                                        <h5 class="mb-0 text-light">Jumlah Pasien</h5>
                                    </div>
                                    <div class="icon-box"><i data-feather="more-horizontal"></i></div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="sales-state-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="sales-small-chart">
                            <div class="card-body p-0 m-auto">
                                <div class="sales-small sales-small-1"></div>
                                <h6>{{$totalPasien->total}}</h6><span>Pasien </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="sales-small-chart">
                            <div class="card-body p-0 m-auto">
                                <div class="sales-small sales-small-2"></div>
                                <h6>{{$totalPasienProlanis->total}}</h6><span>Prolanis</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="sales-small-chart">
                            <div class="card-body p-0 m-auto">
                                <div class="sales-small sales-small-3"></div>
                                <h6>{{$totalPasienPendatang->total}}</h6><span>Pendatang </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 dash-xl-50 dash-32">
            <div class="card revenue-category">
                <div class="card-header card-no-border">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mb-0">Pasien per Poli</h5>
                        </div>
                        <div class="icon-box onhover-dropdown"><i data-feather="more-horizontal"></i>
                            <div class="icon-box-show onhover-show-div">
                                <ul>
                                    <li> <a>
                                            Done</a></li>
                                    <li> <a>
                                            Pending</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="donut-inner">
                        <h5></h5>
                        <h6>Total Pasien</h6>
                    </div>
                    <div id="revenue-chart"> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-md-12 dash-xl-50 dash-lg-100 dash-39">
            <div class="card ongoing-project recent-orders">
                <div class="card-header card-no-border">
                    <div class="media media-dashboard">
                        <div class="media-body">
                            <h5 class="mb-0">Daftar Pasien Terakhir</h5>
                        </div>
                        <div class="icon-box onhover-dropdown"><i data-feather="more-horizontal"></i>
                            <div class="icon-box-show onhover-show-div">
                                <ul>
                                    <li> <a>
                                            Done</a></li>
                                    <li> <a>
                                            Pending</a></li>
                                    <li> <a>
                                            Rejected</a></li>
                                    <li> <a>In Progress</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-bordernone">
                            <thead>
                                <tr>
                                    <th> <span>Nama Pasien</span></th>
                                    <th> <span>No RM</span></th>
                                    <th> <span>Telepon</span></th>
                                    <th> <span>Alamat </span></th>
                                    <th> <span>Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listPasienTerbaru as $item)
                                <tr>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->no_rm}}</td>
                                    <td>{{$item->no_hp}}</td>
                                    <td>{{$item->alamat}}</td>
                                    <td>
                                        <a href="/pasiens/detail/{{$item->id}}"
                                            class="badge badge-light-primary">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-modules')
<script>
    var options = {
      labels: ['UMUM', 'LANSIA', 'KIA','GIGI'],
      series: <?php echo $perPoli ?>,
      chart: {
        type: 'donut',
        height: 320 ,
      },
      legend:{
        position:'bottom'
      },
      dataLabels: {
        enabled: false,
      },
      states: {
        hover: {
          filter: {
            type: 'darken',
            value: 1,
          }
        }
      },
      stroke: {
        width: 0,
      },
      responsive: [
            {
              breakpoint: 1661,
              options: {
                chart: {
                    height:310,
                }
              }
            },
            {
              breakpoint: 481,
              options:{
                chart:{
                    height:280,
                }
              }
            }

        ],
      colors:[zetaAdminConfig.primary,zetaAdminConfig.secondary,zetaAdminConfig.success,zetaAdminConfig.info,zetaAdminConfig.warning],
  };
  var chart = new ApexCharts(document.querySelector("#revenue-chart"), options);
  chart.render();
</script>
<script src="{{asset('zeta/js/dashboard/dashboard_2.js')}}"></script>
@endsection
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
                                <h6>300</h6><span>Pasien </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="sales-small-chart">
                            <div class="card-body p-0 m-auto">
                                <div class="sales-small sales-small-2"></div>
                                <h6>1120</h6><span>Prolanis</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="sales-small-chart">
                            <div class="card-body p-0 m-auto">
                                <div class="sales-small sales-small-3"></div>
                                <h6>530</h6><span>Pendatang </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-md-6 dash-xl-33 dash-lg-50">
            <div class="card pb-0 invoice-overviwe">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <h5 class="m-0">Pasien Minggu Ini</h5>
                        <div class="icon-box onhover-dropdown"><i data-feather="more-horizontal"></i>
                            <div class="icon-box-show onhover-show-div">
                                <ul>
                                    <li> <a>
                                            Today</a></li>
                                    <li> <a>
                                            Yesterday</a></li>
                                    <li> <a>
                                            Tommorow</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div id="invoice-overviwe-chart"></div>
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
                                    <th> <span>Poli</span></th>
                                    <th> <span>Alamat </span></th>
                                    <th> <span>Status</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=1;$i<=5;$i++)
                                    <tr>
                                        <td>Bayu Yudha</td>
                                        <td>081217018168</td>
                                        <td>Gigi</td>
                                        <td>Plaosan Timur</td>
                                        <td><div class="badge badge-light-primary">Detail</div></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
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
                        <h5>1000</h5>
                        <h6>Total Pasien</h6>
                    </div>
                    <div id="revenue-chart"> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 dash-xl-50 dash-31">
            <div class="card total-sale">
                <div class="card-header card-no-border">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mb-0">Pasien Prolanis</h5>
                        </div>
                        <div class="icon-box onhover-dropdown"><i data-feather="more-horizontal"></i>
                            <div class="icon-box-show onhover-show-div">
                                <ul>
                                    <li><a>Done</a></li>
                                    <li> <a>
                                            Pending</a></li>
                                    <li> <a>
                                            Rejected</a></li>
                                    <li> <a>In Progress</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="animat-block">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="sale-main">
                        <div class="sale-left">
                            <h6 class="font-danger"><i class="icon-arrow-down"></i><span>0.45%</span></h6>
                            <h5 class="font-primary">680.96</h5>
                        </div>
                        <div class="sale-right">
                            <div id="total-sales-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-modules')
    <script src="{{asset('zeta/js/dashboard/dashboard_2.js')}}"></script>
@endsection
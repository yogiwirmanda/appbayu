@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Laporan KLPCM</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Laporan KLPCM</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row m-b-20">
                        <div class="col-md-12">
                            <div class="col-6 d-flex justify-content-around">
                                <input class="datepicker-here form-control digits" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en">
                                <a href="javascript:;" class="btn btn-info btn-fill pull-right btn-submit-filter m-l-15">Filter</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="load-klpcm"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="chartPie"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>

    function loadTable(startDate = '', endDate = ''){
        $.ajax({
            url : '{{route("laporan_klpcm_filter")}}',
            dataType : 'json',
            method : 'GET',
            data : {startDate : startDate, endDate : endDate},
            success : function(response){
                $('#load-klpcm').html('');
                $('#load-klpcm').html(response.html);
            }
        })
    }

    $('.btn-submit-filter').click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var tanggal = $('.datepicker-here').val();
        tanggal = tanggal.replace(/\s+/g, '');
        let separateTanggal = tanggal.split("-");
        let separateAwal = separateTanggal[0].split("/");
        let separateAkhir = separateTanggal[1].split("/");

        let tanggalAwal = separateAwal[2] + '-' + separateAwal[1] + '-' + separateAwal[0];
        let tanggalAkhir = separateAkhir[2] + '-' + separateAkhir[1] + '-' + separateAkhir[0];

        loadTable(tanggalAwal, tanggalAkhir);
    });

    loadTable();

    var options = {
          series: [{
          name: 'Inflation',
          data: [40, 50, 35, 70]
        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val + "%";
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },

        xaxis: {
          categories: ["UMUM", "LANSIA", "KIA", "GIGI"],
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + "%";
            }
          }

        },
        title: {
          text: 'Diagram Lengkap Tiap Poli',
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


        var options = {
          series: [44, 55, 13, 43],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['UMUM', 'LANSIA', 'KIA', 'GIGI'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chartPie = new ApexCharts(document.querySelector("#chartPie"), options);
        chartPie.render();

</script>
@endsection

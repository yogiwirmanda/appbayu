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
                <input class="datepicker-here form-control digits" type="text" data-range="true"
                  data-multiple-dates-separator=" - " data-language="en">
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
        <div class="card-title text-center mt-3">
          <h3>Chart Tidak Lengkap per Poli</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="chart-umum">
                <div class="card">
                  <div class="card-title text-center mt-4">Poli Umum</div>
                  <div class="card-body text-center">
                    <div id="chartPieUmum"></div>
                    <a href="/laporan/klpcm/report/1" class="mt-3">Lihat Daftar</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="chart-kia">
                <div class="card">
                  <div class="card-title text-center mt-4">Poli Kia</div>
                  <div class="card-body text-center">
                    <div id="chartPieKia"></div>
                    <a href="/laporan/klpcm/report/3" class="mt-3">Lihat Daftar</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="chart-gigi">
                <div class="card">
                  <div class="card-title text-center mt-4">Poli Gigi</div>
                  <div class="card-body text-center">
                    <div id="chartPieGigi"></div>
                    <a href="/laporan/klpcm/report/4" class="mt-3">Lihat Daftar</a>
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

        let separateAwal = '';
        let separateAkhir = '';
        if (separateTanggal.length > 1){
            separateAwal = separateTanggal[0].split("/");
            separateAkhir = separateTanggal[1].split("/");
        } else {
            separateAwal = separateTanggal[0].split("/");
            separateAkhir = separateAwal;
        }

        let tanggalAwal = separateAwal[2] + '-' + separateAwal[0] + '-' + separateAwal[1];
        let tanggalAkhir = separateAkhir[2] + '-' + separateAkhir[0] + '-' + separateAkhir[1];

        loadTable(tanggalAwal, tanggalAkhir);
    });

    loadTable();

    function loadDiagramLengkapPoli(){

      let dataUmum = [];
      $.ajax({
        url : '/laporan/klpcm/umum',
        method : 'GET',
        data : {},
        success : function(response){
          dataUmum = response;
        }
      });

      let dataKia = []
      $.ajax({
        url : '/laporan/klpcm/kia',
        method : 'GET',
        data : {},
        success : function(response){
          dataKia = response;
        }
      });

      let dataGigi = []
      $.ajax({
        url : '/laporan/klpcm/gigi',
        method : 'GET',
        data : {},
        success : function(response){
          dataGigi = response;
        }
      });

      var options = {
            theme: "sk-bounce",
            message: 'Mohon tunggu, sedang memproses data...',
            backgroundColor: "#5e72e4",
            textColor: "#ffffff"
        };

        HoldOn.open(options);
      setTimeout(() => {
        let totalDataChart = dataUmum[1] + dataKia[1] + dataGigi[1];
        var options = {
            series: [{
            name: 'Lengkap',
            data: [dataUmum[1], dataKia[1], dataGigi[1]]
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
              let percent = (val / totalDataChart) * 100;
              return Math.round(percent).toFixed(2) + "%";
            },
            offsetY: -20,
            style: {
              fontSize: '12px',
              colors: ["#304758"]
            }
          },

          xaxis: {
            categories: ["UMUM", "KIA", "GIGI"],
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
                let percent = (val / totalDataChart) * 100;
                return Math.round(percent).toFixed(2) + "%";
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

        var optionsUmum = {
          series: dataUmum,
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['LENGKAP', 'TIDAK LENGKAP'],
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

        var chartPieUmum = new ApexCharts(document.querySelector("#chartPieUmum"), optionsUmum);
        chartPieUmum.render();

        var optionsKia = {
          series: dataKia,
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['LENGKAP', 'TIDAK LENGKAP'],
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

        var chartPieKia = new ApexCharts(document.querySelector("#chartPieKia"), optionsKia);
        chartPieKia.render();

        var optionsGigi = {
          series: dataGigi,
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['LENGKAP', 'TIDAK LENGKAP'],
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

        var chartPieGigi = new ApexCharts(document.querySelector("#chartPieGigi"), optionsGigi);
        chartPieGigi.render();
        HoldOn.close();
      }, 15000);
    }

    loadDiagramLengkapPoli();
</script>
@endsection
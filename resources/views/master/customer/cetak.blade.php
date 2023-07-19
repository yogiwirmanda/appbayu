<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PRC</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('medilab/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('medilab/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('medilab/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('zeta/css/vendors/select2.css')}}">

    <!-- Template Main CSS File -->
    <link href="{{ asset('medilab/assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Medilab
  * Updated: Jun 23 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
    #header {
        top: 0px !important;
    }
</style>

<body>

    <main id="main">

        <section class="inner-page">
            <div class="container">
                @yield('content')
            </div>
        </section>

    </main><!-- End #main -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('zeta/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('medilab/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('medilab/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('medilab/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('medilab/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('medilab/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{asset('zeta/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('zeta/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('zeta/js/notify/bootstrap-notify.min.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('medilab/assets/js/main.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    <script>
        $(document).ready(function () {
        $('.select2').select2();
        // $('#datatable-basic-with-export').DataTable({
        //     dom: 'Bfrtip',
        //     buttons: ['copy', 'pdf', 'csv', 'excel', 'print']
        // });
    })
    $('#select-province').change(function () {
        let getVal = $(this).val();
        $.ajax({
            url: "{{route('load_data_city')}}",
            method: 'get',
            dataType: 'json',
            data: {
                provinceId: getVal
            },
            success: function (response) {
                let dataCity = response;
                let elmSelectCity = $('#select-city');
                elmSelectCity.html('');
                dataCity.forEach(data => {
                    let option = $('<option>', {
                        value: data.id,
                        text: data.name
                    });
                    elmSelectCity.append(option);
                });
                elmSelectCity.removeAttr('disabled');
            }
        });
    })

    $('#select-city').change(function () {
        let getVal = $(this).val();
        $.ajax({
            url: "{{route('load_data_district')}}",
            method: 'get',
            dataType: 'json',
            data: {
                cityId: getVal
            },
            success: function (response) {
                let dataCity = response;
                let elmSelectDistrict = $('#select-district');
                elmSelectDistrict.html('');
                dataCity.forEach(data => {
                    let option = $('<option>', {
                        value: data.id,
                        text: data.name
                    });
                    elmSelectDistrict.append(option);
                });
                elmSelectDistrict.removeAttr('disabled');
            }
        });
    })

    $('#select-district').change(function () {
        let getVal = $(this).val();
        $.ajax({
            url: "{{route('load_data_villages')}}",
            method: 'get',
            dataType: 'json',
            data: {
                districtId: getVal,
            },
            success: function (response) {
                let dataVillages = response;
                let elmSelectVillages = $('#select-villages');
                elmSelectVillages.html('');
                dataVillages.forEach(data => {
                    let option = $('<option>', {
                        value: data.id,
                        text: data.name
                    });
                    elmSelectVillages.append(option);
                });
                elmSelectVillages.removeAttr('disabled');
            }
        });
    });
        function setVillage(villageId) {
        $("#select-villages").val(villageId).trigger('change');
        HoldOn.close();
    }

    function setDistrict(districtId, villageId) {
        $("#select-district").val(districtId).trigger('change');
        setTimeout(function () {
            setVillage(villageId);
        }, 1000)
    }

    function setCity(regencyId, districtId, villageId) {
        $("#select-city").val(regencyId).trigger('change');
        setTimeout(function () {
            setDistrict(districtId, villageId);
        }, 1000)
    }

    function setProvince(provinceId, regencyId, districtId, villageId) {
        $("#select-province").val(provinceId).trigger('change');
        setTimeout(function () {
            setCity(regencyId, districtId, villageId);
        }, 1000)
    }

    $('#form-antrean').submit(function (e) {
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/antrean-online/result', 'antrean');
    });
    </script>
    @yield('push-script')
</body>

</html>
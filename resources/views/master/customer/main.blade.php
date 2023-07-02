<!DOCTYPE html>
<html lang="en">

@include('master.customer.head')

<body class="landing-wrraper">
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- page-wrapper Start-->
    <div class="page-wrapper landing-page">
        @include('master.customer.header')
        <!--footer end-->
        <section class="landing-home" id="home">
            <div class="custom-container mt-5">
                @yield('content')
            </div>
        </section>
    </div>
    <!-- latest jquery-->
    <script src="{{asset('zeta/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('zeta/js/bootstrap/bootstrap.bundle.min')}}.js"></script>
    <!-- feather icon js-->>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{asset('zeta/js/config.js')}}">
    </script>
    <!-- Plugins JS start-->
    <script src="{{asset('zeta/js/animation/scroll-reveal/scrollreveal.min.js')}}">
    </script>
    <script src="{{asset('zeta/js/modernizr.js')}}">
    </script>
    <script src="{{asset('zeta/js/animation/scroll-reveal/reveal-custom.js')}}">
    </script>
    <script src="{{asset('zeta/js/tooltip-init.js')}}">
    </script>
    <script src="{{asset('zeta/js/animation/wow/wow.min.js')}}">
    </script>
    <script src="{{asset('zeta/js/landing_sticky.js')}}">
    </script>
    <script src="{{asset('zeta/js/landing.js')}}">
    </script>
    <script src="{{asset('zeta/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('zeta/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('zeta/js/script.js')}}">
    </script>
    <script src="{{asset('zeta/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('zeta/js/notify/index.js')}}"></script>
    <script src="{{asset('js/app.js')}}">
    </script>
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
</body>

</html>
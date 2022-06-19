    <!-- latest jquery-->
    <script src="{{asset('zeta/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('zeta/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('zeta/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('zeta/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- scrollbar js-->
    <script src="{{asset('zeta/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{asset('zeta/js/scrollbar/custom.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('zeta/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('zeta/js/chart/knob/knob.min.js')}}"></script>
    <script src="{{asset('zeta/js/chart/knob/knob-chart.js')}}"></script>
    <script src="{{asset('zeta/js/chart/apex-chart/apex-chart.js')}}"></script>
    <script src="{{asset('zeta/js/chart/apex-chart/stock-prices.js')}}"></script>
    <script src="{{asset('zeta/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('zeta/js/notify/index.js')}}"></script>
    <script src="{{asset('zeta/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('zeta/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{asset('zeta/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
    <script src="{{asset('zeta/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('zeta/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('zeta/js/photoswipe/photoswipe.js')}}"></script>
    <script src="{{asset('zeta/js/typeahead/handlebars.js')}}"></script>
    <script src="{{asset('zeta/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('zeta/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{asset('zeta/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('zeta/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('zeta/js/height-equal.js')}}"></script>
    <script src="{{asset('zeta/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('zeta/js/holdonjs/HoldOn.min.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('zeta/js/script.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <!-- <script src="{{asset('zeta/js/theme-customizer/customizer.js')}}"></script> -->
    <!-- login js-->
    <!-- Plugin used-->
    @yield('page-modules')
    @yield('page-scripts')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            // $('#datatable-basic-with-export').DataTable({
            //     dom: 'Bfrtip',
            //     buttons: ['copy', 'pdf', 'csv', 'excel', 'print']
            // });
        })
    </script>

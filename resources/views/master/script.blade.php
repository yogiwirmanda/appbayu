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
<!-- <script src="{{asset('zeta/js/sidebar-menu.js')}}"></script> -->
<script src="{{asset('zeta/js/chart/chartjs/chart.min.js')}}"></script>
<script src="{{asset('zeta/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('zeta/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('zeta/js/prism/prism.min.js')}}"></script>
<script src="{{asset('zeta/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('zeta/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('zeta/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('zeta/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{asset('zeta/js/owlcarousel/owl-custom.js')}}"></script>
<script src="{{asset('zeta/js/tooltip-init.js')}}"></script>
<script src="{{asset('zeta/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('zeta/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('zeta/js/datatable/datatables/datatable.custom.js')}}"></script>
{{-- <script src="{{asset('zeta/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('zeta/js/select2/select2-custom.js')}}"></script> --}}
<script src="{{asset('zeta/js/height-equal.js')}}"></script>
<script src="{{asset('zeta/js/sidebar-menu.js')}}"></script>
<script src="{{asset('zeta/js/holdonjs/HoldOn.min.js')}}"></script>
<script src="{{asset('zeta/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('zeta/js/script.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<!-- <script src="{{asset('zeta/js/theme-customizer/customizer.js')}}"></script> -->
<!-- login js-->
<!-- Plugin used-->
<style>
    .select2-container--open .select2-dropdown--below {
        top: 40px;
        left: 70px ;
    }
</style>
@yield('page-modules')
@yield('page-scripts')
<script>
    // $(document).ready(function () {
    //     $('.select2').select2({
    //         let dropdown = $('.select2-container .select2-dropdown');
    //         let selectBox = $(this).closest('.select2-container');

    //         let selectBoxOffset = selectBox.offset();
    //         dropdown.css({
    //             top: selectBoxOffset.top + selectBox.outerHeight(),
    //             left: selectBoxOffset.left,
    //             position: 'absolute'
    //         });
    //     });
    // });
    $(document).ready(function () {
    $('.select2').select2();

    // After select2 is initialized, adjust the dropdown position
    $('.select2').on('select2:open', function () {
        setTimeout(function () {
            let dropdown = $('.select2-container .select2-dropdown');
            let selectBox = $(this).closest('.select2-container');
            console.log(selectBox);
            if (selectBox.length) {
                let selectBoxOffset = selectBox.offset();
                dropdown.css({
                    top: selectBoxOffset.top + selectBox.outerHeight(),
                    left: selectBoxOffset.left,
                    position: 'absolute'
                });
            } else {
                console.warn('selectBox not found!');
            }
        }, 100);  // Add delay to ensure Select2 has time to open
    });
});

</script>
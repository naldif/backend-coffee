<!-- jQuery  -->
<script src="{{ asset('/be/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('/be/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/be/assets/js/metismenu.min.js') }}"></script>
<script src="{{ asset('/be/assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('/be/assets/js/waves.min.js') }}"></script>

<script src="{{ asset('/be/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('/be/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<!--Morris Chart-->
<script src="{{ asset('/be/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('/be/plugins/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('/be/assets/pages/dashboard.init.js') }}"></script>

<!-- Required datatable js -->
<script src="{{ asset('/be/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('/be/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{ asset('/be/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/be/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/be/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('/be/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('/be/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('/be/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/be/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('/be/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Sweet-Alert  -->
<script src="{{ asset('/be/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
{{-- <script src="{{ asset('/be/assets/pages/sweet-alert.init.js') }}"></script> --}}
<!-- Responsive examples -->
<script src="{{ asset('/be/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/be/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('/be/assets/pages/datatables.init.js') }}"></script>


{{-- <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css
" rel="stylesheet"> --}}


<!-- App js -->
<script src="{{ asset('/be/assets/js/app.js') }}"></script>

@yield('script')
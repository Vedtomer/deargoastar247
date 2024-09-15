   <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
   {{-- <script src="{{ asset('asset/admin/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('asset/admin/js/perfect-scrollbar.min.js') }}"></script>
   <script src="{{ asset('asset/admin/js/mousetrap.min.js') }}"></script>
   <script src="{{ asset('asset/admin/js/waves.min.js') }}"></script>
   <script src="{{ asset('asset/admin/js/app.js') }}"></script>
   <!-- END GLOBAL MANDATORY SCRIPTS -->

   <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
   <script src="{{ asset('asset/admin/js/apexcharts.min.js') }}"></script>
   <script src="{{ asset('asset/admin/js/dash_1.js') }}"></script>
   <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS --> --}}


   <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
   <script src="{{ asset('asset/admin/src/plugins/src/global/vendors.min.js') }}"></script>
   <script src="{{ asset('asset/admin/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('asset/admin/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
   <script src="{{ asset('asset/admin/src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
   <script src="{{ asset('asset/admin/src/plugins/src/waves/waves.min.js') }}"></script>
   <script src="{{ asset('asset/admin/layouts/modern-dark-menu/app.js') }}"></script>
   <!-- END GLOBAL MANDATORY SCRIPTS -->


   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   {{-- <script src="{{ asset('asset/admin/plugins/src/table/datatable/datatables.js') }}"></script> --}}
   {{-- <script src="{{ asset('asset/admin/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script> --}}
   {{-- <script src="{{ asset('asset/admin/plugins/src/table/datatable/button-ext/jszip.min.js') }}"></script> --}}
   {{-- <script src="{{ asset('asset/admin/plugins/src/table/datatable/button-ext/buttons.html5.min.js') }}"></script> --}}
   {{-- <script src="{{ asset('asset/admin/plugins/src/table/datatable/button-ext/buttons.print.min.js') }}"></script> --}}
   {{-- <script src="{{ asset('asset/admin/plugins/src/table/datatable/custom_miscellaneous.js') }}"></script> --}}
   <!-- END PAGE LEVEL SCRIPTS -->


   <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
   <script src="{{ asset('asset/admin/src/plugins/src/apex/apexcharts.min.js') }}"></script>
   <script src="{{ asset('asset/admin/src/assets/js/dashboard/dash_1.js') }}"></script>
   <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

   <!-- Include Toastr JS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="{{ asset('asset/admin/src/plugins/src/table/datatable/datatables.js') }}"></script>
   <script>
       $('#zero-config').DataTable({
           "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
               "<'table-responsive'tr>" +
               "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
           "oLanguage": {
               "oPaginate": {
                   "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                   "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
               },
               "sInfo": "Showing page _PAGE_ of _PAGES_",
               "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
               "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
           },
           "stripeClasses": [],
           "lengthMenu": [7, 10, 20, 50],
           "pageLength": 10
       });
   </script>
   <!-- END PAGE LEVEL SCRIPTS -->

   <script>


       $('.customer').select2({
           placeholder: 'Select Time',
           allowClear: true
       });

       document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            button.closest('form').submit();
                        }
                    })
                });
            });


            document.getElementById('selectedDate').addEventListener('change', function() {
            var selectedDate = this.value;
            var currentUrl = window.location.href.split('?')[0];
            window.location.href = currentUrl + '?date=' + selectedDate;
        });
   </script>




  <script src="{{ asset('asset/admin/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('asset/admin/src/plugins/src/table/datatable/button-ext/jszip.min.js') }}"></script>
  <script src="{{ asset('asset/admin/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('asset/admin/src/plugins/src/table/datatable/button-ext/buttons.print.min.js') }}"></script>
  <script src="{{ asset('asset/admin/src/plugins/src/table/datatable/custom_miscellaneous.js') }}"></script>


  <!-- BEGIN THEME GLOBAL STYLE -->
  <script src="{{ asset('asset/admin/src/assets/js/scrollspyNav.js') }}"></script>
  <script src="{{ asset('asset/admin/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
  <script src="{{ asset('asset/admin/src/plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
  <!-- END THEME GLOBAL STYLE -->

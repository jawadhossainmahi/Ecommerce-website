   <!-- BEGIN: Vendor JS-->
   <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
   <script src="{{ asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js') }}"></script>
   <script src="{{ asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js') }}"></script>
   <script src="{{ asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
   <!-- BEGIN Vendor JS-->



   <!-- BEGIN: Theme JS-->
   <script src="{{ asset('app-assets/js/scripts/configs/vertical-menu-light.js') }}"></script>
   <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
   <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
   <script src="{{ asset('app-assets/js/scripts/components.js') }}"></script>
   <script src="{{ asset('app-assets/js/scripts/footer.js') }}"></script>
   <!-- END: Theme JS-->
   <script src="{{ asset('app-assets/js/jquery.js') }}"></script>
   <script src="{{ asset('app-assets/js/toastr.min.js') }}"></script>
   <!-- BEGIN: Page JS-->
   @yield('js')
   <!-- END: Page JS-->
   <script>
      @if(Session::has('message'))
      toastr.options = {
         "closeButton": true,
         "progressBar": true
      }
      toastr.info("{{ session('message') }}");
      @endif
      @if(Session::has('warning'))
      toastr.options = {
         "closeButton": true,
         "progressBar": true
      }
      toastr.warning("{{ session('warning') }}");
      @endif
   
      @if(Session::has('info'))
      toastr.options = {
         "closeButton": true,
         "progressBar": true
      }
      toastr.info("{{ session('info') }}");
      @endif
   </script>


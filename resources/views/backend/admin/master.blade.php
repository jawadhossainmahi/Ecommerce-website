<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->


<!-- END: Head-->
@include('backend.admin.layouts.head')
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('backend.admin.layouts.header')
    
    <!-- END: Header-->

    
    <!-- BEGIN: Main Menu-->
    @include('backend.admin.layouts.main_menu')
    
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->
    

    
    <!-- BEGIN: Footer-->
    
    @include('backend.admin.layouts.footer')
    <!-- END: Footer-->
    
    
    @include('backend.admin.layouts.scripts')


</body>
<!-- END: Body-->

</html>
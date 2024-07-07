<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->


<!-- END: Head-->
@include('backend.user.layouts.head')
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('backend.user.layouts.header')
    
    <!-- END: Header-->

    
    <!-- BEGIN: Main Menu-->
    @include('backend.user.layouts.main_menu')
    
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->
    

    
    <!-- BEGIN: Footer-->
    
    @include('backend.user.layouts.footer')
    <!-- END: Footer-->
    
    
    @include('backend.user.layouts.scripts')


</body>
<!-- END: Body-->

</html>
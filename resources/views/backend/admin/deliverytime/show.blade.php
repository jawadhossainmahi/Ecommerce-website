@extends('backend.admin.master')
@section('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <!-- END: Vendor CSS-->
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Leveranstid</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active">Leveranstidslista
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- users list start -->
            <section class="users-list-wrapper">
                <div class="col-md-1  my-3 d-flex align-items-center">
                </div>
                <div class="users-list-table">
                    <div class="card">
                        <div class="card-body">
                            <!-- datatable start -->
                            <div class="table-responsive">
                                <table class="table zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>*</th>
                                            <th>tid</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="delivery-time">
                                     
                                     
                                        <tr>
                                            <td>1</td>
                                            <td >6:00:00-8:00:00</td>
                                            <td>
                                                <a id="6:00:00-8:00:00" class="time-range" >Disable</a>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>2</td>
                                            <td >8:00:00-10:00:00</td>
                                            <td>
                                                <a id="8:00:00-10:00:00" class="time-range" >Disable</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td >10:00:00-12:00:00</td>
                                            <td>
                                                <a id="10:00:00-12:00:00" class="time-range" >Disable</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td >12:00:00-14:00:00</td>
                                            <td>
                                                <a id="12:00:00-14:00:00" class="time-range" >Disable</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td >14:00:00-16:00:00</td>
                                            <td>
                                                <a id="14:00:00-16:00:00" class="time-range" >Disable</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td >16:00:00-18:00:00</td>
                                            <td>
                                                <a id="16:00:00-18:00:00" class="time-range" >Disable</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td >18:00:00-20:00:00</td>
                                            <td>
                                                <a id="18:00:00-20:00:00" class="time-range" >Disable</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td >20:00:00-22:00:00</td>
                                            <td>
                                                <a id="20:00:00-22:00:00" class="time-range" >Disable</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td >22:00:00-24:00:00</td>
                                            <td>
                                                <a id="22:00:00-24:00:00" class="time-range" >Disable</a>
                                            </td>
                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- datatable ends -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- users list ends -->

        </div>
    </div>
</div>
@endsection
@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/js/script.js') }}" type="module"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
@endsection

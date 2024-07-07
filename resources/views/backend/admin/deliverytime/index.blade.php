@extends('backend.admin.master')
@section('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.dateTime.min.css') }}">
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
                                <li class="breadcrumb-item active" style="color: green;">Leveranstidslista
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
                        <button type="button" class="btn btn-primary shadow-none my-2" id="all_delete"
                            style="border-radius:50px">Inaktivera</button>
                        <button type="button" class="btn shadow-none my-2 text-white" id="enables"
                            style="border-radius:50px ; background-color:#02a900;">Gör det möjligt</button>
                        <div class="card">
                            <div class="card-body">
                                  <!-- datatable start -->
                                  <div class="form-floating">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="min">Start Date: </label>
                                            <input type="text" id="min" name="min">
                                        </div>
                                        <div class="col-6" style="left:200px">
                                            <label for="max">End Date: </label>
                                            <input type="text" id="max" name="max">
                                        </div>
                                    </div>

                                </div>
                                <!-- datatable start -->
                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="delivery">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="all_select" name="checkbox"></th>
                                                <th>*</th>
                                                <th>datum</th>
                                                <th>Handling</th>
                                            </tr>
                                        </thead>
                                        <tbody id="delivery-date">


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
    <script>
        //     function loadScript(url) {
        //   return new Promise((resolve, reject) => {
        //     const script = document.createElement('script');
        //     script.src = url;
        //     script.onload = resolve;
        //     script.onerror = reject;
        //     document.head.appendChild(script);
        //   });
        // }

        // loadScript('{{ asset('app-assets/js/script.js') }}')
        //   .then(() => loadScript('{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}'))
        //   .then(() => loadScript('{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}'))
        //   .then(() => loadScript('{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}'))
        //   .then(() => loadScript('{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}'))
        //   .then(() => loadScript('{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}'))
        //   .then(() => loadScript('{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}'))
        //   .then(() => loadScript('{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}'))
        //   .then(() => loadScript('{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}'))
        //   .then(() => loadScript('{{ asset('app-assets/js/scripts/datatables/datatable.js') }}'))
        //   .then(() => {
        //     // Code to be executed after all scripts have loaded
        //   })
        //   .catch((error) => {
        //     console.error(error);
        //   });
    </script>

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
    <script src="{{ asset('app-assets/vendors/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.dateTime.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.dateTime.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/moment/moment.min.js') }}"></script>

    <script>
        $(document).ready(function() {


            let minDate, maxDate;

            // Custom filtering function which will search data in column four between two values
            DataTable.ext.search.push(function(settings, data, dataIndex) {
                let min = minDate.val();
                let max = maxDate.val();
                let date = new Date(data[2]);

                console.log(data);
                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            });

            // Create date inputs
            minDate = new DateTime('#min', {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime('#max', {
                format: 'MMMM Do YYYY'
            });
            let table = new DataTable('#delivery');
            document.querySelectorAll('#min, #max').forEach((el) => {
                el.addEventListener('change', () => table.draw());
            });



        });
    </script>
@endsection

@extends('backend.admin.master')
@section('css')
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.dateTime.min.css') }}" />
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0">Beställa</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" style="color: green;">Orderlista
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    <!--<div class="col-md-1  my-3 d-flex align-items-center">-->
                    <!--<a href="{{ route('admin.order.create') }}" class="btn btn-outline-primary" ><span ><i class='bx bxs-file-plus'></i></span></a>-->
                    <!--</div>-->
                    <div class="users-list-table">

                        <div class="card">
                            <div class="card-body">
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
                                    <table id="orders-data" class="table">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Beställningsnr.</th>
                                                <th>Användarnamn</th>
                                                <th>Användarens e-post</th>
                                                <th nowrap="">Leveranstid</th>
                                                <th>orderstatus</th>
                                                <th>Skapad vid</th>
                                                <th>Handling</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- table.search( this.value ).draw() -->
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.dateTime.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/moment/moment.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            let minDate, maxDate;

            // Create date inputs
            minDate = new DateTime('#min', {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime('#max', {
                format: 'MMMM Do YYYY'
            });

            // Initialize DataTable with server-side processing
            let table = $('#orders-data').DataTable({
                processing: true,
                serverSide: true,
                destroy: true, // Add this line to destroy any existing instance
                ajax: {
                    url: "/admin/order/index",
                    data: function(d) {
                        d.minDate = minDate.val();
                        d.maxDate = maxDate.val();
                    }
                },
                columns: [
                    { data: 'dt_auto_index', name: 'dt_auto_index', searchable: false, orderable: false },
                    { data: 'order_id', name: 'order_id' },
                    { data: 'user_name', name: 'user_name' },
                    { data: 'user_email', name: 'user_email' },
                    { data: 'delivery_time', name: 'delivery_time' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'handle', name: 'handle', searchable: false, orderable: false },
                    // Add more columns as needed
                ],
                // order: [
                //     [0, 'asc']
                // ],
            });

            // Redraw the table when date filters change
            document.querySelectorAll('#min, #max').forEach((el) => {
                el.addEventListener('change', () => table.draw());
            });



        });
    </script>
@endsection

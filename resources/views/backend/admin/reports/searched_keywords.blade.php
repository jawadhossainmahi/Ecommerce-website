@extends('backend.admin.master')
@section('css')
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
                        <h5 class="content-header-title float-left pr-1 mb-0">Rapporter</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active" style="color: green;">Sökte nyckelord</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">

                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-body">
                                <!-- datatable start -->
                                <div class="form-floating">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="min">Start Date: </label>
                                            <input type="text" id="min" name="min">
                                        </div>
                                        <div class="col-6" style="left: 200px">
                                            <label for="max">End Date: </label>
                                            <input type="text" id="max" name="max">
                                        </div>
                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table id="customer-table" class="table zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Keywords</th>
                                                <th>Date Time</th>
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
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.dateTime.min.js') }}"></script>
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
            let table = $('#customer-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true, // Add this line to destroy any existing instance
                ajax: {
                    url: "{{ url()->current() }}",
                    data: function(d) {
                        d.minDate = minDate.val();
                        d.maxDate = maxDate.val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'keyword', name: 'keyword' },
                    { data: 'updated_at', name: 'updated_at' },
                    // Add more columns as needed
                ]
            });

            // Redraw the table when date filters change
            document.querySelectorAll('#min, #max').forEach((el) => {
                el.addEventListener('change', () => table.draw());
            });
        });

    </script>
@endsection

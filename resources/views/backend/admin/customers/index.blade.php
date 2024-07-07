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
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.dateTime.min.css') }}">
    <!-- END: Vendor CSS-->
@endsection
<style>
    /* .myTabContent{
        /* border-collapse: collapse; */
    /* width:"80%";
        height:"40%";
  border: 1px solid #5c4848;
} */
</style>
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0">Kund</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" style="color: green;">Kundlista
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 p-0 card">
                <div class="card" id="new-customer" role="tabpanel" aria-labelledby="new-customer" tabindex="0">
                    <div class="card-header d-flex justify-content-between align-items-center pb-0">
                        <h4 class="card-title">New Customers</h4>
                        <div class="d-flex align-items-end justify-content-end">
                            <!--<span class="mr-25">$25,980</span>-->
                            {{-- <div class="form-floating">
                      <select class="form-select" id="new-customer-data" aria-label="Floating label select example">
                        
                        <option value="year">Year</option>
                        <option value="month">Month</option>
                        <option value="day">Day</option>
                      </select>
                      
                    </div> --}}
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <canvas id="new-customer-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    {{-- <div class="col-md-1  my-3 d-flex align-items-center">
                    <a href="{{ route('admin.order.create') }}" class="btn btn-outline-primary" ><span ><i class='bx bxs-file-plus'></i></span></a>
                </div> --}}
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
                                        <div class="col-6" style="left:200px">
                                            <label for="max">End Date: </label>
                                            <input type="text" id="max" name="max">
                                        </div>
                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table id="customer-table" class="table">
                                        <thead>
                                            <tr>
                                                <th>*</th>
                                                <th>namn</th>
                                                <th>E-post</th>
                                                <th>Antal beställningar</th>
                                                <th>Status</th>
                                                <th>Skapad vid</th>
                                                <th>Hantering</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table">
                                            @foreach ($list as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td><a href="{{ route('admin.order_his.index', ['user_id' => $item->id]) }}"
                                                            style="color: green;">{{ $item->order_count() }}</a></td>
                                                    <td>

                                                        @if ($item->role == '0')
                                                            <span class="badge badge-success">Admin</span>
                                                        @elseif($item->role == '1')
                                                            <span class="badge badge-success">Customer</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                                    <!--<td>-->
                                                    <!--    <a href="{{ route('pdf', ['orders' => $item->id]) }}" ><iconify-icon icon="teenyicons:invoice-outline"></iconify-icon></a>-->

                                                    <!--</td>-->
                                                    <td>
                                                        <a
                                                            href="{{ url('admin/customer/edit', ['user_id' => $item->id]) }}"><i
                                                                class="bx bx-edit-alt" style="color: green;"></i></a>
                                                        <a href="{{ url('admin/customer/delete', ['user_id' => $item->id]) }}"
                                                            onclick="return confirm('Are You Sure To Delete This  ?')"><i
                                                                class="bx bx-trash-alt" style="color: green;"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('app-assets/js/custom-charts.js') }}" type="module"></script>
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
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.dateTime.min.js') }}"></script>
    <script>
        $(document).ready(function() {


            let minDate, maxDate;

            // Custom filtering function which will search data in column four between two values
            DataTable.ext.search.push(function(settings, data, dataIndex) {
                let min = minDate.val();
                let max = maxDate.val();
                let date = new Date(data[5]);

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
            let table = new DataTable('#customer-table');
            document.querySelectorAll('#min, #max').forEach((el) => {
                el.addEventListener('change', () => table.draw());
            });



        });
    </script>
@endsection

@extends('backend.admin.master')
<meta charset="utf-8">
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
                                {{-- <div class="form-floating">
                                      
                                       <select class="form-select" id="totals"
                                            aria-label="Floating label select example">
    
                                            <option value="" id="years">Year</option>
                                            <option value="" id="months">Month</option>
                                            <option value="" id="days">Day</option>
                                        </select> 
                                    </div> --}}
                                <!-- datatable start -->
                                <div class="table-responsive">
                                    <table id="orders-data" class="table">


                                        <thead>

                                            <tr>
                                                <th>Sl</th>
                                                <th>Beställningsnr.</th>
                                                <th>Användarnamn</th>
                                                <th>Användarens e-post</th>
                                                <th>Leveranstid</th>
                                                <th>orderstatus</th>
                                                <th>Skapad vid</th>
                                                <th>Handling</th>
                                            </tr>
                                        </thead>
                                        <tbody id="filter">
                                            @foreach ($list as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->custom_order_id ? $item->custom_order_id : $item->id }}
                                                    </td>
                                                    <td>{{ $item->getdeliveryaddress ? $item->getdeliveryaddress->fname . ' ' . $item->getdeliveryaddress->lname : '' }}
                                                    </td>
                                                    <td>{{ $item->getdeliveryaddress ? $item->getdeliveryaddress->email : '' }}
                                                    </td>
                                                    <td>
                                                        <!--@foreach ($item->getorder as $product)
    -->
                                                        <!--{{ $product->getproduct ? $product->getproduct['name'] : '' }},-->
                                                        <!--
    @endforeach-->

                                                        {{ $item->getdeliverytime ? $item->getdeliverytime->date : '' }}
                                                    </td>
                                                    <td>
                                                        @if($item->status == 0)
                                                            <span class="badge badge-primary">Pending</span>
                                                        @elseif($item->status == 1)
                                                            <span class="badge badge-success">Completed</span>
                                                        @elseif($item->status == 2)
                                                            <span class="badge badge-danger">Cancelled</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.order.edit', ['orders' => $item->id]) }}"><i
                                                                class="bx bx-edit-alt" style="color: green;"></i></a>
                                                        {{-- @if($item->status == 2)
                                                            <a
                                                                href="{{ route('admin.order.showCopyOrder', ['orders' => $item->id]) }}"><i
                                                                    class="bx bx-copy-alt" style="color: green;"></i></a>
                                                        @endif --}}
                                                        <a href="{{ route('admin.order.destroy', ['orders' => $item->id]) }}"
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

            $(document).on("click", "#totals", function() {

                $("#filter").html("");
                var totalss = $(this).val();
                var d = new Date();
                var year = d.getFullYear();
                var day = d.getDate();
                var month = d.getMonth() + 1;

                var years = $("#years").val(year);
                var dates = $("#days").val(day);
                var month = $("#months").val(month);

                // console.log(years);
                $.ajax({
                    url: "/admin/order/filterorder",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        totalss: totalss
                    },
                    success: function(response) {
                        // console.log(response);

                        $.each(response, function(key, value) {
                            var date = new Date(value.created_at);
                            var day = date.getDate();
                            var year = date.getFullYear();
                            var month = date.getMonth() + 1;
                            var dayAndMonth = year.toString().padStart(2, '0') + '/' +
                                month.toString().padStart(2, '0') + '/' + day.toString()
                                .padStart(2, '0');

                            if (value.status == '0') {
                                status =
                                    "<span class='badge badge-primary'>Pending</span>";

                            } else if (value.status == '1') {
                                status =
                                    "<span class='badge badge-success'>Completed</span>";
                            } else {
                                status =
                                    "<span class='badge badge-danger'>Cancelled</span>";
                            }
                            var id = 1 + key;
                            $("#filter").append("<tr><td>" + id + "</td>" +
                                "<td>" + value.getuser.name + "</td>" +
                                "<td>" + value.getuser.email + "</td>" +
                                "<td>" + value.getdeliverytime.date + "</td>" +
                                "<td>" + status + "</td>" +
                                "<td>" + dayAndMonth + "</td>" +
                                "<td><a href='/admin/order/update/" + value.id +
                                "'><i class='bx bx-edit-alt' style='color: green;'></i></a>" +
                                "<a href='/admin/order/destroy/" + value.id +
                                "' id='delete' onclick='return confirm('Are You Sure To Delete This  ?')><i class='bx bx-trash-alt' style='color: green;'></i></a>" +
                                "</td>" +
                                "</tr>");
                        });
                        //             $("#delete").click(function () {
                        //     alert("Are You Sure To Delete This ?");
                        // });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#orders-data').DataTable({
                order: [
                    [0, 'asc']
                ],

            });
        });
    </script>
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
            let table = new DataTable('#orders-data');
            document.querySelectorAll('#min, #max').forEach((el) => {
                el.addEventListener('change', () => table.draw());
            });



        });
    </script>
@endsection

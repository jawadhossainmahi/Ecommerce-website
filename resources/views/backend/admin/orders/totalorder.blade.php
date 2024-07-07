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
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0">Payment</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" style="color: green;">Payment Details
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 p-0 card">
                <div class="card " id="total-payment" role="tabpanel" aria-labelledby="total-payment" tabindex="0">
                    <div class="card-header d-flex justify-content-between align-items-center pb-0">
                        <h4 class="card-title">Total Payment</h4>
                        <div class="d-flex align-items-end justify-content-end">
                            <!--<span class="mr-25">$25,980</span>-->
                            <div class="form-floating">
                                <select class="form-select" id="total-payment-data"
                                    aria-label="Floating label select example">

                                    <option value="year">Year</option>
                                    <option value="month">Month</option>
                                    <option value="day">Day</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <canvas id="total-payment-chart"></canvas>
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
                        {{-- <button type="button" class="btn btn-danger shadow-none my-2" id="delete" style="border-radius:50px" >Bulk delete</button> --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="min">Start Date: </label>
                                        <input type="text" id="min" name="min">
                                    </div>
                                    <div class="col-6">
                                        <label for="max">End Date: </label>
                                        <input type="text" id="max" name="max">
                                    </div>
                                </div>
                                <!-- datatable start -->
                                <div class="table-responsive">
                                    <table id="total-order-table" class="table">
                                        <thead>
                                            <tr>
                                                <th>ORDER NO</th>
                                                <th>USER NAME</th>
                                                <th>USER'S EMAIL</th>
                                                <th>DELIVERY TIME </th>
                                                <th>TOTAL PAYMENT</th>
                                                <th>CREATED AT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $item)
                                                <tr class="item">
                                                    <td>
                                                        {{ $item->custom_order_id }}

                                                    </td>
                                                    <td>
                                                        {{ $item->getuser->name }}

                                                    </td>
                                                    <td>
                                                        {{ $item->getuser->email }}

                                                    </td>
                                                    <td>
                                                        {{ $item->getdeliverytime->date }}

                                                    </td>
                                                    <td class="item-price">
                                                        {{ $item->total_price }}

                                                    </td>
                                                    <td>
                                                        {{ $item->created_at }}

                                                    </td>
                                                    {{-- <td>{{$item->getproduct->name}}</td> --}}
                                                    {{-- @php
                                                $product_price = $item->getorder->discount_price ? $item->getorder->discount_price : $item->getorder->price
                                            @endphp
                                            <td>{{ $product_price }}</td>
                                            <td>{{ $item->qty }}</td>
                                           
                                            <td>
                                                {{$item->custom_order_id}} 
                                                @if ($product_price)
                                                    
                                                {{ str_replace(".",":",(float)str_replace(":",".",$product_price) * $item->qty) }}
                                                @endif
                                            </td>  --}}



                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                    {{-- <h3 style="text-align: right">Total Price: <span id="total-price" >0</span></h3> --}}

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

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>
    <!-- END: Page JS-->
    <script src="{{ asset('app-assets/vendors/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.dateTime.min.js') }}"></script>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
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
            let table = new DataTable('#total-order-table', {
                order: [
                    [5, 'desc']
                ],

            });
            document.querySelectorAll('#min, #max').forEach((el) => {
                el.addEventListener('change', () => table.draw());
            });



        });
    </script>
    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        $("#product_form").on("submit", function() {
            $("#product_information").val($("#editor").html());
        })
    </script>
    <script>
        var quill = new Quill('#editor1', {
            theme: 'snow'
        });
        $("#product_form").on("submit", function() {
            $("#nutritional_content").val($("#editor1").html());
        })
    </script>
    <script>
        var quill = new Quill('#editor2', {
            theme: 'snow'
        });
        $("#product_form").on("submit", function() {
            $("#other_information").val($("#editor2").html());
        })
    </script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-select2.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // in this function use to get order table price totals 
        $(document).ready(function() {
            // Function to update the total price without considering quantity
            function updateTotalPrice() {
                var totalPrice = 0;
                $(".item").each(function() {
                    var price = parseFloat($(this).find(".item-price").text());
                    totalPrice += price;
                });
                $("#total-price").text(totalPrice.toFixed(2));
            }

            // Update total price when the page loads
            updateTotalPrice();
        });
    </script>
@endsection

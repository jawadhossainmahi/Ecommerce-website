@extends('backend.admin.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/authentication.css') }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Beställa</a>
                                </li>
                                <li class="breadcrumb-item active" style="color: green;">Orderdetaljer
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Simple Validation start -->
                <section class="users-edit">
                    <div class="card">
                        <div class="card-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    {{ __('There were some problems with your input.') }} <br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- users edit media object ends -->
                            <!-- users edit account form start -->
                            <form class="form-validate"
                                action="{{ route('admin.order.update', ['orders' => $orders->id]) }}" method="POST"
                                id="product_form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Beställa
                                                    #{{ $orders->custom_order_id ? $orders->custom_order_id : $orders->id }}
                                                </h4>
                                            </div>
                                            <div class="card-body" style="overflow-y:auto">
                                                <div class="row ">
                                                    <div class="col-md-4 ">
                                                        <h5>Skapad vid</h5>

                                                        {{ $orders->created_at }}
                                                        <br />
                                                        <h5> Status </h5>


                                                        <input type="hidden" name="name"
                                                            value="{{ $orders->getdeliveryaddress->fname . ' ' . $orders->getdeliveryaddress->lname }}">
                                                        <input type="hidden" name="email"
                                                            value="{{ $orders->getdeliveryaddress->email }}">
                                                        <input type="hidden" name='pid' value="{{ $orders->id }}">
                                                        <select id="status" name='status' class="form-select mb-2  "
                                                            style="padding:5px 20px">


                                                            <option value="0"
                                                                {{ $orders->status == 0 ? 'selected' : '' }}>I väntan på
                                                            </option>
                                                            <option value="1"
                                                                {{ $orders->status == 1 ? 'selected' : '' }}>Avslutad
                                                            </option>
                                                            <option value="2"
                                                                {{ $orders->status == 2 ? 'selected' : '' }}>Inställt
                                                            </option>

                                                        </select>

                                                        <br>
                                                        <button type="submit" class="btn" name="update_status"
                                                            style="color: white; background: green;">Uppdatering</button>


                                                        <br>
                                                        <br>
                                                        <h5>
                                                            Leveransdatum och tid
                                                        </h5>
                                                        <p>
                                                            {{ $orders->getdeliverytime->date }}
                                                            {{ substr($orders->getdeliverytime->start_time, 0, 5) . '-' . substr($orders->getdeliverytime->end_time, 0, 5) }}
                                                        </p>

                                                        <h5>
                                                            Återkommande leverans:


                                                        </h5>
                                                        <p>
                                                            {{ $orders->recurring_delivery ? ($orders->recurring_delivery == 'every_week' ? 'Every Week' : 'Bi Weekly') : 'None' }}
                                                        </p>
                                                        <h5>
                                                            Lämna varor utanför dörren:
                                                        </h5>
                                                        <p>
                                                            {{ $orders->leave_outside ? 'Yes' : 'No' }}
                                                        </p>


                                                    </div>
                                                    <div class="col-md-4 ">

                                                        @if ($orders->getuser->customer_type == 1)
                                                            <h5>{{ $orders->getuser->name }}</h5>
                                                            <p class="mb-3">{{ $orders->getuser->organization }}</p>
                                                        @endif

                                                        <h5>{{ $orders->getuser->customer_type == 1 ? 'Leveransadress' : 'Billing' }}
                                                        </h5>
                                                        <p>

                                                            {{ $orders->getdeliveryaddress->fname . ' ' . $orders->getdeliveryaddress->lname }}
                                                            </br>
                                                            {{ $orders->getdeliveryaddress->street_address }} </br>
                                                            {{ $orders->getdeliveryaddress->city }} </br>
                                                            {{ $orders->getdeliveryaddress->postal_code }} </br>
                                                        <h6> E-postadress </h6>
                                                        <a href='mailto:{{ $orders->getdeliveryaddress->email }}'
                                                            style=" color:green;">
                                                            {{ $orders->getdeliveryaddress->email }}</a>
                                                        <h6> Telefon </h6>
                                                        <a href='tel:{{ $orders->getdeliveryaddress->phone }}'
                                                            style=" color:green;">{{ $orders->getdeliveryaddress->phone }}</a>

                                                        @if ($orders->getuser->customer_type == 1)
                                                            <h5 class="mt-3">Fakturaadress</h5>
                                                            <p>

                                                                {{ $orders->getbillingaddress->fname . ' ' . $orders->getbillingaddress->lname }}
                                                                </br>
                                                                {{ $orders->getbillingaddress->street_address }} </br>
                                                                {{ $orders->getbillingaddress->city }} </br>
                                                                {{ $orders->getbillingaddress->postal_code }} </br>
                                                            <h6> E-postadress </h6>
                                                            <a href='mailto:{{ $orders->getbillingaddress->invoice_email ?? $orders->getbillingaddress->email }}'
                                                                style=" color:green;">
                                                                {{ $orders->getbillingaddress->invoice_email ?? $orders->getbillingaddress->email }}</a>
                                                            <h6> Telefon </h6>
                                                            <a href='tel:{{ $orders->getbillingaddress->phone }}'
                                                                style=" color:green;">{{ $orders->getbillingaddress->phone }}</a>
                                                            <br><br>
                                                            <h6>Namn på mottagare</h6>
                                                            {{ $orders->getbillingaddress->name_of_recipient }}
                                                            </p>
                                                        @endif

                                                        <h5>Meddelande:</h5>
                                                        <p>
                                                            {{ $orders->message }}
                                                        </p>
                                                    </div>

                                                    <div class="col-md-4 ">
                                                        <h5>Total</h5>
                                                        <p>
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Delsumma</th>
                                                                    <td class="border-t-[3px]">
                                                                        @if ($orders->total_price < 905)
                                                                            @if (!$orders->coupon->isEmpty())
                                                                                @if ($orders->coupon[0]->type != 'FreeShipping')
                                                                                    {{ $orders->total_price - 95 }}
                                                                                @else
                                                                                    {{ $orders->total_price }}
                                                                                @endif
                                                                            @else
                                                                                {{ $orders->total_price }}
                                                                            @endif
                                                                        @else
                                                                            {{ $orders->total_price }}
                                                                        @endif

                                                                    </td>
                                                                    </th>

                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Rabattkod</th>
                                                                    <td>
                                                                        {{ $orders->coupon->isEmpty() ? 'None' : $orders->coupon[0]->code }}
                                                                    </td>
                                                                    </th>

                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Kupongtyp</th>
                                                                    <td>
                                                                        {{ $orders->coupon->isEmpty() ? 'None' : $orders->coupon[0]->type }}
                                                                    </td>
                                                                    </th>

                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Shipping</th>
                                                                    <td>

                                                                        @if ($orders->total_price < 905)
                                                                            @if (!$orders->coupon->isEmpty())
                                                                                @if ($orders->coupon[0]->type != 'FreeShipping')
                                                                                    95
                                                                                @else
                                                                                    0
                                                                                @endif
                                                                            @else
                                                                                0
                                                                            @endif
                                                                        @else
                                                                            0
                                                                        @endif

                                                                    </td>
                                                                    </th>
                                                                </tr>
                                                                @php
                                                                    $sum_of_all_tax = 0;
                                                                @endphp
                                                                @if ($totalTaxAmt12 > 0)
                                                                    @php
                                                                        $sum_of_all_tax =
                                                                            $sum_of_all_tax + $totalTaxAmt12;
                                                                    @endphp
                                                                    <tr>
                                                                        <th scope="row">Varav 12% moms</th>
                                                                        <td>
                                                                            {{ display_price_format(number_format($totalTaxAmt12, 2)) }}
                                                                        </td>
                                                                    </tr>
                                                                @endif

                                                                @if ($totalTaxAmt25 > 0)
                                                                    @php
                                                                        $sum_of_all_tax =
                                                                            $sum_of_all_tax + $totalTaxAmt25;
                                                                    @endphp
                                                                    <tr>
                                                                        <th scope="row">Varav 25% moms</th>
                                                                        <td>
                                                                            {{ display_price_format(number_format($totalTaxAmt25, 2)) }}
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <th scope="row">Total moms</th>
                                                                    <td>
                                                                        {{ display_price_format(number_format($sum_of_all_tax, 2)) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Total beställning</th>
                                                                    <td>
                                                                        {{ $orders->total_price }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mt-2">
                                            <div class="card-header">

                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Item</th>
                                                            <th>Cost</th>
                                                            <th>Quantity</th>
                                                            <th>Total</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($orders->getorder as $item)
                                                            <tr>
                                                                <td>
                                                                    <img src="{{ asset($item->getproduct->image ? $item->getproduct->image->path : 'frontend/images/no-item.png') }}"
                                                                        width="50px" height="40px" alt="">
                                                                </td>
                                                                <td>{{ $item->getproduct->name }}</td>
                                                                @php
                                                                    $product_price = $item->getproduct->discount_price
                                                                        ? $item->getproduct->discount_price
                                                                        : $item->getproduct->price;
                                                                @endphp
                                                                <td>{{ $product_price }}</td>
                                                                <td>{{ $item->qty }}</td>

                                                                <td>

                                                                    @if ($product_price)
                                                                        {{ str_replace('.', ',', (float) str_replace(',', '.', $product_price) * $item->qty) }}
                                                                    @endif
                                                                </td>



                                                            </tr>
                                                        @endforeach




                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- Input Validation end -->

            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>
    <!-- END: Page JS-->


    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

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
@endsection

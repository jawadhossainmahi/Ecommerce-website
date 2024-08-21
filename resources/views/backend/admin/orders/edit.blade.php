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
                        <h5 class="content-header-title float-left pr-1 mb-0">Order</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Order List</a>
                                </li>
                                <li class="breadcrumb-item active" style="color: green;">Order Create
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
                            <form class="form-validate" action="{{ route('admin.order.update', ['orders' => $orders->id]) }}" method="POST" id="product_form">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>User name</label>
                                                <select id="user_id" class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                                    @foreach ($user as $item)
                                                        <option value="{{ $item->id }}" @if ($item->id == $orders->user_id ?? old('user_id')) selected @endif> {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Product Name</h6>
                                        <fieldset class="form-group">
                                            <select class="form-control select2 @error('product_id') is-invalid @enderror" id="product_id" multiple="multiple" name="product_id[]">
                                                @foreach ($product as $productid)
                                                    @foreach ($orders->getorder as $order_list_id)
                                                        <option value="{{ $productid->id }}" @if ($productid->id == $order_list_id->product_id) selected @endif>{{ $productid->name }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Compare Price</label>
                                                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status">
                                                    <option value="Pending" @if ($orders->status == 'Pending') selected @endif>Pending </option>
                                                    <option value="Completed" @if ($orders->status == 'Completed') selected @endif>Completed </option>
                                                    <option value="Cancelled" @if ($orders->status == 'Cancelled') selected @endif>Cancelled </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between w-100">
                                    <button type="submit" id="submit" class="btn btn-primary glow ">Add</button>
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

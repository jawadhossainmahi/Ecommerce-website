@extends('backend.admin.master')
@section('css')
<link rel="stylesheet" type="text/css"
    href="{{ asset('app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
    <style>
        label{margin-left: 20px;}
#datepicker{width:180px; margin: 0 20px 20px 20px;}
#datepicker > span:hover{cursor: pointer;}
    </style>
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Coupons</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">Coupons List</a>
                            </li>
                            <li class="breadcrumb-item active">Coupons Create
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
                        <form class="form-validate" action="{{ route('admin.coupons.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Coupon Name</label>
                                            <input type="text" class="form-control"  placeholder="Enter Name"  name="name" value="{{old('name')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Start Date:</label>
                                            <input type="date" id="datePickerId" class="form-control"  placeholder="Enter Name"  name="start_date" value="{{old('start_date')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>End Date:</label>
                                            <input type="date" id="datePickerId" class="form-control"  placeholder="Enter Name"  name="end_date" value="{{old('end_date')}}">
                                        </div>
                                    </div>
                                </div>
                                   

                                  <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Type</label>
                                            <select id="type"  class="form-control @error('type') is-invalid @enderror" name="type">
                                                
                                                <option value="Free shipping" @if (old('Free shipping') == 'Free shipping '  ) selected @endif> Free shipping</option>
                                                <option value="New customer " @if (old('New customer ') == 'New customer  '  ) selected @endif> New customer </option>
                                                <option value="others" @if (old('others') == 'others '  ) selected @endif> others</option>
                                              
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                             
                            
                            
                            <div class="d-flex justify-content-between w-100">
                                    <button type="submit" class="btn btn-primary glow ">Add</button>
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
<script>
    datePickerId.max = new Date().toISOString().split("T")[0];
</script>
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>
<!-- END: Page JS-->

@endsection

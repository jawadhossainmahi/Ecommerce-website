@extends('backend.admin.master')
@section('css')
<link rel="stylesheet" type="text/css"
    href="{{ asset('app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
    <style>
        
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
                    <h5 class="content-header-title float-left pr-1 mb-0">Kuponger</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">Kuponger lista</a>
                            </li>
                            <li class="breadcrumb-item active">Skapa kuponger
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
                           <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 control-label require"
                                                        for="name">{{ __('Name') }}</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" placeholder="{{ __('Name') }}"
                                                            class="form-control inputFieldDesign" id="name"
                                                            name="name" required maxlength="120"
                                                            oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                            value="{{ old('name') }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 control-label require"
                                                        for="code">{{ __('Code') }}</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" placeholder="{{ __('Code') }}"
                                                            class="form-control inputFieldDesign" id="code"
                                                            name="code" required maxlength="100"
                                                            oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                            value="{{ old('code') }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 control-label text-left"
                                                        for="type">{{ __('Discount Type') }}</label>
                                                    <div class="col-sm-6">
                                                        <select
                                                            class="form-control select2-hide-search sl_common_bx inputFieldDesign"
                                                            id="discount_type" name="type" required
                                                            oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                            <option value="Flat"
                                                                {{ old('type') == 'Flat' ? 'selected' : '' }}>
                                                                {{ __('Flat') }}</option>
                                                            <option value="Percentage"
                                                                {{ old('type') == 'Percentage' ? 'selected' : '' }}>
                                                                {{ __('Percentage') }}</option>
                                                            <option value="FreeShipping"
                                                                {{ old('type') == 'FreeShipping' ? 'selected' : '' }}>
                                                                {{ __('Free Shipping') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row"  id="discounted_amount">
                                                    <div class="col-sm-2">
                                                        <label class="control-label text-left discount_amount_label require"
                                                            for="amount">{{ __('Discount Amount') }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="number" step="any"
                                                            placeholder="{{ __('Discount Amount') }}"
                                                            class="form-control inputFieldDesign" id="discount_amount"
                                                            max="99999999" name="amount"
                                                            oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                            data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}"
                                                            value="{{ old('amount') }}">
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group row" id="max_discount">
                                                    <label class="col-sm-2 control-label text-left"
                                                        for="max_discount">{{ __('Maximum Discount') }}</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" step="any"
                                                            placeholder="{{ __('Maximum Discount') }}"
                                                            class="form-control inputFieldDesign"
                                                            id="maximum_discount_amount" max="99999999"
                                                            name="max_discount"
                                                            data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}"
                                                            value="{{ old('max_discount') }}">
                                                    </div>
                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <label class="control-label text-left  require"
                                                            for="amount">{{ __('Usage Limit') }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="number" step="any"
                                                            placeholder="{{ __('Usage Limit') }}"
                                                            class="form-control inputFieldDesign" id="usage_limit"
                                                            max="99999999" name="usage_limit" 
                                                            oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                            data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}"
                                                            value="{{ old('usage_limit') }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 control-label require text-left"
                                                        for="start_date">{{ __('Start Date') }}</label>
                                                    <div class="d-flex date col-sm-6">
                                                        
                                                        <input type="date" id="datePickerId" class="form-control"  placeholder="Enter Name"  name="start_date" value="{{old('start_date')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 control-label require"
                                                        for="end_date">{{ __('End Date') }}</label>
                                                    <div class="d-flex date col-sm-6">
                                                        
                                                        <input type="date" id="datePickerId" class="form-control"  placeholder="Enter Name"  name="end_date" value="{{old('end_date')}}">
                                                    </div>
                                                </div>
                                                
                                            </div>
                             
                            
                            
                            <div class="d-flex justify-content-between w-100">
                                    <button type="submit" class="btn btn-primary glow ">Lägg till</button>
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
<script>
function discount() {
    if ($('select[name="type"]').val() != "Percentage" ) {
        $('#max_discount').hide();
        $('#discounted_amount').show();
    } else {
        $('.discount_amount_label').text(jsLang('Discount Percentage'))
    }
    if ($('select[name="type"]').val() != "FreeShipping" ) {
         $('#max_discount').hide();
         
    }

    $('select[name="type"]').on('change', function(e) {
        if (e.target.value == 'Percentage') {
            $('#max_discount').show();
            $('#discounted_amount').show();
        } else {
            $('#max_discount').hide();
        }
        if ($('select[name="type"]').val() == "Flat" ) {
         $('#max_discount').hide();
         $('#discounted_amount').show();
        }
        if ($('select[name="type"]').val() == "FreeShipping" ) {
         $('#max_discount').hide();
         $('#discounted_amount').hide();
        }
        
        
        
    })
}
discount();
    // Coupon add section (Admin panel)
if ($('.main-body .page-wrapper').find('#coupon-add-container').length) {
    $('input[name="start_date"]').daterangepicker(dateSingleConfig());
    $('input[name="end_date"]').daterangepicker(dateSingleConfig());
}

// Coupon edit section (Admin panel)
if ($('.main-body .page-wrapper').find('#coupon-edit-container').length) {
    $('input[name="start_date"]').daterangepicker(dateSingleConfig($('input[name="start_date"]').val()));
    $('input[name="end_date"]').daterangepicker(dateSingleConfig($('input[name="end_date"]').val()));

}

</script>

@endsection

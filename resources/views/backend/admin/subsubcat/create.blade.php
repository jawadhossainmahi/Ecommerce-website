@extends('backend.admin.master')
@section('css')
<link rel="stylesheet" type="text/css"
    href="{{ asset('app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Kategori</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.subsubcat.index') }}">Underkategori Lista</a>
                            </li>
                            <li class="breadcrumb-item active" style="color: green;">Sub-Underkategori Skapa
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
                        <form class="form-validate" action="{{ route('admin.subsubcat.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Sub-Underkategori namn</label>
                                            <input type="text" class="form-control"  placeholder="Stiga på Sub-Underkategori namn"  name="name" value="{{old('name')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 pl-0">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>Underkategori</label>
                                        <select id="category_id"  class="form-control @error('category_id') is-invalid @enderror" name="sub_cat_id">
                                            @foreach ($car_category as $item)
                                            <option value="{{$item->id}}" @if ($item->id ==   old('sub_cat_id')) selected @endif> {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between w-100">
                                    <button type="submit" class="btn" style="color: white; background: green;">Lägg till</button>
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
@endsection

@extends('backend.admin.master')
@section('css')
<link rel="stylesheet" type="text/css"
    href="{{ asset('app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
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
                    <h5 class="content-header-title float-left pr-1 mb-0">Product</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Product List</a>
                            </li>
                            <li class="breadcrumb-item active">Product Create
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
                        <form class="form-validate" action="" method="POST" id="product_form" enctype="multipart/form-data">
                            @csrf
                            
                           
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Question</label>
                                            <input type="text" class="form-control  @error('name') is-invalid @enderror"  placeholder=""  name="question" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Answer</label>
                                            <input type="text" class="form-control  @error('l_name') is-invalid @enderror"  placeholder=""  name="answer" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <div class="">
                                          @foreach($cat as $key => $value)
                                       <?php $id=$value->cat_id;
                                        echo $id;?>  
                                            <label>test</label>
                                            <input type="checkbox" id="check" class="form-control  @error('email') is-invalid @enderror"  placeholder=""  name="check1" value="1">
                                        </div>
                                     @endforeach
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>test2</label>
                                            <input type="text" class="form-control  @error('l_name') is-invalid @enderror"  placeholder=""  name="checck2" value="2">
                                        </div>
                                    </div>
                                </div>
                               

                            <div class="d-flex justify-content-between w-100">
                                    <button type="button" id="submit" class="btn btn-primary glow ">Update</button>
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
    $(document).ready(function(){
        $("#submit").on("click",function(){
            var checkid=$("#check").val();
            var id=$("#check2").val();
            console.log(id);
            console.log(checkid);
        });
    });
</script>
@endsection
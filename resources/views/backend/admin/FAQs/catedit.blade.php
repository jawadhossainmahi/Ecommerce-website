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
                    <h5 class="content-header-title float-left pr-1 mb-0">Kategori</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <!--<li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">FAQs  List</a>-->
                            </li>
                            <li class="breadcrumb-item active" style="color: green;">Kategori Redigera
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            @if(session('success'))
             <div id="success" class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
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
                        <form class="form-validate" action="{{url('/')}}/admin/FAQs/catupdate/{{$edit->cat_id}}" method="POST" id="product_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                
                                <div class="col-12 col-sm-6">
                                   
                                    <div class="form-group">
                                        
                                        <div class="controls">
                                            <label>namn</label>
                                            <div class="mb-3">
                                       <input type="text" class="form-control" name="name" id="" value="{{$edit->name_category}}" >
                                   </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            

                            <div class="d-flex justify-content-between w-100">
                                    <button type="submit" id="submit" class="btn" style="background: green; color: white;">Uppdatering</button>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        setTimeOut(function(){
            $("#success").fadeOut('slow');
        },2000);
    });
</script>
@endsection

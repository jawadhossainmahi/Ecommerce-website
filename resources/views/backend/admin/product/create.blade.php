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
                        <h5 class="content-header-title float-left pr-1 mb-0">Produkt</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Produktlista</a>
                                </li>
                                <li class="breadcrumb-item active" style="color: green;">Produkt skapa
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
                            <form class="form-validate" action="{{ route('admin.product.store') }}" method="POST"
                                id="product_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>namn</label>
                                                <input type="text"
                                                    class="form-control  @error('name') is-invalid @enderror"
                                                    placeholder="Skriv namn" name="name" value="{{ old('name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Lagring</label>
                                                <input type="text"
                                                    class="form-control  @error('storage') is-invalid @enderror"
                                                    placeholder="Gå in i lagring" name="storage"
                                                    value="{{ old('storage') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>kategori</label>
                                                <select id="category_id"
                                                    class="form-control @error('category_id') is-invalid @enderror"
                                                    name="category_id" onchange="category()">
                                                    @foreach ($category_list as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == old('category_id')) selected @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Underkategori</label>
                                                <select id="sub_cat_id"
                                                    class="form-control @error('sub_cat_id') is-invalid @enderror"
                                                    name="sub_cat_id" onchange="sub_cat()">
                                                    @foreach (\App\Models\SubCategory::get() as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == old('sub_cat_id')) selected @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Sub-Underkategori</label>
                                                <select id="subsub_cat_id"
                                                    class="form-control @error('subsub_cat_id') is-invalid @enderror"
                                                    name="subsub_cat_id">
                                                    @foreach (\App\Models\SubSubCat::get() as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == old('subsub_cat_id')) selected @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>märka</label>
                                                <select id="tag_id"
                                                    class="form-control @error('tag_id') is-invalid @enderror"
                                                    name="tag_id">
                                                    @foreach ($tag_list as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == old('tag_id')) selected @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 col-md-6">
                                    <h6>Produktvarumärken</h6>
                                    <fieldset class="form-group">
                                        <select class="form-control select2 @error('product_trademark') is-invalid @enderror" id="product_trademark" multiple="multiple" name="product_trademark[]">
                                            @foreach (\App\Models\Trademark::get() as $item)
                                            
                                            <option value="{{$item->id}}" @if ($item->id == old('product_trademark')) selected  @endif>{{$item->name}}</option>
                                            
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div> --}}

                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Produktdieter</label>
                                                <select id="product_diet"
                                                    class="form-control select2 @error('product_diet') is-invalid @enderror"
                                                    name="product_diet[]" multiple="multiple">
                                                    @foreach (\App\Models\Diet::get() as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == old('product_diet')) selected @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Produktinformation</label>
                                                <div id="editor"></div>
                                                <textarea name="Produktinformation" hidden id="product_information"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Ursprung</label>
                                                <select id="origin_id"
                                                    class="form-control @error('origin_id') is-invalid @enderror"
                                                    name="origin_id">
                                                    @foreach ($product_origin as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == old('origin_id')) selected @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Ingredienser</label>
                                                <input type="text"
                                                    class="form-control  @error('ingredients') is-invalid @enderror"
                                                    placeholder="Ange ingredienser" name="ingredients"
                                                    value="{{ old('ingredients') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Näringsinnehåll</label>
                                                <div id="editor1"></div>
                                                <textarea name="näringsinnehåll" hidden id="nutritional_content"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Annan information</label>
                                                <div id="editor2"></div>
                                                <textarea name="Annan information" hidden id="other_information"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Köp två för</label>
                                                <select id="buy_two_get"
                                                    class="form-control @error('buy_two_get') is-invalid @enderror"
                                                    name="buy_two_get">
                                                    <option value="0"
                                                        @if (old('buy_two_get') == 0) selected @endif>Normal</option>
                                                    <option value="1 "
                                                        @if (old('buy_two_get') == 1) selected @endif>Buy Two For
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Pris</label>
                                                <input type="text"
                                                    class="form-control  @error('price') is-invalid @enderror"
                                                    placeholder="Ange pris" name="price" value="{{ old('price') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Köp för x Jämför pris</label>
                                                <input type="text"
                                                    class="form-control  @error('price_per_item') is-invalid @enderror"
                                                    placeholder="Ange Köp för x jämför pris" name="price_per_item"
                                                    value="{{ old('price_per_item') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Jämför pris</label>
                                                <input type="text"
                                                    class="form-control  @error('compare_price') is-invalid @enderror"
                                                    placeholder="Ange Jämför pris" name="compare_price"
                                                    value="{{ old('compare_price') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Nedsatt pris</label>
                                                <input type="text"
                                                    class="form-control  @error('discount_price') is-invalid @enderror"
                                                    placeholder="Ange rabattpris" name="discount_price"
                                                    value="{{ old('discount_price') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Pant</label>
                                                <input type="text"
                                                    class="form-control  @error('pant') is-invalid @enderror"
                                                    placeholder="Pant" name="pant" value="{{ old('pant') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Vikt</label>
                                                <input type="text"
                                                    class="form-control  @error('weight') is-invalid @enderror"
                                                    placeholder="Ange produktens vikt" name="weight"
                                                    value="{{ old('weight') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Ladda upp produktbild</label>
                                                <input class="form-control " type="file" multiple name="image"
                                                    value="{{ old('image') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Status</label>
                                                <select id="status"
                                                    class="form-control @error('status') is-invalid @enderror"
                                                    name="status">
                                                    <option value="In Stock"
                                                        @if (old('status') == 'In Stock') selected @endif>In Stock</option>
                                                    <option value="Out Of Stock "
                                                        @if (old('status') == 'Out Of Stock ') selected @endif>Out Of Stock
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>{{ \App\Models\Setting::first()->campaign_name ?? 'veckans extrapriser' }}</label>
                                                <select id="veckans_extrapriser"  class="form-control @error('veckans_extrapriser') is-invalid @enderror" name="veckans_extrapriser">
                                                    <option value="0">No </option>
                                                    <option value="1">Yes </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>{{ \App\Models\Setting::first()->campaign_name ?? 'veckans extrapriser' }} quantity</label>
                                                <input type="text" class="form-control  @error('veckans_qty') is-invalid @enderror"  placeholder="quantity"  name="veckans_qty" value="{{ old('veckans_qty') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Beskatta</label>
                                                <select name="tax" class="form-control @error('tax') is-invalid @enderror" id="tax">
                                                    <option value="12">12%</option>
                                                    <option value="25">25%</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between w-100">
                                    <button type="submit" id="submit" class="btn"
                                        style="color: white; background: green;">Lägg till</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- Input Validation end -->

            </div>
        </div>
    </div>
    <script>
        function category() {
            var product_category = document.getElementById('category_id').value;
            // alert(product_category);
            $.ajax({
                type: "get",
                url: "{{ route('ajax.category') }}",
                data: {
                    id: product_category
                },
                success: function(data) {
                    console.log(data);
                    let cat = "";
                    data.forEach(element => {
                        cat += '<option value=' + element.id + ' > ' + element.name + '</option>';

                    });
                    var a = document.getElementById('sub_cat_id').innerHTML = cat;
                    //    console.log(a);
                },
                error: function(data) {
                    console.log(data);
                }
            });


        }

        function sub_cat() {
            var product_sub_category = document.getElementById('sub_cat_id').value;
            // alert(product_category);
            $.ajax({
                type: "get",
                url: "{{ route('ajax.subcategory') }}",
                data: {
                    id: product_sub_category
                },
                success: function(data) {
                    console.log(data);
                    let cat = "";
                    data.forEach(element => {
                        cat += '<option value=' + element.id + ' > ' + element.name + '</option>';

                    });
                    var a = document.getElementById('subsub_cat_id').innerHTML = cat;
                    //    console.log(a);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        const sub_cat_id = document.getElementById('sub_cat_id')

        if (sub_cat_id) {
            sub_cat_id.addEventListener('select', function() {
                sub_cat()
                category()
            })
        }
        const category_id = document.getElementById('category_id')
        if (category_id) {
            category_id.addEventListener('select', function() {
                category()
                sub_cat()

            })
        }
    </script>
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

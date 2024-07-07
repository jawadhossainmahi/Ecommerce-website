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
                    <h5 class="content-header-title float-left pr-1 mb-0">Kund</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">kundlista</a>
                            </li>
                            <li class="breadcrumb-item active" style="color: green;">kunder Skapa
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
             Simple Validation start 
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
                         users edit media object ends 
                         users edit account form start 
                        <form class="form-validate" action="{{url('/') }}/admin/customer/update/{{$customers->id}}" method="POST" id="customers_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>namn</label>
                                            <input type="text" class="form-control  @error('name') is-invalid @enderror"  placeholder="namn"  name="name" value="{{$customers->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Efternamn</label>
                                            <input type="text" class="form-control  @error('storage') is-invalid @enderror"  placeholder="Efternamn"  name="l_name" value="{{$customers->l_name}}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>E-post</label>
                                            <input type="text" class="form-control  @error('ingredients') is-invalid @enderror"  placeholder="E-post"  name="email" value="{{$customers->email}}">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Telefon</label>
                                            <input type="text" class="form-control  @error('price') is-invalid @enderror"  placeholder="Telefon"  name="phone" value="{{$customers->phone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>postnummer</label>
                                            <input type="text" class="form-control  @error('price_per_item') is-invalid @enderror"  placeholder="postnummer"  name="postal_code" value="{{$customers->postal_code}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Stad</label>
                                            <input type="text" class="form-control  @error('compare_price') is-invalid @enderror"  placeholder="Stad"  name="city" value="{{$customers->city}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Adress</label>
                                            <input type="text" class="form-control  @error('discount_price') is-invalid @enderror"  placeholder="Adress"  name="address" value="{{$customers->address}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Date Of Birth</label>
                                            <input type="date" class="form-control  @error('discount_price') is-invalid @enderror"  placeholder=""  name="data_of_birth" value="{{$customers->date_of_birth}}">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            

                            <div class="d-flex justify-content-between w-100">
                                    <button type="submit" id="submit" class="btn" style="color: white; background: green;">Uppdatering</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
             Input Validation end 

        </div>
    </div>
</div>
@endsection
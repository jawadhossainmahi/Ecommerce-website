@extends('frontend.master')




@section('content')

@php
    $businessCust  = auth()->user()->customer_type == 1 ? true : false;
@endphp


    <!-- ---------------profile------------->

    <section class="profile mb-0">
        <div class="">
            <div class="row px-2 w-100 m-0">
                <div class="max-w-screen-xl mx-auto px-[16px] py-[12px]">
                    <h1 class="profile-heading h1 text-left" >Profil</h1>
                </div>    
            </div>
        </div>
    </section>

    <section class="profile mt-0">
                <div class="">
                    <div class="row px-2 w-100 m-0">
        
                        <div class="max-w-screen-xl mx-auto px-[16px] py-[12px]">
        
                            <p class="form-heading">Kontakt och aviseringar</p>
                            <div class="email-box">
        
                                <form>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">E-postadress</label>
                                        <input disabled type="email" class="form-control" id="exampleInputEmail1" value ="{{ auth()->user()->email }}" placeholder="Email">
                                    </div>
                                    <div class="save-changes">
                                       
                                    </div>
                                </form>
        
                            </div>
        
        
                            <!--<p class="form-heading">Användardata</p>-->
                            <!--<div class="email-box">-->
        
                            <!--    <form>-->
                            <!--        <div class="dob-form">-->
                            <!--            <div class="mb-3">-->
                            <!--                <label for="exampleInputEmail1" class="form-label">År:</label>-->
                            <!--                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="YYYY">-->
                            <!--            </div>-->
            
                            <!--            <div class="mb-3">-->
                            <!--                <label for="exampleInputEmail1" class="form-label">Månad:</label>-->
                            <!--                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="MM">-->
                            <!--            </div>-->
            
                            <!--            <div class="mb-3">-->
                            <!--                <label for="exampleInputEmail1" class="form-label">Dag:</label>-->
                            <!--                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="DD">-->
                            <!--            </div>-->
                            <!--        </div>-->
        
                            <!--        <div class="save-changes">-->
                            <!--            <a href="#" class="profile-btn btn">Skicka in</a>-->
                            <!--        </div>-->
                            <!--    </form>-->
        
                            <!--</div>-->
        
        
                            
                            <div class="email-box mt-[50px]">
                                <form  method="POST" action="{{ route('password.email') }}">
                                    @if (session('status'))
                                        <div class="status alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    
                                    <p class="form-heading">Ändra lösenord</p>
                                    @csrf
                                    
                                        
                                    <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}"  autocomplete="email" autofocus>
                                    
                                    <div class="save-changes">
                                        <button type="submit" class="profile-btn btn">Ändra</button>
                                    </div>
                                </form>
                            </div>
        


                            
                                <div class="address-part">
                                    <h3>Min Adress</h3>
                                        <div class="row">
                                        @if($delivery_addresses->count())
                                        @foreach($delivery_addresses as $delivery_address)
                                        
                                        <div class="col-lg-3 ">
                            
                                            <div class="add-address">
                                                <h4>{{ $delivery_address->fname}} {{$delivery_address->lname }}</h4>
                                                
                                                 <h5>{{ $delivery_address->street_address }}</h5>
                                                  <h5>{{ $delivery_address->zip_code}} {{$delivery_address->postal_address }}</h5>
                                                <span class="form-open">
                                                    <i class="bi bi-plus-circle-fill" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-{{ $delivery_address->id }}" aria-controls="offcanvasRightChange"></i>
                                                    <p>Förändra</p>
                                                </span>  
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                        <div class="col-lg-3 ">
                            
                                            <div class="add-address">
                                                <p>Lägg till adress</p>
                            
                                                <span class="form-open">
                                                    <i class="bi bi-plus-circle-fill" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></i>
                                                    <p>Lägg till</p>
                                                </span>  
                                        </div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@if($delivery_addresses->count())
@foreach($delivery_addresses as $delivery_address)
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-{{ $delivery_address->id }}" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-body p-0">
    <section class="address-box">
        <div class="address-box-head">
            <h1>Redigera adress</h1>                           
                <h5 data-bs-dismiss="offcanvas" aria-label="Close">Avbryt</h5>
        </div>

        <div class="row">
            <form method="POST" action="{{ route('edit_address') }}">
            @csrf
            <div class="side-form col-lg-11 mx-auto px-4">

                <p>Leveransadress</p>


                <div class="row g-3">
                    <div class="col-{{ $businessCust ? 12: 6}}">
                        <input type="hidden" name="id" value="{{ $delivery_address->id }}">
                        <input type="text" name="fname" placeholder="{{ $businessCust ? 'Företags namn*' : 'Förnamn*' }}" value="{{ $delivery_address->fname??auth()->user()->name }}" aria-label="{{ $businessCust ? 'Företags namn' : 'Förnamn' }}">
                    </div>
                    @if(!$businessCust)
                    <div class="col-6">
                        <input type="text" name="lname" placeholder="Efternamn*" value="{{ $delivery_address->lname }}" aria-label="Last name">
                    </div>
                    @endif
                </div>

                <input type="text" name="street_address" value="{{ $delivery_address->street_address }}" placeholder="Gatuadress*">

                <div class="row">
                    <div class="col-12">
                        <input type="text" name="zip_code" placeholder="Postnummer" value="{{ $delivery_address->postal_code }}" aria-label="Zip code">
                    </div>
                    <!--<div class="col-6">-->
                    <!--    <input type="text" name="postal_address" placeholder="Postort*" aria-label="Postort*">-->
                    <!--</div>-->
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <input type="text" name="mobile_number" placeholder="Mobilnummer*" value="{{ $delivery_address->phone }}" aria-label="Mobile number">
                    </div>
                    <!--<div class="col-6">-->
                    <!--    <input type="number" name="home_phone" placeholder="Hemtelefon*" aria-label="Hemtelefon">-->
                    <!--</div>-->
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <input type="text" name="city" value="{{ $delivery_address->city }}" placeholder="Ort*" aria-label="Locality">
                    </div>
                </div>

                <button class="add-btn" >Lägg till</button>
                
            </div>
            
            </form>
        </div>
    </section>
  </div>
</div>
@endforeach
@endif



    
    
@include('frontend.layouts.new-address')
    
@endsection
@section('js')

    
@endsection

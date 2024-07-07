@extends('frontend.master')
@section('content')

  <div class="hidden w-full p-3 lg:block">
    <div class="max-w-screen-2xl mx-auto">
      <div class="bg-green-50 w-full p-2 rounded-2xl">
        <div class="flex justify-evenly">
          <div class="flex items-center space-x-2 w-72">
            <img src="{{ asset('frontend/images/icon1.png') }}" alt="price" class="bg-white-800 bg-opacity-50  w-20 h-w-20" >
            <div class="w-full">
              <h1 class="text-xl font-bold whitespace-nowrap">Nu lägre priser</h1>
              <p class="text-justify">Vi har sänkt detta pris på många favoritartiklar</p>
            </div>
          </div>
          
          <div class="flex items-center space-x-2 w-72">
            <img src="{{ asset('frontend/images/icon2.png') }}" alt="truck"  class="bg-white-800 bg-opacity-50  w-20 h-w-20" >
            <div class="w-full">
              <h1 class="text-xl font-bold whitespace-nowrap">Gratis leveranser</h1>
              <p class="text-justify">Gäller nu även samma dag vid köp över 750 kr</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-full p-2 lg:hidden">
    <div class="max-w-screen-2xl mx-auto">
      <div class="bg-green-50 w-full p-4 rounded-2xl">
          <h1 class="text-2xl mb-2">Goda nyheter <i class="fa-solid fa-star text-base"></i></h1>
          <ul class="list-disc ml-6">
              <li>Vi har sänkt priset på massor av favoritartiklar</li>
              <li>Vi har plockat upp tusentals nya föremål att upptäcka</li>
              <li>Fria leveranser även samma dag vid köp över 650 kr</li>
          </ul>
      </div>
    </div>
  </div>

  <div class="w-full p-2">
    <div class="max-w-screen-2xl mx-auto">

      <div class="slider">
      <div
  id="carouselExampleCaptions"
  class="relative "
  data-te-carousel-init
  data-te-carousel-slide>
  <div
    class="absolute right-0 bottom-0 left-0 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0"
    data-te-carousel-indicators>
    <button
      type="button"
      data-te-target="#carouselExampleCaptions"
      data-te-slide-to="0"
      data-te-carousel-active
      class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
      aria-current="true"
      aria-label="Slide 1"></button>
    <button
      type="button"
      data-te-target="#carouselExampleCaptions"
      data-te-slide-to="1"
      class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
      aria-label="Slide 2"></button>
    <button
      type="button"
      data-te-target="#carouselExampleCaptions"
      data-te-slide-to="2"
      class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
      aria-label="Slide 3"></button>
  </div>
  <div
    class="relative rounded-[20px] w-full max-h-[25rem] overflow-hidden after:clear-both after:block after:content-['']">
    <div
      class="relative float-left -mr-[100%] w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
      data-te-carousel-active
      data-te-carousel-item
      style="backface-visibility: hidden;">
      <img src="{{ asset('frontend/images/1.png') }}" class="block w-full" alt="..." />
    </div>
    <div
      class="relative rounded-[20px] float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
      data-te-carousel-item
      style="backface-visibility: hidden">
      <img src="{{ asset('frontend/images/2.png') }}" class="block w-full" alt="..." />
    </div>
    <div
      class="relative rounded-[20px] float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
      data-te-carousel-item
      style="backface-visibility: hidden">
      <img src="{{ asset('frontend/images/3.png') }}" class="block w-full" alt="..."/>
    </div>
  </div>
  <button
    class="absolute top-0 bottom-0 left-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
    type="button"
    data-te-target="#carouselExampleCaptions"
    data-te-slide="prev">
    <span class="inline-block h-8 w-8">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
      </svg>
    </span>
    <span
      class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
      >Previous</span
    >
  </button>
  <button
    class="absolute top-0 bottom-0 right-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
    type="button"
    data-te-target="#carouselExampleCaptions"
    data-te-slide="next">
    <span class="inline-block h-8 w-8">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="h-6 w-6">
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M8.25 4.5l7.5 7.5-7.5 7.5" />
      </svg>
    </span>
    <span
      class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
      >Next</span
    >
  </button>
</div>


      </div>
    </div>
  </div>

  
  


  

  <div class="card-slider col-lg-11 mx-auto">
        <div class="container">
            <div class="row p-3">
                <div class="col-lg-12 mx-auto navigation" style="justify-content: space-between; align-items: center;">
                    <div class="slider-heading">
                        <h1 class="Veckans">Veckans extrapriser</h1>
                    </div>

                    <div class="slider-btn">
                        <h3><a href="{{ route('extrapriser') }}">Visa alla</a></h3>

                        <div class="custom-btn">

                            
                        </div>
                    </div>
                </div>
            </div>


            <div class=" card-slides owl-carousel owl-theme ">
                @foreach ($product_weekly as $item)
                <div class="item">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card h-100" id="{{$item->id}}">
                            @csrf
                            <div class="t-icon relative">
                                <div class="discount absolute right-10 {{$item->discount_price <= 0 ? 'hidden' : '' }}" >
                                    <i class="fa fa-certificate"></i>
                                    <h5>{{$item->discount_price}}:-</h5>
                                </div>
                                <!--<div class="favourite">-->
                                <!--    @if(auth()->user())-->
                                <!--        @if(auth()->user()->is_favourite($item->id))-->
                                <!--            <i id="likebtn" class="bi bi-heart-fill likebtn" style="color: red;"></i>-->
                                            
                                <!--        @else-->
                                        
                                <!--            <i id="likebtn" class="bi bi-heart-fill likebtn"></i>-->
                                <!--        @endif-->
                                <!--    @else-->
                                    
                                <!--    <i id="likebtn" class="bi bi-heart-fill likebtn"></i>-->
                                <!--    @endif-->
                                    
                                    
                                <!--</div>-->
                            </div>
                            <div class="card-image" data-bs-toggle="modal" data-bs-target="#extra-{{$item->id}}">
                                <img card-image src="{{ asset($item->image ? $item->image->path : 'frontend/images/no-item.png') }}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center" data-bs-toggle="modal" data-bs-target="#extra-{{$item->id}}">{{$item->name}}</h5>
                                <h4 class="tag mx-auto">{{$item->weight}} </h4>
                                <div class="price">
                                    <span>
                                        @if($item->getcategory)
                                        <h4>  
                                        <b><a href="{{ route('pro_cat', ['category'=>$item->getcategory->id]) }}">{{ $item->getcategory->name}}</a> </b></h4>
                                        @endif
                                        <h4 class="text-[10px]">JFR-Pris:{{$item->price_per_item}}</h4>
                                    </span>
                                    <span  class="text-right">
                                        <h5 class="discount-price {{$item->discount_price <= 0 ? 'hidden' : '' }}">{{$item->discount_price > 0 ? $item->discount_price : '' }}:-</h5>
                                        <h5 class="{{$item->discount_price <= 0 ? '' : 'real-price' }}">{!! $item->discount_price <= 0 ? $item->price : '<s>'.$item->price.'</s>' !!}:-</h5>
                                    </span>
                                </div>
                                <div class="card-counter d-flex">
                                    <a><i class="bi bi-dash-circle-fill minus"></i></a>
                                    <input type="number" class="st" value="0" size="2">
                                    <a><i class="bi bi-plus-circle-fill plus"></i></a>
                                    <button class="first-btn">
                                        Köp
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @endforeach

        
            </div>
        </div>
    </div>

    

  

  <section class="livshem-cards col-lg-11 mx-auto">
        <div class="home-cards">
            
            <div class="container">
                <h1 style="font-size: 28px; line-height: 36.4px;">Varor som passar mig</h1>
                <div class="row">
                     @foreach ($product_popular as $item)
                     
                    <div class="card-box col-xxl-2 col-xl-3  col-md-4 col-sm-6 col-xs-6 px-1 py-3 col-6">
                        <div class="card h-100" id="{{$item->id}}">
                            @csrf
                            <div class="t-icon relative">
                                <div class="discount absolute right-10 {{$item->discount_price <= 0 ? 'hidden' : '' }}" >
                                    <i class="fa fa-certificate"></i>
                                    <h5>{{$item->discount_price}}:-</h5>
                                </div>
                                <!--<div class="favourite">-->
                                <!--      @if(auth()->user())-->
                                <!--        @if(auth()->user()->is_favourite($item->id))-->
                                <!--            <i id="likebtn" class="bi bi-heart-fill likebtn" style="color: red;"></i>-->
                                            
                                <!--        @else-->
                                        
                                <!--            <i id="likebtn" class="bi bi-heart-fill likebtn"></i>-->
                                <!--        @endif-->
                                <!--    @else-->
                                    
                                <!--    <i id="likebtn" class="bi bi-heart-fill likebtn"></i>-->
                                <!--    @endif-->
                                <!--</div>-->
                            </div>
                            <div class="card-image" data-bs-toggle="modal" data-bs-target="#data-{{$item->id}}">
                                <img card-image src="{{ asset($item->image ? $item->image->path : 'frontend/images/no-item.png') }}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center" data-bs-toggle="modal" data-bs-target="#data-{{$item->id}}">{{$item->name}}</h5>
                                <h4 class="tag mx-auto">{{$item->weight}} </h4>
                                <div class="price">
                                    <span>
                                        @if($item->getcategory)
                                        <h4>  
                                        <b><a href="{{ route('pro_cat', ['category'=>$item->getcategory->id]) }}">{{ $item->getcategory->name}}</a> </b></h4>
                                        @endif
                                        <h4 class="text-[10px]">JFR-Pris:{{$item->price_per_item}}</h4>
                                    </span>
                                    <span  class="text-right">
                                        <h5 class="discount-price {{$item->discount_price <= 0 ? 'hidden' : '' }}">{{$item->discount_price > 0 ? $item->discount_price : '' }}:-</h5>
                                        <h5 class="{{$item->discount_price <= 0 ? '' : 'real-price' }}">{!! $item->discount_price <= 0 ? $item->price : '<s>'.$item->price.'</s>' !!}:-</h5>
                                    </span>
                                </div>
                                <div class="card-counter d-flex">
                                    <a><i class="bi bi-dash-circle-fill minus"></i></a>
                                    <input type="number" class="st" value="0" size="2">
                                    <a><i class="bi bi-plus-circle-fill plus"></i></a>
                                    <button class="first-btn">
                                        Köp
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                        
                </div>
            </div>
        </div>
    </section>
    <a class="LoadMore" id="loadMore">Ladda mer</a>
  
  

  
    <!-------------------card-pop-up---------------->
@foreach ($product_weekly as $item)
<div class="preview-modal modal fade" id="extra-{{$item->id}}" tabindex="-1" aria-labelledby="{{$item->name}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <i class="bi bi-x" data-bs-dismiss="modal" aria-label="Close"></i>
        </div>
        <div class="modal-body">
            <div class="preview relative">
                <div class="container">
                    <div class="row" id="{{$item->id}}">
                        @csrf
                        <div class="col-lg-12 mx-auto mb-20">
                            <img src="{{ asset($item->image ? $item->image->path : 'frontend/images/no-item.png') }}" alt="{{$item->name}}">
    
                            <!--<div class="like"> -->
                            <!--         @if(auth()->user())-->
                            <!--            @if(auth()->user()->is_favourite($item->id))-->
                            <!--                <i id="likebtn" class="bi bi-heart-fill likebtn" style="color: red;"></i>-->
                                            
                            <!--            @else-->
                                        
                            <!--                <i id="likebtn" class="bi bi-heart-fill likebtn"></i>-->
                            <!--            @endif-->
                            <!--        @else-->
                                    
                            <!--        <i id="likebtn" class="bi bi-heart-fill likebtn"></i>-->
                            <!--        @endif-->
                            <!--</div>-->
    
                            <div class="links">
                                <i class="bi bi-house-door-fill"></i>
                                @if($item->getcategory)
                                <h4><a href="{{ route('pro_cat', ['category'=>$item->getcategory->id]) }}"> {{ $item->getcategory->name }}</a> / </h4>
                                @endif
                                @if($item->getsubcategory)
                                <h4><a href="{{ route('frontend.sub_cat', ['sub_category'=>$item->getsubcategory[0]->id]) }}"> {{ $item->getsubcategory[0]->name }}</a> / </h4>
                                @endif
                                @if($item->getsubsubcategory)
                                <h4><a href="{{ route('frontend.subsub_cat', ['sub_sub_category'=>$item->getsubsubcategory[0]->id]) }}"> {{ $item->getsubsubcategory[0]->name }}</a> / </h4>
                                @endif
                                <h4> {{ $item->name }}</h4>
                                
                            </div>
    
                            <div class="product">
                                <div class="product-1">
                                    <h1>{{ $item->name }}</h1>
                                    <p>{{ $item->weight }}</p>
                                </div>
    
                                    @if($item->getcategory)
                                <!--<div class="product-button">-->
                                <!--    <a href="#" class="product-btn">{{ $item->getcategory->name }}</a>-->
                                <!--</div>-->
                                    @endif
                            </div>
    
    
                            <div class="accordion accordion-flush" id="accordionFlushExample" style="width: 100%;">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                            Produktinformation111111
                                        </button>
                                    </h2>
                                    <div style="visibility: visible;" id="flush-collapseOne"
                                        class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">{!! $item->product_information !!}</div>
                                    </div>
                                </div>
                            </div>
    
                            @if($item->origin)
                            <div class="product-country">
                                <i class="bi bi-globe"></i>
    
                                <div class="country-info">
                                    <p>Ursprung</p>
                                    <h3>{{ $item->origin }}</h3>
                                </div>
                            </div>
                             @endif
                            <div class="product-discription">
                                
                                <h3> <strong> Näringsinnehåll</strong></h3>
                                <br>
                                <p>{!! $item->nutritional_content !!}</p>
                                <br>
                                <h3> <strong>Lagring</strong></h3>
                                <br>
                                <p>{{ $item->storage }}</p>
                                <br>
                                <h3> <strong>Övrig information</strong></h3>
                                <br>
                                <p>{!! $item->other_information !!}</p>
                                <br>
                      
                            </div>
    
                        </div>
                    </div>
                    
                    <div class="buy-now sticky w-100" id="{{ $item->id}}">
                                <div class="buy-content">
                                    <span>
                                        <h4 class="discount-price ">{{$item->discount_price > 0 ? $item->discount_price : $item->price }}:-</h4>
                                        <p> <span class="line-through  {{$item->discount_price <= 0 ? 'hidden' : '' }}"> {!! $item->discount_price <= 0 ? $item->price : '<s>'.$item->price.'</s>' !!}</span> <span>Jmf pris {{$item->compare_price}}:-</span></p>
                                    </span>
    
                                    <div class="card-counter d-flex">
                                        <a><i class="bi bi-dash-circle-fill minus"></i></a>
                                        <input type="number" class="st" value="0" size="2">
                                        <a><i class="bi bi-plus-circle-fill plus"></i></a>
    
                                        <button class="first-btn">
                                            Köp
                                        </button>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        
      </div>
    </div>
</div>
 @endforeach
  @foreach ($product_popular as $item)
<div class="preview-modal modal fade" id="data-{{$item->id}}" tabindex="-1" aria-labelledby="{{$item->name}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <i class="bi bi-x" data-bs-dismiss="modal" aria-label="Close"></i>
        </div>
        <div class="modal-body">
            <div class="preview relative">
                <div class="container">
                    <div class="row" id="{{$item->id}}">
                        @csrf
                        <div class="col-lg-12 mx-auto mb-20">
                            <img src="{{ asset($item->image ? $item->image->path : 'frontend/images/no-item.png') }}" alt="{{$item->name}}">
    
                            <!--<div class="like"> -->
                            <!--         @if(auth()->user())-->
                            <!--            @if(auth()->user()->is_favourite($item->id))-->
                            <!--                <i id="likebtn" class="bi bi-heart-fill likebtn" style="color: red;"></i>-->
                                            
                            <!--            @else-->
                                        
                            <!--                <i id="likebtn" class="bi bi-heart-fill likebtn"></i>-->
                            <!--            @endif-->
                            <!--        @else-->
                                    
                            <!--        <i id="likebtn" class="bi bi-heart-fill likebtn"></i>-->
                            <!--        @endif-->
                            <!--</div>-->
    
                            <div class="links">
                                <i class="bi bi-house-door-fill"></i>
                                @if($item->getcategory)
                                <h4><a href="{{ route('pro_cat', ['category'=>$item->getcategory->id]) }}"> {{ $item->getcategory->name }}</a> / </h4>
                                @endif
                                @if($item->getsubcategory)
                                <h4><a href="{{ route('frontend.sub_cat', ['sub_category'=>$item->getsubcategory[0]->id]) }}"> {{ $item->getsubcategory[0]->name }}</a> / </h4>
                                @endif
                                @if($item->getsubsubcategory)
                                <h4><a href="{{ route('frontend.subsub_cat', ['sub_sub_category'=>$item->getsubsubcategory[0]->id]) }}"> {{ $item->getsubsubcategory[0]->name }}</a> / </h4>
                                @endif
                                <h4> {{ $item->name }}</h4>
                                
                            </div>
    
                            <div class="product">
                                <div class="product-1">
                                    <h1>{{ $item->name }}</h1>
                                    <p>{{ $item->weight }}</p>
                                </div>
    
                                    @if($item->getcategory)
                                <!--<div class="product-button">-->
                                <!--    <a href="#" class="product-btn">{{ $item->getcategory->name }}</a>-->
                                <!--</div>-->
                                    @endif
                            </div>
    
    
                            <div class="accordion accordion-flush" id="accordionFlushExample" style="width: 100%;">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                            Produktinformation222222
                                        </button>
                                    </h2>
                                    <div style="visibility: visible;" id="flush-collapseOne"
                                        class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">{!! $item->product_information !!}</div>
                                    </div>
                                </div>
                            </div>
    
                            @if($item->origin)
                            <div class="product-country">
                                <i class="bi bi-globe"></i>
    
                                <div class="country-info">
                                    <p>Ursprung</p>
                                    <h3>{{ $item->origin }}</h3>
                                </div>
                            </div>
                             @endif
                            <div class="product-discription">
                                
                                <h3> <strong>Näringsinnehåll</strong></h3>
                                <br>
                                <p>{!! $item->nutritional_content !!}</p>
                                <br>
                                <h3> <strong>Lagring</strong></h3>
                                <br>
                                <p>{{ $item->storage }}</p>
                                <br>
                                <h3> <strong>Övrig information</strong></h3>
                                <br>
                                <p>{!! $item->other_information !!}</p>
                                <br>
                      
                            </div>
    
                        </div>
                    </div>
                    
                    <div class="buy-now sticky w-100" id="{{ $item->id}}">
                                <div class="buy-content">
                                    <span>
                                        <h4 class="discount-price ">{{$item->discount_price > 0 ? $item->discount_price : $item->price }}:-</h4>
                                        <p> <span class="line-through  {{$item->discount_price <= 0 ? 'hidden' : '' }}"> {!! $item->discount_price <= 0 ? $item->price : '<s>'.$item->price.'</s>' !!}</span> <span>Jmf pris {{$item->compare_price}}:-</span></p>
                                    </span>
    
                                    <div class="card-counter d-flex">
                                        <a><i class="bi bi-dash-circle-fill minus"></i></a>
                                        <input type="number" class="st" value="0" size="2">
                                        <a><i class="bi bi-plus-circle-fill plus"></i></a>
    
                                        <button class="first-btn">
                                            Köp
                                        </button>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        
      </div>
    </div>
</div>
 @endforeach
    
       
  <script>
    function clickToOpen( id ,type){
      $.ajax({
              type: "get",
              url: "{{ route('product.display') }}",
              data: {
                id:id,
                type:type,

              },
              success: function (data) {
                document.getElementById('product_bg').classList.remove('hidden');
                document.getElementById('openProduct').classList.remove('hidden');
                const fixedOffPrice = document.getElementById('fixed_off_price');
                const off_price_bg = document.getElementById('off_price_bg');
                const fixedProductImage = document.getElementById('fixedProductImage');
                const fixedname = document.getElementById("fixed_name");
                const fixedWeight = document.getElementById("fixed_weight");
                const fixedOffPricein = document.getElementById("fixed_off_price_in");
                const fixedPrice = document.getElementById("fixed_price");
                const fixedAdress = document.getElementById("fixed_address");
                const fixedPerProduct = document.getElementById("fixed_max");
                const fixedComparePrice = document.getElementById("fixed_price_compare");
                const fixedoffbtnPrice = document.getElementById("fixed_off_price_btn");
                const fixedbtnPrice = document.getElementById("fixed_price_btn");
                const DisplayCart = document.getElementById("displaycart");
                const next_product = document.getElementById("next_product");
                const pre_product = document.getElementById("pre_product");

                fixedOffPrice.innerHTML=data.product.discount_price;
                fixedProductImage.src=data.product.image ? data.product.image.path : 'frontend/images/no-item.png';
                fixedname.innerText=data.product.name;
                fixedWeight.innerText=data.product.weight;
                fixedOffPricein.innerHTML=data.product.discount_price  ;
                fixedPrice.innerHTML=data.product.price <= 0 ? data.discount_price : '<s>'+data.product.price+':-</s>';
                fixedAdress.innerHTML=data.product.origin;
                fixedPerProduct.innerHTML=data.product.price_per_item;
                fixedComparePrice.innerHTML=data.product.compare_price;
                fixedoffbtnPrice.innerHTML=data.product.discount_price ;
                fixedbtnPrice.innerHTML=data.product.price <= 0 ? data.discount_price : '<s>'+data.product.price+':-</s>';
                if (data.product.discount_price == 0 || data.product.discount_price == null){
                off_price_bg.classList.add('hidden');
                fixedOffPrice.classList.add('hidden');
                fixedOffPricein.classList.add('hidden');
                fixedoffbtnPrice.classList.add('hidden');
                }else{
                off_price_bg.classList.remove('hidden');
                fixedOffPrice.classList.remove('hidden');
                fixedOffPricein.classList.remove('hidden');
                fixedoffbtnPrice.classList.remove('hidden');
                }
                if (data.next == null) {
                next_product.classList.add('invisible');
                } else {
                next_product.classList.remove('invisible');

                }
                if (data.pre == null) {
                pre_product.classList.add('invisible');
                } else {
                pre_product.classList.remove('invisible');

                }

                let result = DisplayCart.href.replace(":id", data.product.id);
                DisplayCart.href = result;
                next_product.setAttribute("onclick", "clickToOpen("+data.next+",'"+data.product.items_status+"')");
                pre_product.setAttribute("onclick", "clickToOpen("+data.pre+",'"+data.product.items_status+"')");
// console.log(data);
      },
      error: function (data) {
          console.log(data);
      }
  });
    }
  </script>
  <script>
    function Product_ajax() {
      // $.ajaxSetup({
      //         headers: {
      //             'X-CSRF-TOKEN': "{{ csrf_token() }}"
      //         }
      //     });
      var product_popular = document.getElementById('product_popular').value ;
          $.ajax({
              type: "get",
              url: "{{ route('index') }}",
              data: {
                data:product_popular
              },
              success: function (data) {
               document.getElementById('content_section').innerHTML =data;
              },
              error: function (data) {
                  console.log(data);
              }
          });
      
    }
  </script>
@endsection
@section('js')

    
@endsection

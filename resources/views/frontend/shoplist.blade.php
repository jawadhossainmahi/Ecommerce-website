@extends('frontend.master')

@section('content')

 <!-- ----------------shopping-list------------->

    <section class="shopping">

    
        <div class="extrapriser overflow-hidden p-3" id="cart" >
            
            <section class="livshem-cards max-w-screen-xl mx-auto px-[16px] py-[12px]">
              <div class="home-cards px-2">
                  
                  <div class="">
                      <h1 style="font-size: 28px; line-height: 36.4px;" class="text-left px-0">Inköpslista: {{ $shopping_list->name }} </h1>
                      <div data-shopping-id="{{ $shopping_list->id }}" id="shopping-all" class="row"></div>
                  </div>
                </div>
                
                <center>
                    <button data-shopping-id="{{ $shopping_list->id }}" class="btn btn-success btn-lg my-5"  id="all_cart">         
                        Lägg alla varor i varukorgen
                    </button>
                </center>
              </div>
                
          </section>
        </div>
        
        @endsection
        @section('js')
        
       
        
      
        
   @endsection

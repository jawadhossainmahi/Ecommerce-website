@extends('frontend.master')
@section('content')
<div class="max-w-7xl mx-auto p-4">
    <div class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex flex-wrap items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="{{ env("BASE_URL") }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
              <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
              Hem
            </a>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Sök</span>
            </div>
          </li>
        </ol>
      </div>
   
</div>
<div class="fixed-product-bg bg-black fixed h-[100vh] top-0 left-0 right-0 opacity-70 z-40 hidden" id="product_bg">
</div>
    <div class="fixed-product fixed h-[100vh] top-0 left-0 right-0 z-50 hidden" id="openProduct" >
      <div class="w-full h-full flex justify-between items-center z-20 md:px-10">
        <div class="hidden w-16 h-16 md:flex justify-center items-center bg-white text-gray-400 hover:text-black rounded-full" id="pre_product"  onclick="preProduct('pre_product')">
          <a class="p-2" >
            <i class="fa-solid fa-arrow-left text-4xl"></i>
          </a>
        </div>
        <div class="product w-full h-[100vh] md:w-[70%] md:h-[85%] md:min-h-[700px] md:max-w-[50rem] bg-white md:rounded-lg overflow-y-scroll" id="scroll" onscroll="scrollFunction()">
          <div class="pb-16">
            <div class=" p-4 flex justify-between items-center w-full sticky top-0 py-1 bg-white " id="model-top">
              <div class=" "> 
                <div class="flex text-center justify-center items-center bg-red-500 rounded-full w-[45px] h-[45px] text-white font-semibold" id="fixed_off_price"></div>
              </div>
              <div id="demo">
              </div>
              <div class="w-6 h-6 rounded-full flex justify-center items-center text-gray-400 hover:text-black transform hover:scale-150 transition duration-500 ease-in-out" onclick="clickToClose('openProduct','product-bg')" >
                <i class="fa-solid fa-xmark mx-[6px] text-lg active:font-bold"></i>
              </div>
            </div>
            <div class="p-4">
              <div class="w-full flex justify-center" >
                  <img src="" alt="" class="w-[50%]" id="fixedProductImage">
                  
              </div>
              <div class="w-full flex justify-between items-center ">
                  <div class="text-base font-semibold text-gray-500" id="fixed_field"></div>
                  <div><img src="{{ asset('frontend/images/msc.png') }}" alt="msc" width="40px" id="fixed_field_img"></div>
              </div>
              <div>
                  <div class="whitespace-nowrap text-xl font-semibold" id="fixed_name"></div>
              </div>
              <div class="w-full flex justify-between items-center mb-10">
                  <div class="text-base font-semibold text-gray-500" id="fixed_weight">600 g</div>
                  <div class="text-base font-semibold text-gray-500" id="fixed_address">Nordostatlanten</div>
              </div>
              <div class="flex justify-between items-center my-4">
                <div class="flex flex-col items-start">
                  <div class="text-xl font-bold text-red-600" id="fixed_off_price_in"></div>
                  <div class="font-bold text-base"><s class="" id="fixed_price">145:-</s> </div>
                </div>
                <div class="flex flex-col items-end">
                  <div class="text-sm font-bold text-gray-500" id="fixed_price_perKG">165:-/kg</div>
                  <div class="text-sm font-semibold text-gray-500" id="fixed_max">Max 2 / kop</div>
                </div>
              </div>
              <p id="fixed_description">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia, fuga velit nam distinctio quas ipsam praesentium quibusdam fugiat libero enim quidem sunt porro qui consequatur veritatis beatae tempora nostrum possimus et fugit? Libero nulla facere fugiat sequi nisi omnis autem soluta nemo, porro iure similique impedit quis quod labore quo nobis in ratione atque? Blanditiis minima consequatur error numquam voluptatum impedit consectetur, esse vitae reprehenderit ipsa odit nisi ratione itaque alias. Commodi officia enim, ad id rerum, alias illum sed cumque quibusdam, hic dolores ipsam qui libero non numquam necessitatibus voluptatem deserunt veniam? Corrupti porro quo dolorum error, dolor ex.
              </p>
              <div class="flex w-full mb-3 z-20">
                <div class="fixed bottom-20 left-0 right-0 flex justify-center items-center">
                  <div class="border-2 border-gray-500 bg-white w-[85%] max-w-[30rem] rounded-full px-2 py-2 pl-8 shadow4">
                    <div class="flex justify-between items-center">
                      <div class="flex flex-col items-start">
                        <div class="text-base md:text-xl font-bold text-red-600" id="fixed_off_price_btn"></div>
                        <div class="font-bold text-sm md:text-base flex items-center"><span id="fixed_price_btn"></span><span class="text-[10px] sm:text-xs ml-2 text-gray-500 whitespace-nowrap">Compare price <span id="fixed_price_compare"></span></span> </div>
                      </div>
                      <div>
                        <a class="text-white text-lg bg-green-600 hover:bg-green-700 px-4 sm:px-12 py-2 rounded-full">Buy</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="hidden w-16 h-16 md:flex justify-center items-center bg-white text-gray-400 hover:text-black rounded-full" id="next_product" onclick="nextProduct('next_product')">
          <a class="p-2"  onclick="">
            <i class="fa-solid fa-arrow-right text-4xl"></i>
          </a>
        </div>
      </div>
</div>
 
 <div class="max-w-7xl mx-auto mb-12">
       <div class="flex justify-between items-center flex-wrap px-4 pb-6">
         <h1 class="text-4xl font-extrabold">Sök efter {{ $search }}
        </h1>
         <p class="hidden h-[40px] px-[25px] pb-[1px] border-2 font-bold border-green-600 hover:bg-green-600 rounded-md whitespace-nowrap flex justify-center items-center cursor-pointer ml-auto"><i class="fa-solid fa-arrow-up-wide-short mr-4"></i>Filtrera</p>
       </div>

       <div class="all-products w-full flex flex-row sm:space-x-4 px-2 justify-center">
           <div id="search" class="row px-2 w-100">
                     
                        
                </div>
       </div>
       <div class="col-12 col-lg-9 mx-auto">
  
        
              {{-- <div style="text-align:center"> --}}
                <a class="btn btn-success my-4 LoadMore hidden search" id="search" data-id="{{ $search }}"  >Ladda mer</a>
                {{-- </div > --}}
            
        </div>
           @if($search)
            <input type="hidden" id="page-id" value="{{ $search }}"  >
            @endif
       <div id="search-modal"></div>
  
 </div>
    
@endsection
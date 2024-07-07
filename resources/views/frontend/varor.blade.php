@extends('frontend.master')
@section('content')


    <style>
        .accordion-button:not(.collapsed){
            background-color: #16A34A;
        }
    </style>

    <!-- -------------------catagories-dropdowns----------------- -->

    <div class="catagories-drop-down">
        <div class="row w-100 m-0">
            
            @foreach ($categories as $category)
            <div class="col-lg-10 mx-auto p-0">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="catagory-accordion-item accordion-item">
                      <h2 class="accordion-header" id="flush-heading-{{$category->id}}">
                        <button href="{{route('pro_cat', [ 'category' => $category->id ])}}" style="z-index: 1; background-color:white; border-bottom: 1px solid rgb(205, 205, 205);" class="category-accordian accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{$category->id}}" aria-expanded="false" aria-controls="flush-collapse-{{$category->id}}">
                          <a href="{{route('pro_cat', [ 'category' => $category->id ])}}"><span>{{$category->name}}  ({{$category->getsubcategory->count()}})</span></a>
                        </button>
                      </h2>
                      <div style="visibility: visible;" id="flush-collapse-{{$category->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{$category->id}}" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            @foreach ($category->getsubcategory as $sub_category)
                            
                            <div class="dropdown">
                                <a class=" btn dropdown-toggle" href="{{ route('frontend.sub_cat', ['sub_category'=>$sub_category->id] ) }}" role="button" id="dropdownMenuLink catagories-drop-down"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{$sub_category->name}}  <span>({{$sub_category->getsubsubcategory->count()}})</span>
                                </a>
                                <ul class="dropdown-menu catagories-drop-menu" aria-labelledby="dropdownMenuLink" style="width: 100%;">
                                    @foreach ($sub_category->getsubsubcategory as $subsub_category)
                                    <li><a class="dropdown-item" href="{{ route('frontend.subsub_cat', ['sub_sub_category'=>$subsub_category->id] ) }}">{{$subsub_category->name}} <span></span> </a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
  
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

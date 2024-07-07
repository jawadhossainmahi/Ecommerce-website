@extends('frontend.master')

@section('content')

   <section class="">
    <div class="my-favourite max-w-screen-xl mx-auto px-[16px] py-[12px]">
        <div class="row">
            <div class="favourite">
                <h3>Mina Favoriter</h3>
            </div>
        </div>
    </div>
</section>

    <!-- -----------------cards---------- -->


  <section class="livshem-cards">
        <div class="home-cards  max-w-screen-xl mx-auto px-[16px] py-[12px]">
            
            <div class="">
                <!--<h1 style="font-size: 28px; line-height: 36.4px;">Mina favoritprodukter</h1>-->
                <div id="favourite-cards" class="row px-2">
                    
                        
                </div>
            </div>
        </div>
    </section>
  
  

  
  <div id="favourites-modal"></div>
  
  <a class="btn btn-success my-4 LoadMore hidden" id="favouriteLoadMore" data-id=""  >Ladda mer</a>

@endsection
@section('js')

    
@endsection

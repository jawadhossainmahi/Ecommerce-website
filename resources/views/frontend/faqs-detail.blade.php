@extends('frontend.master')

@section('content')


<style>

    .FAQ-details h1{
        color: #000000;
        font-weight: 700;
        font-size: 35px;
    }

    .FAQ-details p{
        color: #000000;
    }

    .FAQ-Time i{
        color: green;
        margin-right: 10px;
        align-items: center;
        display: flex;
    }

    .FAQ-article{
        display: flex;
    }


</style>



<body>

   

<!-- --------------FAQ-details------------>

<section class="FAQ-details">
    <div class="row max-w-7xl mx-auto px-[16px] py-[12px]">
        <div class="col-lg-7 col-md-12">
            
            <!--<p class="FAQ-catagory py-3">Handla</p>-->

            <!--<div class="FAQ-Time py-3 d-flex">-->
            <!--    <i class="fa fa-clock"></i><p>Sep 13 2022</p>-->
            <!--</div>-->

            <div class="FAQ-Question border-bottom mb-4">
                <h1>Fråga</h1>
                @foreach($data as $item)
                <!--{{$item->created_at->format('M d Y')}}-->
                <p class="my-3">{{$item->question}}</p>
                @endforeach
            </div>


            <div class="FAQ-Answer border-bottom">
                <h1>Svar</h1>
                @foreach($data as $item)
                <p class="my-2">{{$item->answer}}. </p>
                @endforeach
                <!--<p class="my-2">Tack vare våra kylbilar utrustade med frysbox garanterar vi en obruten kylkedja från vårt lager med hjälp av våra miljövänliga diesel- och elbilar hela vägen hem till dig. Dessutom slipper vi använda onödig kolsyreis.</p> -->

                <!--<p class="my-2">Våra bilar rymmer upp till 30 st separata beställningar, vilket innebär att en fullpackad leveransbil motsvarar ca 30 st enskilda resor som våra kunder annars skulle gjort.</p> -->

                <!--<p class="my-2">Vi använder moderna leveransbilar och planerar våra körscheman så miljövänligt som möjligt, med    hjälp av optimerade körturer för att minska utsläpp i största mån. </p>-->
                </p>
            </div>
        </div>

      
        <div class="col-lg-4 mx-auto col-md-12">
            <h1 class="my-2">samma fråga</h1>
            @foreach($faq_categories as $item)
            <div class="tab-pane fade {{ ($loop->index == 0) ? 'show active' : '' }} " id="pills-{{ $item->cat_id }}" role="tabpanel"
                aria-labelledby="pills-{{ $item->cat_id }}-tab" tabindex="0">
                                    
              @foreach($item->faqs as $value)
             @if($value->id != $id)
            <a href="{{ url('/')}}/faqs-details/{{$value->id}}" class="FAQ-article border-bottom my-4">{{$value->question}}</a>
           @endif

              @endforeach
                   </div> 
                   
            @endforeach
            
           
        <!--</div>-->
    </div>
</section>


<!-- -----------------footer------------->

    

    <!--</div>-->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="home-card.js"></script>
    <script>
        src = "https://code.jquery.com/jquery-3.6.3.min.js"
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>


@endsection
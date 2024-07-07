@extends('frontend.master')

@section('content')


<style>
    .FAQ-heading {
        background-color: #b1e1a0;
        width: 100%;
        height: 15rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .FAQ-heading h1 {
        color: #000000;
        font-weight: 700;
        font-size: 60px;
        margin-bottom: 30px;
    }

    .FAQ-heading a {
        color: white;
        background-color: green;
        border-radius: 5px;
        padding: 10px;
        transition: 0.3s all;
    }

    .FAQ-heading a:hover {
        background-color: rgb(0, 106, 0);
    }

    .FAQ-box .nav-pills .nav-link.active,
    .FAQ-box .nav-pills .nav-link {
        border-radius: 5px;
    }

    .FAQ-box .nav-pills{
        justify-content: space-between;
    }

    
    .FAQ-box .tab-pane a{
        display: flex;
        flex-direction: column;
    }

    @media(max-width:768px) {

        .FAQ-heading h1 {
          font-size: 45px;
        }
        .FAQ-box .nav-item{
            width: 100%;
        }
    
        .FAQ-box .nav-pills{
            align-items: center;
            flex-direction: column;
        }

        .FAQ-box .nav-pills .nav-link.active, .FAQ-box .nav-pills .nav-link {
            width: 100%;
            border-radius: 0px;
        }
    }
</style>





    <!-- --------------FAQ------------->


    <section class="FAQ-heading">
        <h1 class="text-left"> Vanliga frågor</h1>
        <a href="{{ env("BASE_URL") }}">tillbaka till butiken</a>
    </section>


    <section class="FAQ-box max-w-screen-xl mx-auto px-[16px] py-[12px]">

        <ul class="nav nav-pills my-5 border-bottom" id="pills-tab-faq" role="tablist">
            @foreach($faq_categories as $item)
            
            <li class="nav-item " role="presentation">
             
                <button class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" id="pills-{{ $item->cat_id }}-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-{{ $item->cat_id }}" type="button" role="tab" aria-controls="pills-{{ $item->cat_id }}"
                    aria-selected="true" value="{{$item->cat_id}}">{{$item->name_category}} </button>
            </li>
            @endforeach
            
        </ul>
       

        <div class="tab-content border-1" id="pills-tabContent-faq">
            @foreach($faq_categories as $item)
            
            <div class="tab-pane fade {{ ($loop->index == 0) ? 'show active' : '' }} " id="pills-{{ $item->cat_id }}" role="tabpanel"
                aria-labelledby="pills-{{ $item->cat_id }}-tab" tabindex="0">
                
                @foreach($item->faqs as $value)
                    
                    <a href="{{ url('faqs-details',$value->id)}}" class="Question p-2 border-bottom">{{$value->question}}</a>
                
                @endforeach
               </div>
            
            
            @endforeach

            
        </div>

    </section>


  


    

@endsection
@section('js')
    

<script>
    $(document).ready(function(){
        $(".nav-link").on("click",function(){
            // e.prevenDefault();
            var id=$(this).val();
            // console.log(id);
        });
        
    });
</script>


@endsection

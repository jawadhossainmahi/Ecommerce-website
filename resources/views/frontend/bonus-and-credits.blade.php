@extends('frontend.master')


@section('content')
<style>
    .credits-box {
    background-image: url({{ asset('frontend/images/livshem-header.avif') }});
    background-size: cover;
    background-position: center;
    height: 40vh;
    width: 100%;
    margin: auto;
    text-align: center;
    color: white;
    position: relative;
}



.Min-bonus {
    width: 80%;
    background-color: #FFFFFF;
    border: 1px solid rgb(187, 187, 187);
    border-radius: 5px;
    margin: auto;
}
.Min-bonus .head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 25px 20px;
    border-bottom: 1px solid rgb(187, 187, 187);
}
.Min-bonus .head h3 {
    font-weight: 700;
    font-size: 23px;
}
.Min-bonus .head h3 i {
    color: crimson;
    margin-right: 10px;
}
.Min-bonus .head p {
    color: rgb(163, 163, 163);
}
.Min-bonus-body {
    padding: 25px 20px;
}
.Min-bonus-body .Min-bonus-coupon {
    padding: 20px;
    margin: 15px 0;
    border-bottom: 2px solid gray;
    
    display: flex;
    justify-content: space-between;
}
.coupon-box-left {
    text-align: left;
}
.coupon-box-left h3 {
    font-weight: 600;
    font-size: 15px;
    color: rgb(254, 254, 254);
    background-color: rgb(0, 123, 4);
    font-family: sans-serif;
    width: max-content;
    padding: 10px;
    border-radius: 5px;
}
.coupon-box-left p{
    color: black;
    text-transform: capitalize;
    font-size: 17px;
    margin-top: 20px;
    font-family: sans-serif;
}
.coupon-box-right{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: end;
}
.coupon-box-right h3 {
    font-family: sans-serif;
    font-size: 17px;
}
.coupon-box-right h3 span{
    color: green;
    margin-left: 5px;
    font-family: sans-serif;
}
.coupon-box-right p {
    color: rgb(153, 153, 153);
    font-family: sans-serif;
    font-size: 17px;
}

@media(max-width:952px;){
    .Min-bonus {
    width: 100%;
}

.Min-bonus-body {
    padding: 25px 0px;
}


}



-------------------media-query------------------



</style>
    <!-- ----------------bonus-and-credits------------->

    <section class="bonus-and-credits max-w-screen-xl mx-auto px-[16px] py-[12px] pt-0">
        <div class="credits-box">
            <div class="credits-box-content">
                <h1>Mina kuponger</h1>
                <p>Hos Livshem får du en bonus på dina köp som du sedan kan använda på framtida köp. Här kan du se dina kuponger.</p>
            </div>
        </div>

        <div class="bonus-and-credits-cards">
            <div class="Min-bonus mb-5">
              <div class="head">
                <h3> <i class="bi bi-heart"></i> Kuponger</h3>
                
              </div>

              <div class="Min-bonus-body">
                @foreach($coupons as $coupon)
                <div class="Min-bonus-coupon">

                    <div class="coupon-box-left">
                        <h3> @if (in_array($coupon->type, ["Percentage","Flat"]) ) {{ $coupon->amount }}{{ ($coupon->type == 'Percentage') ? '%' : ':-' }} off @else Free Shipping @endif</h3>
                         <h4 class="pt-4">@if($coupon->max_discount)  Max rabatt: {{ $coupon->max_discount }}:-  @endif </h4>
                        
                        <p>{{ $coupon->name }}</p>
                    </div>
                    
                    <div class="coupon-box-right">
                        <h3>Använd kod <span> {{ $coupon->code }}</span></h3>
                        <h4 class="pt-0">Användningsgräns: {{ ($coupon->usage_limit == null) ? 'Unlimited' : $coupon->usage_limit }}</h4>
                        <p>Giltighet: {{ $coupon->start_date }}-{{ $coupon->end_date }}</p>
                    </div>
                   
                </div>
                @endforeach

                
              </div>
            </div>
        </div>


    </section>


 
@endsection
@section('js')

    
@endsection

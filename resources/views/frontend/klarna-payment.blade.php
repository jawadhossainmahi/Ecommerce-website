<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/home.card.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/livshem_cart.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" />
    <title>Checkout</title>
</head>
<body id="body">
    <input type="hidden" id="main-id" value="{{ auth()->user()->id }}" >
    <div class="cheack-out">

    <div class="cheack-out-nav">
        <a href="/checkout"><i class="bi bi-chevron-left"></i>Tillbaka</a>
        <a href="{{ env("BASE_URL") }}"><img style="width:120px" src="{{ env("BASE_URL") }}frontend/images/logo.png"/></a>
        <a class="Customer-service" href="#"></a>
    </div>

    <a class="to-top" href="#">
        <i class="fa fa-chevron-up"></i>
    </a>
    <section class="check-out-box">
        <div class="check-out-box3">
            <h1>Payment</h1>

            {!!$klarna_order->html_snippet!!}
        </div>
    </section>
    

     <!-- -----------------footer------------->

    <footer class=" w-full overflow-hidden">  
      
    <div class="bg-[#b1e1a0] text-black flex flex-col justify-center items-center py-10">
        <div class="w-full max-w-7xl">
          <div class="w-full grid sm:grid-cols-2 lg:grid-cols-3">
            <ul class="px-4">
              <li class="border-b-2 border-gray-500 text-2xl font-bold mb-3 pb-2 whitespace-nowrap">Handla </li>
              <li><a href="{{ route('handla-pa-livsham') }}"> Så handlar du på livshem.se </a></li>
              <li> <a href="{{ route('faqs') }}"> Vanliga frågor</a></li>
              <li><a href="{{ route('purchaseterms') }}">Köpvilkor</a> </li>
              <li><a href="{{ route('gdpr') }}">GDPR</a> </li>
              <li><a href="{{ route('privacypolicy') }}">Integritetspolicy</a> </li>
              <li><a href="{{ route('cookiepolicy') }}">Cookiepolicy</a> </li>
            </ul>
            <ul class="px-4">
              <li class="border-b-2 border-gray-500 text-2xl font-bold mb-3 pb-2 whitespace-nowrap">Livshem </li>
              <li > <a href="{{ route('aboutus') }}"> Om Livshem</a></li>
              <li style="cursor:pointer"><a href="{{ route('Kontakta-oss') }}"> Kontakta Oss</a></li>
              
            </ul>
            
            <ul class="px-4">
              <li class="border-b-2 border-gray-500 text-2xl font-bold mb-3 pb-2 whitespace-nowrap">Betalning </li>
              <li>
                  <img src="{{ asset('frontend/images/klarna.png') }}" alt="klarna-logo" class="w-[120px] p-2 rounded-md ">
              </li>
              {{-- <li class="text-center text-3xl space-x-4 my-4"> 
                <i class="fa-regular fa-credit-card hover:text-green-500"></i>
                <i class="fa-brands fa-cc-paypal hover:text-green-500"></i>
                <i class="fa-brands fa-cc-mastercard hover:text-green-500"></i>
                <i class="fa-brands fa-cc-visa hover:text-green-500"></i>
              </li> --}}
            </ul>
            
            
          </div>
          
        </div>
        <div class="mt-10 px-4 text-sm justify-center items-center">
              <p class="footer-bottom">upphovsrätt © 2023 <a href="#" class="underline underline-offset-3">livshem.se</a> Utvecklad av: <a href="https://softwarebyte.co/">Software Byte</a></p>
            </div>
    </div>
</footer>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('frontend/js/script.js') }}" type="module"></script>
    
    
    <script src="{{ asset('frontend/js/klarna-payment.js') }}" type="module"></script>
    <script src="https://x.klarnacdn.net/kp/lib/v1/api.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 5,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },

      breakpoints: {
        0: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        450: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
      },
    });
  </script>

</body>
</html>
<footer class=" w-full overflow-hidden absolute">  
      
    <div class="bg-[#b1e1a0] text-black flex flex-col justify-center items-center py-10">
        <div class="w-full max-w-7xl">
          <div class="w-full grid sm:grid-cols-2 lg:grid-cols-3">
            <ul class="px-4">
              <li class="border-b-2 border-gray-500 text-2xl font-bold mb-3 pb-2 whitespace-nowrap">Handla </li>
              <li><a href="{{ route('handla-pa-livsham') }}"> Så handlar du på livshem.se </a></li>
              <li> <a href="{{ route('faqs') }}"> Vanliga frågor</a></li>
              <li><a href="{{ route('purchaseterms') }}">Köpvillkor</a> </li>
              <!--<li><a href="{{ route('gdpr') }}">GDPR</a> </li>-->
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
              <p class="footer-bottom">upphovsrätt &copy; {{ date("Y") }} <a href="#" class="underline underline-offset-3">livshem.se</a> Utvecklad av: <a href="https://softwarebyte.co/">Software Byte</a></p>
            </div>
    </div>
</footer>
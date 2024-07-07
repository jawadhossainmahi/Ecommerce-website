@extends('frontend.master')

@section('content')

 <div class="cookie-policy max-w-screen-xl mx-auto px-[16px] py-[12px]">

        <h1 class="font-[800] my-5 text-[2.6rem]">Kontakta Oss</h1>

        <p class="text-[17px] my-3">För hjälp i ett personligt ärende kontaktar du Livshem via e-post, telefon eller genom att använda talsvar. </p>






    <h3 class="font-[600] mt-5 text-[1.5rem]">Ring</h3>

        <p class="text-[17px] my-3">Ring oss om du har ett personligt ärende eller en fråga som du inte hittar i <a class="text-[green]" href="{{ env("BASE_URL") }}vanliga-fragor">Vanliga frågor </a> 
        <br>
            Telefon  <a class="text-[green]" href="">08 – 222 555</a>  </p>




    <h3 class="font-[600] mt-5 text-[1.5rem]">Skriv till oss</h3>

        <p class="text-[17px] my-3">Du når Livshem bäst på <a class="text-[green]" href="mailto:{{ env("BASE_URL") }}">handla@livshem.se </a></p>
        
</div>


@endsection
@section('js')

    
@endsection

@extends('auth.master')
{{-- title --}}



{{-- page scripts --}}

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('content')
<div class="w-full max-w-md bg-white text-black flex flex-col justify-center space-y-4 pt-6 rounded-3xl overflow-hidden">
  <form method="POST" action="{{ route('login') }}">
    @csrf
  <div class="flex flex-col justify-center items-center space-y-5">
    
      <div class="w-[80%] flex justify-between items-center"><div class="text-base font-bold"><a href="#">Logga in</a></div> <div class="text-sm"><a href="/" class="text-black" style="font-family: avbryt">Annullera</a></div></div> 
      <div class="w-[80%] p-2 bg-white text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
          <p class="text-base font-semibold">E-postadress</p>
          <input type="email" class="w-full focus:ring-0 focus:outline-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >
          @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                @enderror
      </div>
      <div class="w-[80%] p-2 bg-white text-gray-400 rounded-md border-2 border-gray-300">
          <p class="text-base font-semibold">Lösenord</p>
          <input type="password" class="w-full focus:ring-0 focus:outline-none @error('password') is-invalid @enderror" name="password" >
          @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
          @enderror
      </div>
      <button type="submit"  class="items-center w-[80%] px-8 py-2 text-lg font-medium text-center text-white bg-green-700 rounded-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
        Logga in
      </button>
      {{-- <a href="{{ env("BASE_URL") }}password/reset" class=" Glömttext-base  hover:underline-offset-4" style="background:#15803d; color:white; padding:10px 20px; border-radius:5px;">Glömt mitt lösenord</a> --}}
      <a href="{{ env("BASE_URL") }}password/reset" class="text-lg font-medium Glömttext-base  hover:underline-offset-4" style="padding:10px 20px; border-radius:5px;">Glömt mitt lösenord</a>
    </form>
  </div>
  <div class="flex flex-col w-full">
      <div class="bg-gray-300 w-full text-center">
          <h1 class="    py-3 text-black"><a href="{{route('register')}}">Jag vill bli kund</a></h1>
      </div>
      
  </div>
</div>

<!-- login page ends -->
<script>
  function showpass(){
      var temp = document.getElementById("password");
          if (temp.type === "password") {
              temp.type = "text";
          }
          else {
              temp.type = "password";
          }
  }
</script>
@endsection

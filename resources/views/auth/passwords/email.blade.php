@extends('auth.master')
{{-- page title --}}
{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('content')
<!-- forgot password start -->
<div class="w-full max-w-md bg-white text-black flex flex-col justify-center space-y-4 pt-6 rounded-3xl overflow-hidden">
     @if (session('status'))
        <div class="status alert alert-success" style="text-align:center; background:green; color:white; padding: 10px; box-shadow: 0 0 10px #00000073;">
            {{ session('status') }}
        </div>
    @endif
  <form  method="POST" action="{{ route('password.email') }}">
   @csrf
  <div class="flex flex-col justify-center items-center space-y-5">
    
      <div class="w-[80%] flex justify-between items-center"><div class="text-base font-bold"><a>Återställ ditt lösenord</a></div></div> 
      <div class="w-[80%] p-2 bg-white text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
          <p class="text-base font-semibold">E-postadress</p>
          <input type="email" class="w-full focus:ring-0 focus:outline-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >
          
      </div>
      @error('email')
                    <span class=" invalid-feedback" role="alert">
                      <strong>{{'E-postfältet är obligatoriskt.'}}</strong>
                    </span>
        @enderror
     <button type="submit" class="btn btn-primary glow position-relative w-100" style="background:green; color:white; padding:10px 20px; border-radius:5px;">SKICKA LÖSENORD
                  <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                </button>
      <!--<a href="#" class="text-base hover:underline hover:underline-offset-4">Glömde mitt lösenord</a>-->
    </form>
  </div>
  
  <div class="flex flex-col w-full">
      <div class="bg-gray-300 w-full text-center">
          
                <a href="{{asset('login')}}">
                  <small class="text-muted">Jag kom ihåg mitt lösenord</small>
                </a>
      </div>
      
  </div>
</div>

<!-- forgot password ends -->
@endsection

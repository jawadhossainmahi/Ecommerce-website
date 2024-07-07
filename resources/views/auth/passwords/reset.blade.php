@extends('auth.master')
{{-- title --}}


{{-- page scripts --}}

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection
@section('content')
<div class="w-full max-w-md bg-white text-black flex flex-col justify-center space-y-4 pt-6 border-2 rounded-3xl overflow-hidden">
  <form method="POST"  action="{{ route('password.update') }}">
   @csrf
    <input type="hidden" name="token" value="{{ $token }}">
  <div class="flex flex-col justify-center items-center space-y-5">
    
      <div class="w-[80%] flex justify-between items-center"><div class="text-base font-bold">Återställ ditt lösenord</div></div> 
      <div class="w-[80%] p-2 bg-white text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
          <p class="text-base font-semibold">E-postadress</p>
          <input type="email" class="w-full focus:ring-0 focus:outline-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >
          
      </div>
      @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                @enderror
      <div class="w-[80%] p-2 bg-white text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
          <p class="text-base font-semibold">nytt lösenord</p>
          <input type="password" class="w-full focus:ring-0 focus:outline-none @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="new-password" >
         
      </div>
       @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                @enderror
      <div class="w-[80%] p-2 bg-white text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
          <p class="text-base font-semibold">Bekräfta nytt lösenord</p>
          <input type="password" class="w-full focus:ring-0 focus:outline-none @error('password') is-invalid @enderror" name="password_confirmation" value="{{ old('password') }}" autocomplete="new-password" >
         
      </div>
      
                
      <button type="submit" class="btn btn-primary glow position-relative w-100" style="color: white; background: green; padding: 10px 25px; border-radius: 5px;">
                    Återställ mitt lösenord
                  <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                </button>
      <!--<a href="#" class="text-base hover:underline hover:underline-offset-4">Glömde mitt lösenord</a>-->
    </form>
  </div>
  <div class="flex flex-col w-full">
      <div class="bg-gray-300 w-full text-center">
          <h1 class="py-3 text-black"><a href="{{route('register')}}">Jag vill bli kund</a></h1>
      </div>
      
  </div>
</div>

{{-- <section class="row flexbox-container">
  <div class="col-xl-7 col-10">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
        <!-- left section-login -->
        <div class="col-md-6 col-12 px-0">
          <div class="card disable-rounded-right d-flex justify-content-center mb-0 p-2 h-100">
            <div class="card-header pb-1">
              <div class="card-title">
                <h4 class="text-center mb-2">Återställ ditt lösenord</h4>
              </div>
            </div>
            <div class="card-body">
              <form class="mb-2" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                  <label class="text-bold-600" for="email">E-post</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="text-bold-600" for="password">nytt lösenord</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="form-group mb-2">
                  <label class="text-bold-600" for="password-confirm">Bekräfta nytt lösenord</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary glow position-relative w-100">
                    Återställ mitt lösenord
                  <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
        <!-- right section image -->
        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
          <img class="img-fluid" src="{{asset('app-assets/images/pages/reset-password.png')}}" alt="branding logo">
        </div>
      </div>
    </div>
  </div>
</section> --}}
@endsection

@extends('auth.master')

{{-- page title --}}

{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">

@endsection

@section('content')
<div class="w-full max-w-lg bg-white text-black flex flex-col justify-center space-y-4 pt-6 border-2 rounded-3xl overflow-hidden">
  <!--<h1 class="pb-2 ml-4"><a href=""><img src="{{ asset('frontend/images/logo.png') }}" alt="" width="100px"></a></h1>-->
  
  
  <div class="w-full text-center">

    <button id="privateType" onclick="customerType(0)" class="bg-gray-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
      Privatkund
    </button>

    <button id="businessType"  onclick="customerType(1)" class="bg-white-500 hover:bg-green-700  text-black font-bold py-2 px-4 rounded border-gray-100">
      Företagskund
    </button>

  </div>


  <form method="POST" action="{{ route('register') }}">
    @csrf

    <input type="hidden" name="customer_type" id="customer_type" value="0">

  <div class="flex flex-col justify-center items-center space-y-5">
      <div class="w-[90%] flex justify-between items-center"><div class="flex items-center text-base font-bold space-x-2">
          
          <label for="customer whitespace-nowrap">Bli Medlem</label>
          
      </div> <div class="text-sm"><a  style="font-family: avbryt" class="text-black" href="/">Annullera</a></div></div> 
      
      <div class="mx-auto w-[80%] flex flex-row justify-between items-center privateCust" >
        <div class="w-[48%]"  id="privateCust">
          <div class="p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
              <p class="text-xs font-semibold">Förnamn</p>
              <input type="text" class="w-full focus:outline-none @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >    
          </div>
          @error('name')
                      <span class="invalid-feedback" role="alert">
                        <small class="text-xs text-red-700">{{ $message }}</small>
                      </span>
                    @enderror
        </div>
        <div class="w-[48%]"  id="privateCust2">
          <div class=" p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
            <p class="text-xs font-semibold">Efternamn</p>
            <input type="text" class="w-full focus:outline-none @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" >
          </div>
            @error('last_name')
            <span class="invalid-feedback" role="alert">
              <small class="text-xs text-red-700 whitespace-nowrap">{{ $message }}</small>
            </span>
           @enderror
          
        </div>
      </div>

      <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm hidden" id="businessCust">
        <p class="text-sm font-semibold">Företagsnamn</p>
        <input type="text" class="w-full focus:outline-none @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >
      </div>
      <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm hidden" id="businessCust2" >
        <p class="text-sm font-semibold">Organisationsnummer</p>
        <input type="text" class="w-full focus:outline-none @error('organization') is-invalid @enderror" name="organization" value="{{ old('organization') }}" >
      </div>

      <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
        <p class="text-sm font-semibold">E-post</p>
        <input type="email" class="w-full focus:outline-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >
      </div>
      @error('email')
                  <span class="invalid-feedback" role="alert">
                    <small class="text-xs text-red-700">{{ $message }}</small>
                  </span>
                @enderror
      <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
          <p class="text-sm font-semibold">Telefonnummer</p>
          <input type="number" class="w-full focus:outline-none @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
        </div>
        @error('phone')
        <span class="invalid-feedback" role="alert">
          <small class="text-xs text-red-700">{{ $message }}</small>
        </span>
      @enderror
      <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
          <p class="text-sm font-semibold">Adress</p>
          <input type="text" class="w-full focus:outline-none @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">
          @error('address')
          <span class="invalid-feedback" role="alert">
            <small class="text-xs text-red-700">{{ $message }}</small>
          </span>
        @enderror
      </div>
      <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md border-2 border-gray-300">
          <p class="text-sm font-semibold">Postnummer</p>
          <input type="number" class="w-full focus:outline-none @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" >
          @error('postal_code')
                  <span class="invalid-feedback" role="alert">
                    <small class="text-xs text-red-700">{{ $message }}</small>
                  </span>
                  @enderror
      </div>
      
       <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md border-2 border-gray-300">
          <p class="text-sm font-semibold">Ort</p>
          <input type="text" class="w-full focus:outline-none @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" >
          @error('city')
                  <span class="invalid-feedback" role="alert">
                    <small class="text-xs text-red-700">{{ $message }}</small>
                  </span>
                  @enderror
      </div>
      <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md border-2 border-gray-300">
          <p class="text-sm font-semibold">Lösenord</p>
          <input type="password" class="w-full focus:outline-none @error('password') is-invalid @enderror" name="password" >
          @error('password')
                  <span class="invalid-feedback" role="alert">
                    <small class="text-xs text-red-700">{{ $message }}</small>
                  </span>
                  @enderror
      </div>
      <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md border-2 border-gray-300">
        <p class="text-sm font-semibold">Bekräfta lösenord</p>
        <input id="password-confirm" type="password" class="w-full focus:outline-none" name="password_confirmation" >
    </div>
      <button href="#" class="items-center w-[80%] px-8 py-2 text-lg font-medium text-center text-white bg-green-700 rounded-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
        Bli kund nu
      </button>
      <p class="text-sm w-[85%] text-center">
        Genom att klicka på "Bli kund nu" godkänner jag Livshem <span class="underline"><a href="{{ env("BASE_URL") }}kopvillkor">köpevillkor</a></span> , och bekräftar att jag har läst Livshem <span class="underline"><a href="{{ env("BASE_URL") }}Integritetspolicy">integritetspolicy</a></span>.
      </p>
  </div>
</form>
  <div class="flex flex-col w-full">
      <div class="bg-gray-300 w-full text-center">
          <h1 class=" py-3 text-black"><a href="{{ route('login') }}">Jag är redan kund för att logga in</a></h1>
      </div>
      
  </div>
</div>
<!-- register section starts -->
{{-- <section class="row flexbox-container">
  <div class="col-xl-8 col-10">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
        <!-- register section left -->
        <div class="col-md-6 col-12 px-0">
          <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
            <div class="card-header pb-1">
              <div class="card-title">
                <h4 class="text-center mb-2">Sign Up</h4>
              </div>
            </div>
            <div class="text-center">
              <p> <small> Please enter your details to sign up and be part of our great community</small>
              </p>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="name">Name</label>
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="Full Name">
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                  <div class="form-group mb-50">
                  <label class="text-bold-600" for="email">Email address</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Email address">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                </div>
                  <div class="form-group mb-50">
                  <label class="text-bold-600" for="Ort">Ort</label>
                  <input id="Ort" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}"  autocomplete="city" placeholder="Ort">
                  @error('city')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group position-relative">
                  <label class="text-bold-600" for="password">Password</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <i class="bx bx-show-alt position-absolute" style="top: 35px;right: 10px;" onclick="showpass()"></i>
                </div>
                <div class="form-group position-relative">
                  <label class="text-bold-600" for="password-confirm">Confirm Password</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" placeholder="Confirm Password">
                  <i class="bx bx-show-alt position-absolute" style="top: 35px;right: 10px;" onclick="showpassconf()"></i>
                </div>
                <div>
                  <input type="checkbox" name="terms" id="terms" required>  I Agree to  <a href="#" data-toggle="modal" data-target="#condtion">Terms & Coditions</a>
                </div>
                <button type="submit" class="btn btn-primary glow position-relative w-100">Create New Account<i
                  id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
              </form>
              <hr>
              <div class="text-center"><small class="mr-25">Already have an account?</small>
                <a href="{{asset('login')}}" >Sign in</a>
              </div>
             
            </div>
          </div>
        </div>
        <!-- image section right -->
        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
            <img class="img-fluid" src="{{asset('app-assets/images/pages/register.png')}}" alt="branding logo">
        </div>
      </div>
    </div>
  </div>
</section> --}}
<!-- register section endss -->
  {{-- <div class="modal fade" id="condtion" tabindex="-1" role="dialog" aria-labelledby="condtionTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="condtionTitle">Term And Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        are you agree with our all conditions
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
{{-- </div> --}} 
@endsection
@section('js')
<script src="{{ asset('app-assets/vendors/js/jquery.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/css/select-country/countrypicker.js') }}"></script>
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
  function showpassconf(){
      var temp1 = document.getElementById("password-confirm");
          if (temp1.type === "password") {
              temp1.type = "text";

          }
          else {
              temp1.type = "password";
          }
  }
  function customerType(type)
  {
    document.getElementById("customer_type").value = type;
    

    var privateCust = document.getElementById("privateCust");
    var privateCust2 = document.getElementById("privateCust2");
    var businessCust = document.getElementById("businessCust");
    var businessCust2 = document.getElementById("businessCust2");

    var businessType = document.getElementById("businessType");
    var privateType = document.getElementById("privateType");

      if (type == 1) {
        businessCust.style.display = "block";
        businessCust2.style.display = "block";
        privateCust.style.display = "none";
        privateCust2.style.display = "none";

        businessType.classList.remove("bg-white-500", "text-black");
        businessType.classList.add("bg-gray-500", "text-white");
        privateType.classList.remove("bg-gray-500", "text-white");
        privateType.classList.add("bg-white-500", "text-black");

      } else {
        privateCust.style.display = "block";
        privateCust2.style.display = "block";
        businessCust.style.display = "none";
        businessCust2.style.display = "none";

        privateType.classList.remove("bg-white-500", "text-black");
        privateType.classList.add("bg-gray-500", "text-white");
        businessType.classList.remove("bg-gray-500", "text-white");
        businessType.classList.add("bg-white-500", "text-black");

      }

  }
</script>

@endsection

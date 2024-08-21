@extends('frontend.master')
@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/authentication.css') }}">
@endsection
@section('content')
    <div class="w-full max-w-lg bg-white text-black flex flex-col justify-center space-y-4 pt-6 border-2 rounded-3xl overflow-hidden my-5 mx-auto">

        <div class="w-full text-center">

            <button id="privateType" onclick="customerType(0)" class="bg-gray-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Privatkund
            </button>

            <button id="businessType" onclick="customerType(1)" class="bg-white-500 hover:bg-green-700  text-black font-bold py-2 px-4 rounded border-gray-100">
                Företagskund
            </button>

        </div>
        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <input type="hidden" name="customer_type" id="customer_type" value="0">

            <div class="flex flex-col justify-center items-center space-y-5">
                <div class="w-[90%] flex justify-center items-center">
                    <div class="flex items-center text-base font-bold space-x-2">

                        <label for="customer whitespace-nowrap">Bli Medlem</label>

                    </div>
                </div>

                <div class="mx-auto w-[80%] flex flex-row justify-between items-center privateCust">
                    <div class="w-[48%]" id="privateCust">
                        <div class="p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
                            <p class="text-xs font-semibold">Förnamn</p>
                            <input type="text" class="w-full focus:outline-none @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}">
                        </div>
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <small class="text-xs text-red-700">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <div class="w-[48%]" id="privateCust2">
                        <div class=" p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
                            <p class="text-xs font-semibold">Efternamn</p>
                            <input type="text" class="w-full focus:outline-none @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}">
                        </div>
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <small class="text-xs text-red-700 whitespace-nowrap">{{ $message }}</small>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm hidden" id="businessCust1">
                    <p class="text-sm font-semibold">Företagsnamn</p>
                    <input type="text" class="w-full focus:outline-none @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                </div>
                <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm hidden" id="businessCust2">
                    <p class="text-sm font-semibold">Organisationsnummer</p>
                    <input type="text" class="w-full focus:outline-none @error('organization') is-invalid @enderror" name="organization" value="{{ old('organization') }}">
                </div>

                <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
                    <p class="text-sm font-semibold">E-post</p>
                    <input type="email" class="w-full focus:outline-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
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
                    <input type="number" class="w-full focus:outline-none @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}">
                    @error('postal_code')
                        <span class="invalid-feedback" role="alert">
                            <small class="text-xs text-red-700">{{ $message }}</small>
                        </span>
                    @enderror
                </div>

                <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md border-2 border-gray-300">
                    <p class="text-sm font-semibold">Ort</p>
                    <input type="text" class="w-full focus:outline-none @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}">
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <small class="text-xs text-red-700">{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md border-2 border-gray-300">
                    <p class="text-sm font-semibold">Lösenord</p>
                    <input type="password" class="w-full focus:outline-none @error('password') is-invalid @enderror" name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <small class="text-xs text-red-700">{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <div class="w-[80%] p-2 bg-white focus-within:border-2 focus-within:border-black text-gray-400 rounded-md border-2 border-gray-300">
                    <p class="text-sm font-semibold">Bekräfta lösenord</p>
                    <input id="password-confirm" type="password" class="w-full focus:outline-none" name="password_confirmation">
                </div>
                <button href="#" class="items-center w-[80%] px-8 py-2 text-lg font-medium text-center text-white bg-green-700 rounded-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Bli kund nu
                </button>
                <p class="text-sm w-[85%] text-center">
                    Genom att klicka på "Bli kund nu" godkänner jag Livshem <span class="underline"><a href="{{ url('/kopvillkor') }}">köpevillkor</a></span> , och bekräftar att jag har läst Livshem <span class="underline"><a href="{{ url('/Integritetspolicy') }}">integritetspolicy</a></span>.
                </p>
            </div>
        </form>
        <div class="flex flex-col w-full">
            <div class="bg-gray-300 w-full text-center">
                <h1 class=" py-3 text-black"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal">Jag är redan kund för att logga in</a></h1>
            </div>

        </div>
    </div>

    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 hidden" id="verify-modal">
        <div class="relative w-full max-w-md bg-white text-black flex flex-col justify-center space-y-4 pt-6 pb-4 rounded-3xl overflow-hidden">

            <!-- Close Button -->
            <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 focus:outline-none" onclick="closeModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="flex flex-col justify-center items-center space-y-5">
                <div class="w-[80%] flex justify-center items-center">
                    <div class="text-base font-bold">
                        <h4 class="card-title text-center">{{ __('Verifiera din e-postadress') }}</h4>
                    </div>
                </div>

                @if (session('message'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ __('En ny verifieringslänk har skickats till din e-postadress.') }}
                    </div>
                @endif
                <div class="text-center">
                    {{ __('Innan du fortsätter, kontrollera din e-post för en verifieringslänk.') }}
                    {{ __('Om du inte fått mejlet') }},
                </div>
                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <!--<button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klicka här för att begära en annan') }}</button>.-->
                    <button type="submit" class="btn btn-link p-2 m-0 align-baseline rounded-md text-white" style="background: green; text-decoration: none !important;">
                        {{ __('klicka här för att begära en annan') }}
                    </button>.
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('app-assets/vendors/js/jquery/jquery.min.js') }}"></script>
    {{--<script src="{{ asset('app-assets/vendors/css/select-country/countrypicker.js') }}"></script>--}}
    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                $(this).find('.invalid-feedback').remove();
                $(this).find('input').removeClass('is-invalid');

                var formData = $(this).serializeArray();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $('#spin-loader').fadeOut(function() {
                            $('#spin-loader').addClass('hidden').fadeOut();
                        });

                        if (response.success) {
                            $('#verify-modal').removeClass('hidden').fadeIn();
                        } else {
                            alert('Registration failed. ' + (response.message || 'Please try again.'));
                        }
                    },
                    error: function(xhr, status, error) {
                        const { errors } = xhr.responseJSON;
                        const errorKeys = Object.keys(errors);
                        if(errorKeys.length > 0) {
                            errorKeys.forEach(function ($key) {
                                const input = $('#registerForm').find(`input[name="${$key}"]`);
                                // input.parent('div').removeClass('border-gray-300');
                                input.addClass('is-invalid');
                                input.parent('div').append(`<span class="invalid-feedback" role="alert">
                                    <small class="text-xs text-red-700">${errors[$key][0]}</small>
                                </span>`)
                            });
                        }

                    }
                });
            });
        });

        @if (session('message'))
            $(document).ready(function() {
                $('#verify-modal').removeClass('hidden').fadeIn();
            });
            @endif

        function closeModal() {
            $('#verify-modal').addClass('hidden');
            setInterval(() => {
                window.location.href = '{{ route('login') }}'
            }, 500);
        }
    </script>


    <script>
        function showpass() {
            var temp = document.getElementById("password");
            if (temp.type === "password") {
                temp.type = "text";
            } else {
                temp.type = "password";
            }
        }

        function showpassconf() {
            var temp1 = document.getElementById("password-confirm");
            if (temp1.type === "password") {
                temp1.type = "text";

            } else {
                temp1.type = "password";
            }
        }
        $(document).ready(function() {
            $("#privateType").on('click', function() {
                $("#customer_type").val(0);
            });
            $("#businessType").on('click', function() {
                $("#customer_type").val(1);
            });
            @if (old('customer_type', 0) == 1)
                $("#businessType").trigger("click");
            @else
                @if (old('customer_type', 0) == 0)
                    $("#privateType").trigger("click");
                @endif
            @endif
        });

        function customerType(type) {
            document.getElementById("customer_type").value = type;


            var privateCust = document.getElementById("privateCust");
            var privateCust2 = document.getElementById("privateCust2");
            var businessCust = document.getElementById("businessCust1");
            var businessCust2 = document.getElementById("businessCust2");

            var businessType = document.getElementById("businessType");
            var privateType = document.getElementById("privateType");

            if (type === 1) {
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

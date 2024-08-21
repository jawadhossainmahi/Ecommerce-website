@php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
@endphp
<!DOCTYPE html>
<html lang="sv" xml:lang="sv">
@include('frontend.layouts.head')

<body class=" relative h-full" id="body">
    <div class="main-content max-w-[100vw]">
        <input type="hidden" id="businessCust" value="{{ auth()->user()->customer_type ?? 0 }}">
        @auth
            <input type="hidden" id="main-id" value="{{ auth()->user()->id }}">
        @endauth
        <div class="side-cart offcanvas offcanvas-end" tabindex="-1" id="cart" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">

                <h5 id="offcanvasRightLabel" class=" side-cart-heading ">Varukorg</h5>
                <i class="bi bi-x-lg" data-bs-dismiss="offcanvas" aria-label="Close"></i>


            </div>
            <div class="offcanvas-body">

                <div class="side-cart-links">

                    <h3 id="post-number-btn" data-bs-toggle="modal" data-bs-target="#input-code"> Ange ditt postnummer </h3>
                    {{-- <h3 id="post-number-btn" data-bs-toggle="modal" data-bs-target="#change_alert">alert, </h3> --}}
                    <h3 id="reserve-time-btn" class="hidden" data-bs-toggle="modal" data-bs-target="#select-date-time">Reservera tid</h3>
                </div>
                <div class="cart-progress-bar">
                    <span>
                        @if (auth()->user()?->customer_type == 1)
                            <h3 id="counter" class="business" style="margin-left: 15px;">Handla för 1500 till</h3>
                            <h3 id="p_message" class="d-none"></h3>
                        @else
                            <h3 id="counter" class="business d-none"></h3>
                            <h3 id="p_message"></h3>
                        @endif
                    </span>

                    <div class="progress {{ auth()->user()?->customer_type == 1 ? '' : 'd-none' }}">
                        <div class="progress-bar" id="cdp-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress {{ auth()->user()?->customer_type == 1 ? 'd-none' : '' }}">
                        <div class="progress-bar" id="p-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    @auth
                        @if (auth()->user()->customer_type == 1)
                            <p>För att komma upp till minsta order värde</p>
                        @endif
                    @endauth
                    <p id="p_message2" class="{{ auth()->user() ? (auth()->user()->customer_type == 1 ? 'd-none' : '') : '' }}">då slipper du transport avgiften på 95 kr</p>
                </div>


                <div class="cart-products" id="cart-product">
                    <h2 class="ms-3" id="message"></h2>
                </div>

                @auth
                <div class="cart-products w-100 d-flex justify-center">
                    <button data-bs-toggle="modal" data-bs-target="#soppinglist" class="ms-3" id="shopping"><i class="bi bi-cart4 col-lg-12 my-4 bg-color-black"></i> Spara som inköpslista</button>
                </div>
                @endauth

                <div class="empty">
                    <button class="empty-btn my-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Töm varukorg</button>
                </div>


                <div class="side-cart-price">
                    <div class="side-cart-total">
                        <h2>Varor</h2>
                        <h2 id="grand_total"></h2>
                    </div>

                    <div class="side-cart-discount hidden text-danger">
                        <p>Rabatt</p>
                        <p id="cart-discount"></p>
                    </div>
                    <div class="side-cart-discount hidden">
                        <p style="color: red;">Kupongrabatt</p>
                        <p id="coupon-discount" style="color: red;"></p>
                    </div>
                    <div class="side-cart-discount">
                        <p>Transportavgift</p>
                        <p id="transport-fee"></p>
                    </div>

                    <div class="side-cart-total">
                        <h2>Totalt (<span id="cart-items-count">0</span> varor)</h2>
                        <h2 id="total"></h2>
                    </div>
                    <h2 style="display:none" id="delivery"></h2>

                    <a id="checkout" class="cheakout-btn">Gå till kassan</a>

                </div>


            </div>
        </div>
        <style>
            .disabledCheckout {
                pointer-events: none;
                /* Disable clicking */
                opacity: 0.5;
                /* Make it look disabled */
                cursor: not-allowed;
                /* Change cursor to indicate it's disabled */
            }
        </style>
        <div class=" modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="bi bi-x-lg" type="button" data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <h1 class="modal-title text-center" id="staticBackdropLabel" style="font-size:20px"><b>Starta en ny varukorg?</b></h1>
                    <div class="modal-body" style="text-align: center">

                        <h6 class="my-"> Vill du verkligen starta en ny varukorg?</h6>
                    </div>
                    <div class="modal-footer justify-center">
                        <button type="button" class="btn modal-btn-3" data-bs-dismiss="modal">Nej</button>
                        <button id="empty-basket" class="btn modal-btn-4">Ja</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- shopping modal create shop --}}
        <div class="select modal fade " id="soppinglist" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">

                        <i class="bi bi-x-lg" id="shoppinglist_modal_close" type="button" data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <h1 class="text-center heading" id="soppinglist" style="font-size:20px"><b style="font-weight: 600; font-size: 25px;">Spara till inköpslistan</b></h1>
                    <form id="shopping-card-submit">
                        <div class="modal-body">

                            <div class="mb-3">
                                <h6 class="my-2" style="text-align: center; color: #6c6c6c;">Välj namnet på
                                    inköpslistan:</h6>
                                <input type="text" class="form-control" id="name" style="text-align:center">
                            </div>
                            <div class="modal-footer justify-center">
                                {{-- <button type="button" id="shoppinglist_modal_close" class="btn modal-btn-3 hidden" data-bs-dismiss="modal">Annullera</button> --}}
                                <button type="submit" id="shopping-card" class="btn modal-btn-4">Spara</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        @include('frontend.layouts.header')

        <div id="content_section">
            @yield('content')
        </div>
        <div id="all-preview-modals"></div>
        <div id="search-preview-cards"></div>
        <div id="cart-preview-cards"></div>
    </div>
    @include('frontend.layouts.footer')


    <div class="select-day-modal modal fade" id="select-date-time" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">
                <form id="delivery-time" method="POST">
                    @csrf
                    <div class="modal-header">

                        <i class="bi bi-x-lg" type="button" data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>

                    <div class="modal-body">

                        <div class="heading">
                            <!--<h3>Välj leveranstid</h3>-->
                            <!--<p>Postnummer: 123 45 <span data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"-->
                            <!--        aria-controls="offcanvasRight"> Byt adress</span></p>-->
                        </div>


                        <section>
                            <div class="dateTimeWrapper-area" style="position: relative">
                                {{-- <div class="scroller scroller-left"><i class="fa-solid fa-chevron-left fa-2x"></i></div>
                                <div class="scroller scroller-right"><i class="fa-solid fa-chevron-right fa-2x"></i></div> --}}

                                <div class="swiper mySwiper dateTimeWrapper">

                                    <ul class="nav nav-pills mb-3 flex-nowrap swiper-wrapper dateTimeList" id="pills-tabs" role="tablist">

                                    </ul>

                                </div>
                                <div class="swiper-button-next swiper-custom" style="right: -10% !important;"></div>
                                <div class="swiper-button-prev swiper-custom" style="left: -10% !important;"></div>
                            </div>
                        </section>


                        <div class="tab-content" id="pills-tabContent">

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn-close" data-bs-dismiss="modal" type="submit">Gå vidare</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    {{-- next modal postcode request modal --}}
    <div id="exampleModalToggle" class="post-code modal fade" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="bi bi-x-lg " type="button" id="postcode_closes" data-bs-dismiss="modal"></i>
                </div>

                <div class="modal-body" style="justify-content:center">
                    <h1 class="text-center text-slate-950">Tyvärr kan vi ännu inte leverera till detta område</h1>

                    <p id="postcode_errors" style="text-align:left;">Vi jobbar för fullt med att utöka våra
                        leveranser. Om du lämnar din epost nedan, kontaktar vi dig när vi börjar leverans i ditt område
                    </p>
                    <div>
                        <h6 class="text-muted" style="text-align: center"><b>E-postadress</b></h6>
                        <input type="text" id="email" name="email" class="m-1  form-control" required style="background:hsla(0, 0%, 100% , 0.36);text-align:center;">
                    </div>
                    <h6 id="emailError" class="text-center text-danger hidden ">Platser Ange din e-post</h6>
                </div>

                <div class="modal-footer">
                    <!--<p><a href="login.html">Logga in</a> eller <a href="login.html">Skapa inloggning</a></p>-->
                    <h6 class="text-center my-2"><button id="save-btnss" class="btn btn-success rounded" type="submit" value="Save" style="background: #15803d; padding: 10px 30px;">Tack!</button></h6>
                </div>
            </div>
        </div>
    </div>
    <div id="change_alert" class="change_alert modal fade" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="bi bi-x-lg" type="button" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <h1 class="modal-title text-center" style="font-size:20px"><b>Uppdatering av varukorg</b></h1>
                <div class="modal-body" style="justify-content:center">
                    <h1 class="text-center text-slate-950">Din varukorg uppdateras med aktuella priser och varor.</h1>
                </div>

                <div class="modal-footer justify-content-center">
                    <!--<p><a href="login.html">Logga in</a> eller <a href="login.html">Skapa inloggning</a></p>-->
                    <h6 class="text-center my-2"><button id="save-btnss" class="btn btn-success rounded" type="button" data-bs-dismiss="modal" style="background: #15803d; padding: 10px 30px;">Ok</button></h6>
                </div>




            </div>
        </div>
    </div>
    <div class="post-code modal fade" id="input-code" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="bi bi-x-lg" type="button" id="postcode_close" data-bs-dismiss="modal"></i>
                </div>
                <form id="postcode_add" method="POST">
                    @csrf
                    <div class="modal-body">

                        <h1 class="post_title">Ange ditt postnummer</h1>

                        <p class="post_details">Fyll i ditt postnummer för att se om Livshem kan leverera till dig och
                            dina alternativ för
                            hemleverans.</p>

                        <p id="postcode_error" class="text-center text-danger hidden"></p>

                        <div id="otp" onSubmit="onSubmit(event)" class="inputs d-flex flex-row justify-content-center mt-2">
                            <input class="m-1 text-center form-control rounded code-input" name="postcode_1" type="number" id="first" maxlength="1" required />
                            <input class="m-1 text-center form-control rounded code-input" name="postcode_2" type="number" id="second" maxlength="1" required />
                            <input class="m-1 text-center form-control rounded code-input" name="postcode_3" type="number" id="third" maxlength="1" required />
                            <input class="m-1 text-center form-control rounded code-input" name="postcode_4" type="number" id="fourth" maxlength="1" required />
                            <input class="m-1 text-center form-control rounded code-input" name="postcode_5" type="number" id="fifth" maxlength="1" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--<p><a href="login.html">Logga in</a> eller <a href="login.html">Skapa inloggning</a></p>-->
                        <p><button id="postnumber-save-btn" type="submit" value="Save">Spara</button></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button hidden id="message-modal-btn" data-bs-toggle="modal" data-bs-target="#message-modal">
        Message Modal Button
    </button>
    <div class="modal fade" id="message-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="message-modal" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">

                    <i class="bi bi-x-lg" type="button" id="message-modal-close" data-bs-dismiss="modal"></i>
                </div>
                <div id="message-modal">
                    @csrf
                    <div class="modal-body">



                        <p id="message-modal-message" style="text-align: center"></p>


                    </div>
                    <div class="modal-footer">
                        <p><button type="submit" class="btn modal-btn-4" data-bs-dismiss="modal" value="Save">Stänga</button></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- auth modals -->
    @include('frontend.partials.auth-modals')

    <!-- fixed bottom -->
    <div class="z-20 flex justify-center lg:justify-end w-full fixed bottom-20 lg:bottom-4 lg:right-4">
        <button class=" rounded-full w-8 h-8 shadow-sm shadow-black text-white" style="background: #8cca76;"><a href="#body"><i class="fa-solid fa-chevron-up"></i></a></button>
    </div>
    <div class="z-20 flex items-center fixed bottom-20 right-3 px-6 py-2 hover:bg-green-800 rounded-md text-white lg:left-4 lg:right-auto lg:bottom-4 shadow-sm shadow-green-700 whitespace-nowrap cursor-pointer" style="background: #15803d;" id="ChatBtn">
        <i class="fa-solid fa-message mr-2"></i>
        <p class="text-sm">Chatt</p>
    </div>

    <form action="{{ route('admin.message.store') }}" method="POST" class="flex flex-col max-w-xs fixed bottom-0 right-3 rounded-t-lg lg:left-2 lg:right-auto shadow-sm shadow-black overflow-hidden z-30 hidden" id="ChatBox">
        <div class="bg-[#007033] py-2 px-4 text-lg font-bold text-white flex justify-between">
            <h1>Chatt</h1>
            @csrf
            <div class="space-x-3">
                <i class="fa solid fa-xmark cursor-pointer" id="CloseChatBtn"></i>
            </div>
        </div>
        <div class="w-full bg-white py-2 px-4 space-y-4 max-h-[20rem] overflow-y-scroll">
            <div class="flex space-x-3">
                <div>
                    <label for="fname" autofocus class=" font-semibold text-xs px-2">Förnamn</label>
                    <input required type="text" id="chattinput_fname" name="fname" class="w-full border border-gray-400 rounded-md p-2">
                </div>
                <div>
                    <label for="lname" class="font-semibold text-xs px-2">Efternamn</label>
                    <input required type="text" name="lname" class="w-full border border-gray-400 rounded-md p-2">
                </div>
            </div>
            <div>
                <label for="email" class="font-semibold text-xs px-2">E-post</label>
                <input required type="email" name="email" class="w-full border border-gray-400 rounded-md p-2">
            </div>

            <div>
                <label for="subject" class="font-semibold text-xs px-2">Ämne</label>
                <input required type="text" name="subject" class="w-full border border-gray-400 rounded-md p-2">
            </div>
            <div>
                <label for="orderno" class="font-semibold text-xs px-2">Ordernummer</label>
                <input type="text" name="orderno" class="w-full border border-gray-400 rounded-md p-2">
            </div>

            <div>
                <label for="message" class="font-semibold text-xs px-2">Meddelande</label>
                <textarea required type="text" name="message" class="w-full border border-gray-400 rounded-md p-2"></textarea>
            </div>
            <div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}">
            </div>
        </div>

        <div class="py-4 bg-white w-full flex justify-center">
            <button type="submit" class="bg-green-600 hover:bg-green-800 py-2 w-[90%] rounded-md text-white">Skicka
                meddelandet</button>
        </div>
    </form>

    <div class=" z-20 bg-white fixed bottom-0 left-0 right-0 flex justify-evenly space-x-5 py-2 lg:hidden" style=" box-shadow: 0 0 10px #c6c5c5;">
        <a href="/" class="m-0 flex flex-col justify-center items-center hover:text-green-600 active:text-green-600 cursor-pointer w-20">
            <i class="fa-solid fa-home"></i>
            <p class="text-xs">Hem</p>
        </a>
        <a href="javascript" class="m-0 flex flex-col justify-center items-center hover:text-green-600 active:text-green-600 cursor-pointer w-20" type="button" aria-controls="offcanvasExample" data-bs-toggle="offcanvas" data-bs-target="#side-nav">
            <i class="fa-solid fa-bars"></i>
            <p class="text-xs">Kategorier</p>
        </a>
        <a href="{{ route('favourites') }}"class=" hidden m-0 flex flex-col justify-center items-center hover:text-green-600 active:text-green-600 cursor-pointer w-20">
            <i class="fa-solid fa-heart"></i>
            <p class="text-xs">Favoriter</p>
        </a>
        <label for="Shopping-cartbtn" data-bs-toggle="offcanvas" data-bs-target="#cart" aria-controls="offcanvasRight" class="m-0 cart-open-1 cursor-pointer">
            <div class="m-0 flex flex-col relative justify-center items-center hover:text-green-600 active:text-green-600 cursor-pointer w-20">

                <!--<div class="px-2 py-1 bg-red-500 border-2 border-white text-white rounded-full text-xs font-semibold tracking-wider -mt-9 -ml-4 ">-->

                <div class="text-xs w-[10px] h-[10px] absolute top-[-5px] right-[8px] cart-item-amount"></div>
                <!--</div>-->
                <i class="fa-solid fa-cart-shopping"></i>
                <p class="text-xs">Kundvagn</p>
                <p class="text-xs cart-total-price-overview"></p>
            </div>
        </label>
    </div>

    <button id="staticBackdropBtn" class="btn btn-primary hidden" type="button" data-bs-toggle="offcanvas" data-bs-target="#CookiePolicy" aria-controls="staticBackdrop">Toggle bottom offcanvas</button>
    <div class="offcanvas offcanvas-bottom cookie-box" data-bs-backdrop="static" tabindex="-1" id="CookiePolicy" aria-labelledby="staticBackdropLabel" style="height: 22rem">
        <div class="offcanvas-header d-flex justify-center">
            <h5 class="offcanvas-title text-[25px] text-center font-bold" id="offcanvasBottomLabel">Om cookies på
                denna webbplats</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small d-flex flex-column justify-between">
            <p>
                Vi använder cookies på vår hemsida. För att hemsidan ska fungera korrekt använder vi alltid strikt
                nödvändiga cookies. Vi har även cookies som hjälper oss att för att förbättra din upplevelse, utföra
                analys och rikta annonsering. Vissa av dessa cookies är tredjepartscookies vilket innebär att dina
                personuppgifter kan delas med en extern mottagare. För dessa cookies krävs ditt samtycke. För att förstå
                mer om hur vi använder cookies, eller för information om hur du ändrar dina cookieinställningar, se vår
                <span class="underline"><a class="text-[green]" href="{{ env('BASE_URL') }}Integritetspolicy">Integritetspolicy</a></span> och <span class="underline"><a class="text-[green]" href="{{ env('BASE_URL') }}cookiepolicy">cookiepolicy</a></span>.
            </p>
        </div>
        <div class="cookies-buttons d-flex justify-center">
            <button id="Accept-cookie-btn" data-bs-dismiss="offcanvas" aria-label="Close" class="Accept-cookie-btn">Godkänn alla</button>
            <button id="Reject-cookie-btn" data-bs-dismiss="offcanvas" aria-label="Close" class="Reject-cookie-btn">Endast nödvändiga</button>
        </div>
    </div>


    <!------ preloader---->


    <!------- preloader end----------->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 5,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
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



    @include('frontend.layouts.script')

</body>

</html>

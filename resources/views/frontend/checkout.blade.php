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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/livshem_cart.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/toastr.min.css') }}">

    <title>Checkout</title>
    <style>
        .select-day-modal .modal-footer {
            display: flex;
            justify-content: center;
        }

        .select-day-modal .modal-footer button {
            padding: 10px 70px;
            background-color: rgb(0, 96, 0);
            color: white;
            border-radius: 5px;
        }

        /* ----------time-card-slider--------- */


        .delivery-options-1 span {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            flex-direction: row-reverse;
            justify-content: space-between;
        }

        .delivery-options-1 #side_f_open,
        .delivery-options-1 #side_f_open2 {
            width: 35%;
        }


        .delivery-options label {
            width: 100%;
        }

        .time-card-slider {
            padding: 20px 0;
        }

        /*.check-out-box1 a i:hover{*/
        /*    background-color:#7cbd3c;*/
        /*}*/

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #268639;
            border-radius: 50px;
            padding: 10px 30px;
            font-family: livshem-font;
        }

        .deliver-btn button {
            padding-inline: 20px;
        }

        .check-out-box2 .options span input {
            accent-color: green;
        }


        /*.cheack-out-nav a {*/
        /*  color: #01a203;*/
        /*  text-decoration: none;*/
        /*  font-size: 17px;*/
        /*  font-family: livshem-font;*/
        /*}*/
        /*.cheack-out-nav {*/
        /*  display: flex;*/
        /*  align-items: center;*/
        /*  justify-content: space-between;*/
        /*  padding: 20px 30px;*/
        /*  background-color: rgb(255, 255, 255);*/
        /*  color: #f1f1f1;*/
        /*  border-bottom: 2px solid #d7d7d7;*/
        /*}*/
        .check-out-box {
            width: 98%;
            margin: auto;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        /*.check-out-box1 {*/
        /*  background-color: rgb(255, 255, 255);*/
        /*  padding: 50px;*/
        /*  margin: 50px 0;*/
        /*  border-right: 1px solid #e0e0e0;*/
        /*}*/
        .check-out-box2 {
            background-color: rgb(255, 255, 255);
            padding: 20px 20px;
            margin: 20px auto;
            border: 1px solid #e0e0e0;
            width: 50%;
        }

        .deliver-btn a {
            color: white;
            background-color: #006b30;
            text-decoration: none;
            padding: 10px 40px;
            border-radius: 10px;
            font-size: 15px;
            transition: 0.5s;
        }

        .deliver-btn a:hover {
            background-color: #7bbc06;
        }


        .swiper-slide .item label {
            width: 100%;
        }

        ------media query-------- @media(max-width:850px) {
            .check-out-box {
                display: block;
            }

            .check-out-box2 {
                border-top: 1px solid #e0e0e0;
                margin: 0px 0px 10px 0px;
            }
        }

        .swiper-slide label {
            Width: 100%;
        }

        @media(max-width:450px) {
            .delivery-options-2 span {
                display: flex;
                flex-direction: column;
            }

            .delivery-time button {
                margin-left: 0px !important;

            }

            .delivery-options-2 label {
                text-align: center;

            }

            .address-box .address-box-head h1 {
                font-size: 22px;
            }

            .address-box .address-box-head h5 {
                font-size: 15px;
            }
        }


        .check-out-box1 {
            background-color: rgb(255, 255, 255);
            padding: 20px 20px;
            margin: 20px auto;
            border: 1px solid #e0e0e0;
            width: 50%;
        }

        .deliver-btn a {
            color: white;
            background-color: #006b30;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.5s;
        }

        .deliver-btn a :hover {
            background-color: #7bbc06;
        }

        .deliver-btn button {
            color: white;
            background-color: #006b30;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.5s;
        }

        .deliver-btn button:hover {
            background-color: #7bbc06;
        }

        .delivery-time button,
        .business-order button {
            color: white;
            background-color: #006b30;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 15px;
            transition: 0.5s;
            transition: 0.3s;
        }


        .delivery-time button:hover,
        .business-order button:hover {
            background-color: #7cbd3c !important;
        }

        #reserve-time-btn:hover {
            background-color: #7cbd3c !important;
        }


        @media(max-width:850px) {
            .check-out-box {
                width: 98%;
                margin: auto;
                display: flex;
                justify-content: center;
                flex-direction: column;
            }

            .check-out-box1 {
                background-color: rgb(255, 255, 255);
                padding: 50px 20px;
                margin: 50px 0;
                border: 1px solid #e0e0e0;
                width: 100%;
            }

            .check-out-box2 {
                background-color: rgb(255, 255, 255);
                padding: 50px 20px;
                margin: 0px 0px 50px 0;
                border: 1px solid #e0e0e0;
                width: 100%;
            }


            .delivery-time {
                display: flex;
            }
        }


        @media (max-width: 952px) {
            .delivery-time {
                display: block;
            }
        }

        #selected-address,
        #billing_address {
            border: 1px solid #D7D7D7;
            display: flex;
            flex-direction: column;
            padding: 20px 100px 20px 20px;
            width: auto;
            margin: 20px 0;
            border-radius: 5px;
        }

        #selected-address h1,
        #billing_address h1 {
            font-size: 18px;
        }

        #selected-address p,
        #billing_address p {
            color: black;
        }


        .form-open {
            display: inline;
            text-size: small;
            width: 80px;
            height: 200px;
            background-color: green;
            border-radius: 8px;
            color: white;
            border: rounded;
            margin: 4px 2px;
            font-size: 31px;
            box-shadow: 0 2px 4px darkslategray;
        }

        .orderConfirmBtn {
            width: 36%;
        }

        .swiper-custom {
            color: #268639 !important;
            font-weight: bold;
        }

        .swiper-custom::after {
            font-size: 30px !important;
        }
    </style>
</head>


<body id="body">

    @php
        $businessCust = auth()->user()->customer_type ? true : false;
    @endphp

    <div class="cheack-out">
        <input type="hidden" id="main-id" value="{{ auth()->user()->id }}">
        <input type="hidden" id="businessCust" value="{{ auth()->user()->customer_type }}">

        <div class="cheack-out-nav">
            <a href="/"><i class="bi bi-chevron-left"></i></a>
            <a href="{{ env('BASE_URL') }}"><img style="width:120px"
                    src="{{ env('BASE_URL') }}frontend/images/logo.png" /></a>
            <a class="Customer-service" href="#"></a>
        </div>

        <a class="to-top" href="#">
            <i class="fa fa-chevron-up"></i>
        </a>


        <section class="check-out-box">
            <div class="check-out-box1">
                <h1>Kundvagn</h1>
                <h3 style="font-size: 1.43rem;margin-bottom: 1rem;"><span id="cart-item-amount"></span> Varor redo för
                    hemleverans</h3>



                <span id="dots" style="display: block;"></span>
                <span id="more" style="display: none;">
                    <div id="cart-product">

                        <div class="cart-card-counter d-flex">
                            <a><i style="background-color: rgb(255, 255, 255);"
                                    class="bi bi-dash-circle-fill minus"></i></a>
                            <input type="number" class="st" value="0" size="2">
                            <a><i style="background-color: rgb(255, 255, 255);"
                                    class="bi bi-plus-circle-fill plus"></i></a>


                        </div>
                    </div>



                </span>

                <div class="delivery-content">
                    <!--<p class="active">Deducted discount: 43:80</p>-->
                    <!--<p>Delivery cost: 0:-</p>-->
                    <!--<p>Fee for small shopping basket: SEK 95</p>-->
                    <!--<h3>Att betala: <span id="total"> </span></h3>-->
                    <div class="side-cart-total">
                        <h2 style="font-size: 1rem !important">Varor</h2>
                        <h2 id="grand_total" style="font-size: 1rem !important"></h2>
                    </div>


                    <div class="side-cart-discount hidden">
                        <p style="color: red;font-size: 1rem !important;">Rabatt</p>
                        <p id="cart-discount" style="color: red;font-size: 1rem !important;"></p>
                    </div>
                    <div class="side-cart-discount hidden">
                        <p style="color: red;font-size: 1rem !important;">Kupongrabatt</p>
                        <p id="coupon-discount" style="color: red;font-size: 1rem !important;"></p>
                    </div>

                    <div class="side-cart-discount">
                        <p style="color: black;font-size: 1rem !important;font-weight: 600 !important;">Transportavgift</p>
                        <p id="transport-fee" style="color: black;font-size: 1rem !important;font-weight: 600 !important;"></p>
                    </div>

                    {{--<div class="side-cart-total checkout-taxs">
                        <h3 style="font-size: 1rem !important">Varav 12% moms</h3>
                        <h3 id="tax_12_percent" style="font-size: 1rem !important"></h3>
                    </div>
                    <div class="side-cart-total checkout-taxs">
                        <h3 style="font-size: 1rem !important">Varav 25% moms</h3>
                        <h3 id="tax_25_percent" style="font-size: 1rem !important"></h3>
                    </div>--}}

                    <div class="side-cart-total checkout-taxs">
                        <h2 style="font-size: 1rem !important">Total moms</h2>
                        <h2 id="tax_total" style="font-size: 1rem !important"></h2>
                    </div>

                    <div class="side-cart-total">
                        <h2>Totalt (<span id="cart-items-count">0</span> varor)</h2>
                        <h2 id="total"></h2>
                    </div>
                    <p class="hidden" id="p_message2"></p>
                    <p class="hidden" id="checkout"></p>
                    <p class="hidden" id="p-bar"></p>
                </div>

                <div class="deliver-btn justify-content-end flex-wrap">

                    <button onclick="myFunction()" id="myBtn" style="display: block;">Visa kundvagnen</button>
                </div>

                @guest
                    <div class="delivery-time">
                        <h1>Leveranstid</h1>
                        <button id="reserve-time-btn" data-bs-toggle="modal" data-bs-target="#select-date-time">Ändra
                            leveranstid</button>
                    </div>
                    <div class="deliver-btn justify-content-center flex-wrap">

                        <a class="klarna-payment">Betala med Klarna</a>
                    </div>
                @endguest

            </div>

            @auth
                <div class="check-out-box2">




                    <div class="delivery-options">
                        <div class="delivery-options-1">
                            <h1>Leveransadress
                                <span id="side_f_open" class="m-0">
                                    <i class="bi bi-pencil-fill" data-bs-toggle="offcanvas" data-bs-target="#side-form"
                                        aria-controls="offcanvasRight">
                                        ändra</i>
                                </span>
                            </h1>
                            <div id="selected-address">

                            </div>
                        </div>

                        @if (auth()->user()->customer_type == 1)
                            <div class="delivery-options-1">
                                <span>
                                    <input required name="name_of_recipient" id=""
                                        class="px-2 py-1 rounded border-solid border-2 border-green-700 my-2"
                                        type="text">
                                    <label>Namn på mottagare</label>
                                </span>
                            </div>
                        @endif
                        <div class="delivery-options-1">
                            <span>
                                <input id="checkout_leave_outside" class="switch" type="checkbox">
                                <label>Lämna varor utanför dörren</label>
                            </span>
                        </div>


                        <div class="delivery-options-1">
                            <span>
                                <input onclick="B_myFunction()" id="myBtn2" class="switch checkout_message_toggle"
                                    type="checkbox">
                                <label>Jag har ett meddelande till föraren</label>
                            </span>

                            <span id="dots2"></span><span id="more2">
                                <textarea name="" id="checkout_message" cols="30" rows="3"
                                    placeholder="särskild begäran om denna beställning"></textarea>
                            </span>
                        </div>


                        <!--<div class="delivery-options-1">-->
                        <!--    <span>-->
                        <!--        <input onclick="C_myFunction()" id="myBtn3" class="switch checkout_recurring_delivery_toggle " type="checkbox">-->
                        <!--        <label>Jag vill skapa ett abonnemang</label>-->
                        <!--    </span>-->

                        <!--    <span id="dots3"></span><span id="more3">-->

                        <!--        <div class="delivery-options-1-content">-->
                        <!--            <p> <i class="bi bi-check-circle-fill"></i>Ingen bindningstid eller avbokningsavgift</p>-->

                        <!--            <form id="checkout_recurring_delivery" class="options">-->

                        <!--                <span>-->
                        <!--                    <input class="checkout-radio-btn" type="radio" name="weekly" id="every_week">-->
                        <!--                    <p>Varje vecka</p>-->
                        <!--                </span>-->

                        <!--                <span>-->
                        <!--                    <input class="checkout-radio-btn" type="radio" name="weekly" id="bi_weekly">-->
                        <!--                    <p>Som utkommer varannan vecka</p>-->
                        <!--                </span>-->

                        <!--            </form>-->

                        <!--        </div>-->
                        <!--    </span>-->

                        <!--</div>-->
                        <hr>
                        <div class="delivery-options-2 mt-4">
                            <span class="flex justify-content-between">
                                <label>Använd Rabattkod</label>
                                <div>

                                    <input id="coupon"
                                        class="px-2 py-1 rounded border-solid border-2 border-green-700 my-2"
                                        type="text">
                                    <div id="error"></div>
                                </div>
                            </span>
                        </div>




                    </div>

                </div>

                {{-- Business customer --}}
                @if ($businessCust)
                    <div class="check-out-box2">

                        <div class="delivery-options">
                            <div class="delivery-options-1">
                                <h1>Fakturaadress
                                    <span id="side_f_open2" class="m-0">
                                        <i class="bi bi-pencil-fill" data-bs-toggle="offcanvas"
                                            data-bs-target="#side-form-billing" aria-controls="offcanvasRight">
                                            {{-- <i class="bi bi-pencil-fill" > --}}
                                            ändra</i>
                                    </span>
                                </h1>
                            </div>
                            <div class="delivery-options-1">
                                <span>
                                    <input id="sameAsDeliveryAddress" class="switch" type="checkbox"
                                        ${localStorage.getItem('selected_delivery_address')===localStorage.getItem('selected_billing_address')}>
                                    <label>Samma som leveransadress</label>
                                </span>
                            </div>
                            <div class="">
                                <div id="billing_address"></div>
                            </div>

                        </div>

                    </div>
                @endif
            @endauth

            <div class="check-out-box2">

                <div class="delivery-time" style="display: flex;justify-content: space-between;padding: 18px 0px;">
                    <h1>Leveranstid</h1>
                    <button id="reserve-time-btn" class="orderConfirmBtn" data-bs-toggle="modal"
                        data-bs-target="#select-date-time">Ändra
                        leveranstid</button>
                </div>

            </div>

            <div class="check-out-box2">
                @if (!$businessCust)
                    <div class="deliver-btn flex justify-between align-middle p-2">
                        <h1>Betalning</h1>
                        <a class="klarna-payment orderConfirmBtn text-center">Betala med Klarna</a>
                    </div>
                @endif

                @if ($businessCust)
                    <div class="business-order">
                        <div style="display: flex;justify-content: space-between;padding: 18px 0px;">
                            <h1>Betalning</h1>
                            <button class="business-customer-order orderConfirmBtn"
                                id="businessCustomerOrderConfirmation">Bekräfta köp med faktura</button>
                        </div>

                        <div class="text-center">
                            <p class="m-3">Genom att klicka på "Bekräfta köp med faktura" godkänner jag Livshem <a
                                    href="{{ url('/kopvillkor') }}"><u>köpvillkor</u></a>, och
                                bekräftar att jag har läst Livshem <a
                                    href="{{ url('/Integritetspolicy') }}"><u>integritetspolicy</u></a>.
                            </p>
                        </div>

                    </div>
                @endif
            </div>

        </section>





        <!-- -----------------side-form------------------ -->
        <div class="profile-side-form offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
            aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-body">
                <section class="address-box">
                    <div class="address-box-head">
                        <h1>Välj adress</h1>

                        <i class="bi bi-x-lg" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></i>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 m-3">
                            <div class="add-address">
                                <p>Lägg till adress</p>

                                <span data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-profile"
                                    aria-controls="offcanvasRight">
                                    <i class="bi bi-plus-circle-fill"></i>
                                    <p>Lägg till</p>
                                </span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- -----------------side-form-2----------------- -->


        <div class="profile-side-form offcanvas offcanvas-end" tabindex="-1" id="side-form"
            aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-body">
                <section class="address-box">
                    <div class="address-box-head">
                        <h1>Leveransadress</h1>
                        <i id="delivery-address-close-modal" class="bi bi-x-lg" class="btn-close text-reset"
                            data-bs-dismiss="offcanvas" aria-label="Close"></i>
                    </div>

                    <div class="row m-3">

                        @if ($delivery_addresses->count())
                            @foreach ($delivery_addresses as $delivery_address)
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <div class="add-address">

                                        <h4>{{ $delivery_address->fname }} {{ $delivery_address->lname }}</h4>

                                        <h5 class="street_addresss">{{ $delivery_address->street_address }}</h5>
                                        <h5 class="postal_code">{{ $delivery_address->zip_code }}
                                            {{ $delivery_address->postal_address }}</h5>

                                        <div class="flex justify-between">
                                            <div class="flex items-center gap-3 form-openss">
                                                <i class="bi bi-plus-circle-fill" data-bs-toggle="offcanvas"
                                                    data-bs-target="#offcanvas-{{ $delivery_address->id }}"
                                                    aria-controls="offcanvasRightChange"></i>
                                                <p> Ändra</p>
                                            </div>
                                            <button id="{{ $delivery_address->id }}" class="delivery-address-add-btn"
                                                style="color: white; background-color: #006b30; text-decoration: none; padding: 10px 15px; border-radius: 10px;">
                                                Bekräfta
                                            </button>
                                        </div>




                                    </div>
                                </div>
                                {{-- </div> --}}
                            @endforeach
                        @endif
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <div class="add-address">
                                <p>Lägg till ny address</p>
                                <span data-bs-toggle="offcanvas" data-bs-target="#side-form-profile"
                                    aria-controls="offcanvasRight">
                                    <i class="bi bi-plus-circle-fill"></i>
                                    <p>Lägg till</p>
                                </span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        @include('frontend.billingAddressForm')

        <div class="offcanvas offcanvas-end" tabindex="-1" id="side-form-profile"
            aria-labelledby="side-form-profile">
            <div class="offcanvas-body p-0">
                <section class="address-box">
                    <div class="address-box-head">
                        <h1>Skapa ny adress</h1>
                        <h5 data-bs-toggle="offcanvas" data-bs-target="#side-form" aria-controls="side-form"
                            aria-label="Close">Avbryt</h5>
                    </div>

                    <div class="row">
                        <form method="POST" action="{{ route('add_address') }}">
                            @csrf
                            <div class="side-form col-lg-11 mx-auto px-4">

                                <p>Leveransadress</p>

                                <div class="row g-3">
                                    <div class="col-{{ $businessCust ? 12 : 6 }}">
                                        <input type="text" required name="fname"
                                            placeholder="{{ $businessCust ? 'Företags namn*' : 'Förnamn*' }}"
                                            aria-label="{{ $businessCust ? 'Företags namn' : 'First name' }}">
                                    </div>
                                    @if (!$businessCust)
                                        <div class="col-6">
                                            <input type="text" name="lname" placeholder="Efternamn*"
                                                aria-label="Last name">
                                        </div>
                                    @endif
                                </div>

                                <input type="text" required name="street_address" placeholder="Gatuadress*">

                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" name="zip_code" placeholder="Postnummer"
                                            aria-label="Zip code">
                                    </div>
                                    <!--<div class="col-6">-->
                                    <!--    <input type="text" name="postal_address" placeholder="Postort*" aria-label="Postort*">-->
                                    <!--</div>-->
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="text" name="city" placeholder="Ort"
                                            aria-label="Locality">
                                    </div>
                                </div>
                                <!--<input type="text" name="port_code" placeholder="Portkod*">-->


                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="number" required name="mobile_number"
                                            placeholder="Mobilnummer*" aria-label="Mobile number">
                                    </div>
                                    <!--<div class="col-6">-->
                                    <!--    <input type="number" name="home_phone" placeholder="Hemtelefon*" aria-label="Hemtelefon">-->
                                    <!--</div>-->
                                </div>




                                <button class="add-btn">Lägg till</button>

                            </div>

                        </form>
                    </div>
                </section>
            </div>
        </div>


        <div class="select-day-modal modal fade" id="select-date-time" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">
                    <form id="delivery-time" method="POST">
                        @csrf
                        <div class="modal-header">

                            <i class="bi bi-x-lg" type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></i>
                        </div>

                        <div class="modal-body">

                            <div class="heading">

                            </div>


                            <section>
                                <div class="dateTimeWrapper-area" style="position: relative">


                                    <div class="swiper mySwiper dateTimeWrapper">

                                        <ul class="nav nav-pills mb-3 flex-nowrap swiper-wrapper dateTimeList"
                                            id="pills-tabs" role="tablist">

                                        </ul>

                                    </div>
                                    <div class="swiper-button-next swiper-custom" style="right: -10% !important;">
                                    </div>
                                    <div class="swiper-button-prev swiper-custom" style="left: -10% !important;">
                                    </div>
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


        @if ($delivery_addresses->count())
            @foreach ($delivery_addresses as $delivery_address)
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-{{ $delivery_address->id }}"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-body p-0">
                        <section class="address-box">
                            <div class="address-box-head">
                                <h1>Redigera adress</h1>
                                <h5 data-bs-toggle="offcanvas" data-bs-target="#side-form" aria-controls="side-form"
                                    aria-label="Close">Avbryt</h5>
                            </div>

                            <div class="row">
                                <form method="POST" action="{{ route('edit_address') }}">
                                    @csrf
                                    <div class="side-form col-lg-11 mx-auto px-4">

                                        <p>Leveransadress</p>

                                        <div class="row g-3">
                                            <div class="col-{{ $businessCust ? 12 : 6 }}">
                                                <input type="hidden" name="id"
                                                    value="{{ $delivery_address->id }}">

                                                <input type="text" required name="fname"
                                                    placeholder="{{ $businessCust ? 'Företags namn*' : 'Förnamn*' }}"
                                                    value="{{ $delivery_address->fname }}"
                                                    aria-label="{{ $businessCust ? 'Företags namn' : 'First name' }}">
                                            </div>
                                            @if (!$businessCust)
                                                <div class="col-6">
                                                    <input type="text" name="lname" placeholder="Efternamn*"
                                                        value="{{ $delivery_address->lname }}"
                                                        aria-label="Last name">
                                                </div>
                                            @endif
                                        </div>

                                        <input type="text" required name="street_address"
                                            value="{{ $delivery_address->street_address }}"
                                            placeholder="Gatuadress*">

                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" name="zip_code" placeholder="Postnummer"
                                                    value="{{ $delivery_address->postal_code }}"
                                                    aria-label="Zip code">
                                            </div>
                                            <!--<div class="col-6">-->
                                            <!--    <input type="text" name="postal_address" placeholder="Postort*" aria-label="Postort*">-->
                                            <!--</div>-->
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-12">
                                                <input type="text" name="mobile_number" required
                                                    placeholder="Mobilnummer*" value="{{ $delivery_address->phone }}"
                                                    aria-label="Mobile number">
                                            </div>

                                        </div>

                                        <div class="row g-3">
                                            <div class="col-12">
                                                <input type="text" name="city"
                                                    value="{{ $delivery_address->city }}" placeholder="Ort*"
                                                    aria-label="Locality">
                                            </div>
                                        </div>

                                        <button class="add-btn">Lägg till</button>

                                    </div>

                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- <button  data-bs-toggle="modal" data-bs-target="#purchaseModal">PurchaseModal</button> -->
        @include('frontend.partials.purchaseModal')


        <!-- -----------------footer------------->

        <footer class=" w-full overflow-hidden  mt-4">

            <div class="bg-[#b1e1a0] text-black flex flex-col justify-center items-center py-10 px-4">
                <div class="w-full max-w-7xl">
                    <div class="w-full grid sm:grid-cols-2 lg:grid-cols-3">
                        <ul class="px-4">
                            <li class="border-b-2 border-gray-500 text-2xl font-bold mb-3 pb-2 whitespace-nowrap">
                                Handla </li>
                            <li><a href="{{ route('handla-pa-livsham') }}"> Så handlar du på livshem.se </a></li>
                            <li> <a href="{{ route('faqs') }}"> Vanliga frågor</a></li>
                            <li><a href="{{ route('purchaseterms') }}">Köpvilkor</a> </li>
                            <!--<li><a href="{{ route('gdpr') }}">GDPR</a> </li>-->
                            <li><a href="{{ route('privacypolicy') }}">Integritetspolicy</a> </li>
                            <li><a href="{{ route('cookiepolicy') }}">Cookiepolicy</a> </li>
                        </ul>
                        <ul class="px-4">
                            <li class="border-b-2 border-gray-500 text-2xl font-bold mb-3 pb-2 whitespace-nowrap">
                                Livshem </li>
                            <li> <a href="{{ route('aboutus') }}"> Om Livshem</a></li>
                            <li style="cursor:pointer"><a href="{{ route('Kontakta-oss') }}"> Kontakta Oss</a></li>

                        </ul>

                        <ul class="px-4">
                            <li class="border-b-2 border-gray-500 text-2xl font-bold mb-3 pb-2 whitespace-nowrap">
                                Betalning </li>
                            <li>
                                <img src="{{ asset('frontend/images/klarna.png') }}" alt="klarna-logo"
                                    class="w-[120px] p-2 rounded-md ">
                            </li>
                            {{-- <li class="text-center text-3xl space-x-4 my-4">
                <i class="fa-regular fa-credit-card hover:text-green-500"></i>
                <i class="fa-brands fa-cc-paypal hover:text-green-500"></i>
                <i class="fa-brands fa-cc-mastercard hover:text-green-500"></i>
                <i class="fa-brands fa-cc-visa hover:text-green-500"></i>
              </li> --}}
                        </ul>

                    </div>

                    <div class="mt-10 px-4 text-sm text-center">
                        <p class="footer-bottom">upphovsrätt © 2023 <a href="#"
                                class="underline underline-offset-3">livshem.se</a> Utvecklad av: <a
                                href="https://softwarebyte.co/">Software Byte</a></p>
                    </div>
                </div>
            </div>
        </footer>
        <div id="all-preview-modals"></div>
    </div>

    <script>
        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Visa kundvagnen";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Visa kundvagnen";
                moreText.style.display = "inline";
            }
        }

        function RemoveOrderMessage() {
            const url = "{{ env('BASE_URL') }}"
            $.ajax({
                url: url + "orders/message/remove",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "POST",

                success: function(response) {},
            });
        }

        function B_myFunction() {
            var dots = document.getElementById("dots2");
            var moreText2 = document.getElementById("more2");
            var btnText2 = document.getElementById("myBtn2");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText2.innerHTML = "";
                moreText2.style.display = "none";
                RemoveOrderMessage();
            } else {
                dots.style.display = "none";
                btnText2.innerHTML = "";
                moreText2.style.display = "inline";
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> --}}
    <script src="https://cdn.tailwindcss.com"></script>


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
    <script src="{{ asset('frontend/js/klarna-payment.js') }}" type="module"></script>
    <script src="{{ asset('frontend/js/script.js') }}" type="module"></script>
    <script src="{{ asset('frontend/js/checkout.js') }}" type="module"></script>
    <script src="{{ asset('app-assets/js/toastr.min.js') }}"></script>

</body>

</html>

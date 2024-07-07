<header class="sticky top-0 shadow-lg z-30 bg-white">
    <div class="top-header text-black ">
        <div class="lg:flex lg:justify-between lg:items-center  max-w-screen-xl mx-auto px-[16px] py-[12px]">
            <div class="flex justify-center items-center lg:block">

                <div class="side-nav lg:hidden absolute left-4 cursor-pointer">
                    <button type="button" aria-controls="offcanvasExample" data-bs-toggle="offcanvas"
                        data-bs-target="#side-nav" class="">
                        <label for="shopping-cart-checkbox" class="uncheck-label text-black trans"><i
                                class="fas fa-bars text-2xl"></i></label></button>
                </div>


                <div class="side-nav offcanvas offcanvas-start" tabindex="-1" id="side-nav"
                    aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="side-nav logo"><img src="{{ asset('frontend/images/logo.png') }}" alt="">
                        </h5>
                        <i class="bi bi-x-lg" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></i>

                    </div>
                    <div class="offcanvas-body p-0 side-nav-menu">
                        <div>
                            <ul class="list-group side-nav-links">
                                @guest
                                @else
                                    <li class="list-group-item nav-links"><a href="{{ route('orders') }}">Beställa</a></li>

                                    <li class="list-group-item nav-links"><a href="/favourites">Favoriter</a></li>
                                    <li class="list-group-item nav-links"><a
                                            href="{{ route('shopping-list') }}">Inköpslista</a></li>
                                    <li class="list-group-item nav-links"><a href="{{ route('profile') }}">Profil</a></li>
                                    {{-- <li class="list-group-item nav-links"><a href="{{ route('recurring-deliveries') }}">Recurring Deliveries</a></li>
                    <li class="list-group-item nav-links"><a href="{{ route('bonus-and-credits') }}">Kuponger</a></li> --}}
                                    <li class="list-group-item nav-links"> <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();  document.getElementById('logout-form').submit();"
                                            class="">Logga ut</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                    @if (auth()->user()->role == 0)
                                        <li class="list-group-item nav-links">
                                            <a href="/index">Dashboard</a>
                                        </li>
                                    @endif

                                @endguest

                                <li class="list-group-item nav-links"><a href="/">Hem</a></li>
                                {{-- <li class="list-group-item nav-links"><a href="/extrapriser">Erbjudanden</a></li> --}}
                                @if (\App\Models\Product::where('veckans_extrapriser', 1)->where('status', 'In Stock')->count() > 0)
                                    <li class="list-group-item nav-links"><a
                                            href="/veckans-extrapriser">{{ \App\Models\Setting::first()->campaign_name ?? 'veckans extrapriser' }}</a>
                                    </li>
                                @endif
                                @foreach ($categories as $category_item)
                                    @if ($category_item->getsubcategory->count())
                                        <button class="dropdown-btn nav-dropdown-btn sidenav-first "><a
                                                href="{{ route('pro_cat', ['category' => $category_item->id]) }}">{{ $category_item->name }}
                                                ({{ $category_item->getsubcategory->count() }})</a>
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </button>
                                        <div class="dropdown-container nav-dropdown-container" style="display:none">
                                            <button class="first-previous-nav"><i
                                                    class="fa-solid fa-arrow-left-long"></i>
                                                {{ $category_item->name }}</button>

                                            @foreach ($category_item->getsubcategory as $sub_category_item)
                                                @if ($sub_category_item->getsubsubcategory->count())
                                                    <button class="dropdown-btn nav-dropdown-btn sidenav-second "><a
                                                            href="{{ route('frontend.sub_cat', ['sub_category' => $sub_category_item->id]) }}">{{ $sub_category_item->name }}
                                                            ({{ $sub_category_item->getsubsubcategory->count() }})</a>
                                                        <i class="fa-solid fa-arrow-right-long"
                                                            style="top:12px;position:relative"></i>
                                                    </button>
                                                    <div class="dropdown-container nav-dropdown-container"
                                                        style="display:none;">
                                                        <button class="second-previous-nav"><i
                                                                class="fa-solid fa-arrow-left-long"></i>
                                                            {{ $sub_category_item->name }}</button>

                                                        @foreach ($sub_category_item->getsubsubcategory as $subsub_category_item)
                                                            <li class="list-group-item nav-links"><a
                                                                    href="{{ route('frontend.subsub_cat', ['sub_sub_category' => $subsub_category_item->id]) }}">
                                                                    {{ $subsub_category_item->name }}</a></li>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <li class="list-group-item nav-links"><a
                                                            href="{{ route('frontend.sub_cat', ['sub_category' => $sub_category_item->id]) }}">{{ $sub_category_item->name }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        {{-- <li class="list-group-item nav-links"><a href="{{ route('frontend.sub_cat', ['sub_category'=> $sub_category->id]) }}">{{$category->name }}</a></li> --}}
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <h1 class=" lg:pb-0"><a href="/">
                        <picture>
                            <img src="{{ asset('frontend/images/logo.png') }}" alt="" width="160px"
                                class="mobile-nav-logo" />
                        </picture>
                    </a></h1>
                @guest
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal"
                        class="lg:hidden absolute right-4 cursor-pointer"><i
                            class="bi bi-person-fill login-mobile a "></i></a>

                @endguest
            </div>

            <form class="nav-search relative" action="{{ route('product.search') }}" method="POST" autocomplete="off">
                <div class="flex items-center search-bar">
                    <div class="flex items-center justify-center pr-[12px]">
                        <i class="fa-solid fa-search"></i>
                    </div>
                    @csrf
                    <div class="w-full py-[14px] " id="searchWrapper">

                        <input id="SearchInput" type="search" name="searchbar" type="text"
                            class="w-full focus:outline-none" placeholder="Sök i e-handeln">

                        <ul id="drop-down-box" class="p-0 w-[180%]">
                        </ul>

                    </div>
                    <button type="submit"
                        class=" lg:block  bg-green-700 text-white h-[40px] px-2 rounded-md">Sök</button>
                </div>
            </form>


            <div class="items-center hidden lg:inline-block">

                @guest
                    <!-- <span class="mr-1"><a href="{{ route('login') }}"><i class="fa fa-user mr-2"></i>Logga in</a></span> -->
                    <span class="mr-1"><a href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#loginModal"><i class="fa fa-user mr-2"></i>Logga in </a></span>
                @else
                    <!-- Login Dropdown   -->

                    <div class="group inline-block relative z-20">
                        <a>

                            <button
                                class="text-white bg-green-700 z-[22] hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 "
                                type="button" style="border-radius:5px;">
                                <svg viewBox="-102.4 -102.4 1228.80 1228.80" xmlns="http://www.w3.org/2000/svg"
                                    fill="#fafafa" stroke="#fafafa" style=" width: 19px; height: 18px; ">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                        stroke="#CCCCCC" stroke-width="2.048"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill="#eaf0ec"
                                            d="M512 512a192 192 0 1 0 0-384 192 192 0 0 0 0 384zm0 64a256 256 0 1 1 0-512 256 256 0 0 1 0 512zm320 320v-96a96 96 0 0 0-96-96H288a96 96 0 0 0-96 96v96a32 32 0 1 1-64 0v-96a160 160 0 0 1 160-160h448a160 160 0 0 1 160 160v96a32 32 0 1 1-64 0z">
                                        </path>
                                    </g>
                                </svg>
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg></button>

                        </a>

                        <div class="absolute right-0 md:min-w-[275px] hidden text-gray-700 group-hover:block bg-white p-8 pb-10 rounded-b-[60px] overflow-hidden"
                            style="box-shadow: 0px 30px 30px rgba(0, 0, 0, 0.06); z-index:21; width: 200px;">
                            <div class="flex space-x-4">


                                <ul class="drop-down-link ">
                                    <li><a href="{{ route('orders') }}">Beställa</a>
                                    </li>
                                    <li><a href="{{ route('shopping-list') }}">Inköpslista</a>
                                    </li>
                                    <!--<li><a href="{{ route('recurring-deliveries') }}">Återkommande leveranser</a></li>-->

                                    <li><a href="{{ route('profile') }}">Profil</a></li>

                                    <!--<li><a href="{{ route('bonus-and-credits') }}">Kuponger</a></li>-->

                                    <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();  document.getElementById('logout-form').submit();"
                                            class="">Logga ut</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                    @if (auth()->user()->role == 0)
                                        <li>
                                            <a href="{{ route('dashboard') }}">Instrumentbräda</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>



                @endguest



            </div>
        </div>
    </div>
    <div class="bottom-header whitespace-nowrap bg-green-700 text-white">
        <div class="max-w-screen-xl hidden lg:flex items-center justify-between  mx-auto relative">
            <div class="flex items-center space-x-12">
                <div class="antialiased">
                    <div class="">
                        <div class="group inline-block relative">
                            <a href="/"
                                class="nav-head bg-green-700 text-white font-semibold py-3 px-4 rounded inline-flex items-center text-[18px]">
                                <span class="">Hem</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="antialiased">
                    <div class="">
                        <div class="group inline-block relative"id="main-nav-dropdown">
                            <a
                                class="nav-head bg-green-700 text-white font-semibold  py-3 px-4 rounded inline-flex items-center cursor-pointer text-[18px]">
                                <span class="">Kategorier</span>
                                {{-- <svg class="fill-current h-4 w-4">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                      </svg> --}}
                            </a>
                            <div
                                class="z-[-1] absolute  hidden text-gray-700 group-hover:block bg-white p-8 pb-10 rounded-b-[60px] overflow-hidden "style="box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.06);">
                                <div class="flex space-x-4">
                                    <ul class="drop-down-link border-r-2 border-gray-300">
                                        @php
                                            $total_count = 0;
                                            $count = 0;
                                        @endphp
                                        @foreach ($categories as $category)
                                            @php
                                                $total_count = $total_count + 1;
                                                $count = $count + 1;
                                            @endphp
                                            <li><a href="{{ route('pro_cat', ['category' => $category->id]) }}"
                                                    style="font-size:18px; padding-right:20px">{{ $category->name }}</a>
                                            </li>
                                            @if ($count == 3)
                                                @php
                                                    $count = 0;
                                                @endphp
                                    </ul>
                                    @if ($loop->remaining == 3 || $loop->remaining < 3)
                                        <ul class="drop-down-link">
                                        @else
                                            <ul class="drop-down-link pr-16 border-r-2 border-gray-300">
                                    @endif
                                    @endif
                                    @endforeach
                                    </ul>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="antialiased">
                    <div class="">
                        <div class="group inline-block relative">
                            <a href="{{ route('extrapriser') }}"
                                class="bg-green-700 text-white font-semibold  py-3 px-4 rounded inline-flex items-center cursor-pointer text-[18px]">
                                <span class="nav-head">Erbjudanden
                                </span>

                            </a>

                        </div>
                    </div>
                </div> --}}


                @if (\App\Models\Product::where('veckans_extrapriser', 1)->where('status', 'In Stock')->count() > 0)
                    <div class="antialiased">
                        <div class="">
                            <div class="group inline-block relative">
                                <a href="{{ route('veckans-extrapriser') }}"
                                    class="bg-green-700 text-white font-semibold  py-3 px-4 rounded inline-flex items-center cursor-pointer text-[18px]">
                                    <span
                                        class="">{{ \App\Models\Setting::first()->campaign_name ?? 'veckans extrapriser' }}
                                    </span>

                                </a>

                            </div>
                        </div>
                    </div>
                @endif
                @auth
                    <div class="antialiased">
                        <div class="">
                            <div class="group inline-block relative">
                                <a href="{{ route('favourites') }}"
                                    class="bg-green-700 text-white font-semibold  py-3 px-4 rounded inline-flex items-center cursor-pointer text-[18px]">
                                    <span class="">Favoriter
                                    </span>

                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="antialiased">
                        <div class="">
                            <div class="group inline-block relative">
                                <a href="{{ route('shopping-list') }}"
                                    class="bg-green-700 text-white font-semibold  py-3 px-4 rounded inline-flex items-center cursor-pointer text-[18px]">
                                    <span class="">Inköpslista
                                    </span>

                                </a>

                            </div>
                        </div>
                    </div>

                @endauth

            </div>
            <div class="flex items-center">

                <div class="antialiased hidden">
                    <div class="">
                        <div class="group inline-block relative">
                            <a
                                class="bg-green-700 text-white font-semibold py-2 px-4 rounded inline-flex items-center">
                                <span class="mr-1"><a href="{{ route('register') }}">Ny kund</a></span>

                            </a>

                        </div>
                    </div>
                </div>
                <div class="antialiased">
                    <div class="">
                        <div class="group inline-block relative">
                            <a
                                class="bg-green-700 text-white font-semibold py-2 px-3 rounded inline-flex items-center">

                                <label class="shopping-cartbtn" for="Shopping-cartbtn">
                                    <h1 data-bs-toggle="offcanvas" data-bs-target="#cart"
                                        aria-controls="offcanvasRight"
                                        class=" h-[40px] px-6 border-2 border-white bg-white font-extrabold rounded-md pb-[1px] whitespace-nowrap flex justify-center items-center cursor-pointer tracking-wider">
                                        <span class="mr-2">
                                            <img class="aspect-square w-[30px]"
                                                src="{{ asset('frontend/images/livshem_cart.png') }}" alt="logo"
                                                class="w-8 mr-2">
                                        </span class="">
                                        <span id = "cart-total-price-overview"
                                            class="cart-total-price-overview text-green-700 hidden"></span>
                                    </h1>
                                </label>
                                <div class="px-2 py-1 bg-red-500 border-2 border-white text-white rounded-full text-xs font-semibold tracking-wider -mt-9 -ml-4 hidden cart-item-amount"
                                    id="cart-item-amount">
                                    0
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="box-1" id="box"></div>



<script>
    document.getElementById('main-nav-dropdown').addEventListener("mouseover", darkbg);

    function darkbg() {
        document.getElementById("box").style.display = "block";
        // document.getElementById("body").style.overflow = "hidden";
    }
    document.getElementById('main-nav-dropdown').addEventListener("mouseout", lightbg);

    function lightbg() {
        document.getElementById("box").style.display = "none";
        // document.getElementById("body").style.overflow = "scroll";
        // document.getElementById("body").style.overflowX = "hidden";
        // document.getElementById("body").style.overflowY = "scroll";
    }
</script>

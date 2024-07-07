@extends('frontend.master')
@section('content')
    @if (session('error'))
        <div id="error" class="flex p-4 mb-4 text-red-800 rounded-lg bg-red-50 " role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{ session('error') }}
            </div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 "
                data-dismiss-target="#error" aria-label="Close">
                <span class="sr-only">Avbryt</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    @endif

    <div class="hidden w-full p-3 lg:block">
        <div class="max-w-screen-xl mx-auto px-[16px] py-[12px]">
            <div class="bg-green-50 w-full p-2 rounded-2xl">
                <div class="flex justify-evenly">
                    <div class="flex items-center space-x-2 w-72">
                        <img src="{{ asset('frontend/images/icon1.png') }}" alt="price"
                            class="bg-white-800 bg-opacity-50  w-20 h-w-20">
                        <div class="w-full">
                            <h1 class="text-xl font-bold whitespace-nowrap">Ny mataffär på nätet</h1>
                            <p class="text-justify">Vi pressar matpriserna </p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 w-72">
                        <img src="{{ asset('frontend/images/icon2.png') }}" alt="truck"
                            class="bg-white-800 bg-opacity-50  w-20 h-w-20">
                        <div class="w-full">
                            <h1 class="text-xl font-bold whitespace-nowrap">Gratis leverans</h1>
                            <p class="text-justify">Vid köp över 650 kr</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="w-full p-2 lg:hidden">-->
    <!--  <div class="max-w-screen-2xl mx-auto">-->
    <!--    <div class="bg-green-50 w-full p-4 rounded-2xl">-->
    <!--        <h1 class="text-2xl mb-2">Goda nyheter <i class="fa-solid fa-star text-base"></i></h1>-->
    <!--        <ul class="list-disc ml-6">-->
    <!--            <li>Vi har sänkt priset på massor av favoritartiklar</li>-->
    <!--            <li>Vi har plockat upp tusentals nya föremål att upptäcka</li>-->
    <!--            <li>Fria leveranser även samma dag vid köp över 750 kr</li>-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->

    <div class="w-full p-2">
        <div class="max-w-screen-xl mx-auto px-[16px] py-[12px]">

            <div class="slider">
                <div>
                    <div class="absolute right-0 bottom-0 left-0 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0">
                        <!--<button-->
                        <!--  type="button"-->
                        <!--  data-te-target="#carouselExampleCaptions"-->
                        <!--  data-te-slide-to="0"-->
                        <!--  data-te-carousel-active-->
                        <!--  class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"-->
                        <!--  aria-current="true"-->
                        <!--  aria-label="Slide 1"></button>-->
                        <!--<button-->
                        <!--  type="button"-->
                        <!--  data-te-target="#carouselExampleCaptions"-->
                        <!--  data-te-slide-to="1"-->
                        <!--  class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"-->
                        <!--  aria-label="Slide 2"></button>-->
                        <!--<button-->
                        <!--  type="button"-->
                        <!--  data-te-target="#carouselExampleCaptions"-->
                        <!--  data-te-slide-to="2"-->
                        <!--  class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"-->
                        <!--  aria-label="Slide 3"></button>-->
                    </div>
                    <div
                        class="relative rounded-[20px] w-full max-h-[25rem] overflow-hidden after:clear-both after:block after:content-['']">
                        <div class="relative float-left -mr-[100%] w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                            style="backface-visibility: hidden;">
                            <img src="{{ asset('frontend/images/2.png') }}" class="block w-full" alt="..." />
                        </div>
                        <!--<div-->
                        <!--  class="relative rounded-[20px] float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"-->
                        <!--  data-te-carousel-item-->
                        <!--  style="backface-visibility: hidden">-->
                        <!--  <img src="{{ asset('frontend/images/2.png') }}" class="block w-full" alt="..." />-->
                        <!--</div>-->
                        <!--<div-->
                        <!--  class="relative rounded-[20px] float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"-->
                        <!--  data-te-carousel-item-->
                        <!--  style="backface-visibility: hidden">-->
                        <!--  <img src="{{ asset('frontend/images/3.png') }}" class="block w-full" alt="..."/>-->
                        <!--</div>-->
                    </div>
                    <button
                        class="absolute top-0 bottom-0 left-0 z-[0] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
                        type="button">
                        <span class="inline-block h-8 w-8">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </span>
                        <span
                            class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Previous</span>
                    </button>
                    <button
                        class="absolute top-0 bottom-0 right-0 z-[0] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
                        type="button">
                        <span class="inline-block h-8 w-8">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </span>
                        <span
                            class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Next</span>
                    </button>
                </div>


            </div>
        </div>
    </div>


    {{-- The commented codes are important code dont remove this code this code can be reused --}}


    {{-- <div class="card-slider max-w-screen-xl mx-auto px-[16px] py-[12px]">
        <div class="">
            <div class="row p-3">
                <div class="col-lg-12 mx-auto navigation"
                    style="justify-content: space-between; align-items: center;padding-left: 0px">
                    <div class="">
                        <h1 style="font-size: 28px; line-height: 36.4px;" class="Veckans text-left">Veckans extrapriser
                        </h1>
                    </div>

                    <div class="slider-btn">
                        <h3><a href="{{ route('extrapriser') }}">Visa alla</a></h3>

                        <div class="custom-btn">


                        </div>
                    </div>
                </div>
            </div>


            <div id="home-extrapriser" class=" card-slides owl-carousel owl-theme ">



            </div>
        </div>
    </div> --}}
    {{-- 
    @if (\App\Models\Product::where('veckans_extrapriser', 1)->where('status', 'In Stock')->count() > 0)
        <div class="card-slider max-w-screen-xl mx-auto px-[16px] py-[12px]">
            <div class="">
                <div class="row p-3">
                    <div class="col-lg-12 mx-auto navigation"
                        style="justify-content: space-between; align-items: center;padding-left: 0px">
                        <div class="">
                            <h1 style="font-size: 28px; line-height: 36.4px;" class="Veckans text-left">
                                {{ \App\Models\Setting::first()->campaign_name ?? 'veckans extrapriser' }}</h1>
                        </div>

                        <div class="slider-btn">
                            <h3><a href="{{ route('veckans-extrapriser') }}">Visa alla</a></h3>
                        </div>
                    </div>
                </div>

                <div id="veckans-extrapriser-cards-home" class=" card-slides2 owl-carousel owl-theme">
                </div>
            </div>
        </div>
    @endif

    <section class="livshem-cards max-w-screen-xl mx-auto px-[16px] py-[12px]">
        <div class="home-cards px-2">

            <div class="">
                <div class="sort-area">
                    <h1 style="font-size: 28px; line-height: 36.4px;" class="text-left px-0">Vår sortiment</h1>

                    <div class="dropdown sortby-dropdown" id="home-sortby-dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Populärast
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @include('frontend.sortby')
                        </ul>
                        <input type="hidden" id="home_sortby" value="popularity">
                    </div>

                </div>
                <div id="home-all" class="row">


                </div>
            </div>
        </div>
    </section>
    <a class="LoadMore hidden" id="loadMore">Ladda mer</a>



    <div id="home-extrapriser-modal"></div>
    <div id="home-all-modal"></div> --}}
    <!-------------------card-pop-up---------------->
    {{-- The commented codes are important code dont remove this code this code can be reused --}}













    <!--<div class="extrapriser">-->
    {{-- <div class="extrapriser overflow-hidden p-3">
        <div class="row">
            <div class="max-w-screen-xl mx-auto px-[16px] py-[12px]">
                <h1 class="text-left">Extrapriser</h1>
            </div>
        </div>

        <div class="row">

            <!--<div class="col-lg-3" style="padding:55px 0;">-->
            <!--    <div class="filters">-->

            <!--        <div class="filter-1">-->
            <!--            <div class="filter-heading">-->
            <!--                <h3>Markings</h3>-->
            <!--            </div>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish orgin</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Key hole marked</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish bird</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>From sweden</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Meat from sweden</h3>-->
            <!--            </span>-->


            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Ecological</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Demand marked</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish seal</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish seal climate certified</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>ASC</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Fairtrade</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Real deal</h3>-->
            <!--            </span>-->
            <!--        </div>-->

            <!--        <div class="filter-1">-->
            <!--            <div class="filter-heading">-->
            <!--                <h3>Diet</h3>-->
            <!--            </div>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish orgin</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Key hole marked</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish bird</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>From sweden</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Meat from sweden</h3>-->
            <!--            </span>-->


            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Ecological</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Demand marked</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish seal</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish seal climate certified</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>ASC</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Fairtrade</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Real deal</h3>-->
            <!--            </span>-->
            <!--        </div>-->


            <!--        <div class="filter-1">-->
            <!--            <div class="filter-heading">-->
            <!--                <h3>Trademarks</h3>-->
            <!--            </div>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish orgin</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Key hole marked</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish bird</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>From sweden</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Meat from sweden</h3>-->
            <!--            </span>-->


            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Ecological</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Demand marked</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish seal</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Swedish seal climate certified</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>ASC</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Fairtrade</h3>-->
            <!--            </span>-->

            <!--            <span>-->
            <!--                <input type="checkbox">-->
            <!--                <h3>Real deal</h3>-->
            <!--            </span>-->
            <!--        </div>-->

            <!--    </div>-->
            <!--</div>-->

            <div class="">


                <!--<div class="dropdown">-->
                <!--    <button class="btn drop-btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">-->
                <!--      Most popular-->
                <!--    </button>-->
                <!--    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">-->
                <!--      <li><a class="dropdown-item" href="#">Most popular</a></li>-->
                <!--      <li><a class="dropdown-item" href="#">Lowest price</a></li>-->
                <!--      <li><a class="dropdown-item" href="#">Compression price</a></li>-->
                <!--      <li><a class="dropdown-item" href="#">Name</a></li>-->
                <!--      <li><a class="dropdown-item" href="#">Newest</a></li>-->
                <!--    </ul>-->
                <!--  </div>-->


                <div class="home-cards max-w-screen-xl mx-auto px-[16px] py-[12px]">
                    <div class="">
                        <div id="extrapriser-cards" class="row px-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!--</div>-->



    <div class="max-w-7xl mx-auto p-4" id="my_home_breadcrumb" style="display: none">
        <div class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex flex-wrap items-center space-x-1 md:space-x-3 my_home_breadcrumb_container">
                <li class="inline-flex items-center">
                    <a href="/"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Hem
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="http://localhost:8000/product/category?category=5"
                            class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Fisk
                            &amp; skaldjur</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="http://localhost:8000/product/sub_cat/23"
                            class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Fisk</a>
                    </div>
                </li>
            </ol>
        </div>

    </div>

    <section class="fruit-and-vegitable">
        <div class="max-w-7xl mx-auto px-3">
            <div class="row">


                <div class="main-heading">
                    <h1 class="text-left title-home-page">{{ isset($title) ? $title : 'Denna veckans erbjudande' }}</h1>
                </div>

                <!--<div class="filter mb-3">-->
                <!--  <a data-bs-toggle="offcanvas" href="#filters" role="button" aria-controls="offcanvasExample">Filter</a>-->
                <!--</div>-->
            </div>
        </div>
    </section>


    <section class="card-filter overflow-hidden">
        <div class=" max-w-7xl mx-auto px-3 py-4">

            <div class="row" style="margin-top: 10px;position: relative">


                <div class="col-md-3">
                    <div class="category-filter">
                        <div class="dropdown sortby-dropdown" id="category-sortby-dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Populärast
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @include('frontend.sortby')
                            </ul>
                            <input type="hidden" id="category_sortby" value="popularity">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="catagories col-lg-3 d-none d-lg-block home-catagorie-section">
                    {{-- @foreach ($categories as $item)
                        @php
                            $url = route('api.home.category', [$item->id]);

                        @endphp
                        <a data-category-id="{{ $item->id }}" class="home-category-btn Categories-btn">{{ $item->name }} <i
                                class="bi bi-chevron-right"></i></a>
                    @endforeach --}}

                </div>
                {{-- <div class="row col-12 col-lg-9 mx-auto" id="home-category"> --}}
                <div class="home-category-page-items row col-12 col-lg-9 mx-auto" id="home-extrapriser-cards">
                    {{-- <div class="LoadCategory row " id="LoadCategory"> --}}


                </div>
                <div class="col-lg-3">

                </div>
                {{-- <div class="col-12 col-lg-9 mx-auto">
                    <div style="text-align:center">
                        <a class="btn btn-success my-4 LoadMore hidden" id="CategoryLoadMore"
                            data-id="{{ $category[0]->id }}">Ladda mer</a>
                    </div>
                    @if ($item->getcategory)
                        <input type="hidden" id="page-id" value="{{ $item->getcategory->id }}">
                    @endif
                </div> --}}

                <a class="btn btn-success my-4 col-12 col-lg-9 mx-auto LoadMore home-category-load-more-btn hidden"
                    id="HomeCategoryLoadMore">Ladda mer</a>
            </div>
        </div>

        </div>


        <div id="category-modal"></div>


        <div id="extrapriser-modal"></div>





        <script>
            function clickToOpen(id, type) {
                $.ajax({
                    type: "get",
                    url: "{{ route('product.display') }}",
                    data: {
                        id: id,
                        type: type,
                    },
                    success: function(data) {

                        document.getElementById('product_bg').classList.remove('hidden');
                        document.getElementById('openProduct').classList.remove('hidden');
                        const fixedOffPrice = document.getElementById('fixed_off_price');
                        const off_price_bg = document.getElementById('off_price_bg');
                        const fixedProductImage = document.getElementById('fixedProductImage');
                        const fixedname = document.getElementById("fixed_name");
                        const fixedWeight = document.getElementById("fixed_weight");
                        const fixedOffPricein = document.getElementById("fixed_off_price_in");
                        const fixedPrice = document.getElementById("fixed_price");
                        const fixedAdress = document.getElementById("fixed_address");
                        const fixedPerProduct = document.getElementById("fixed_max");
                        const fixedComparePrice = document.getElementById("fixed_price_compare");
                        const fixedoffbtnPrice = document.getElementById("fixed_off_price_btn");
                        const fixedbtnPrice = document.getElementById("fixed_price_btn");
                        const DisplayCart = document.getElementById("displaycart");
                        const next_product = document.getElementById("next_product");
                        const pre_product = document.getElementById("pre_product");

                        fixedOffPrice.innerHTML = data.product.discount_price;
                        fixedProductImage.src = data.product.image ? data.product.image.path :
                            'frontend/images/no-item.png';
                        fixedname.innerText = data.product.name;
                        fixedWeight.innerText = data.product.weight;
                        fixedOffPricein.innerHTML = data.product.discount_price;
                        fixedPrice.innerHTML = data.product.price <= 0 ? data.discount_price : '<s>' + data.product
                            .price + ':-</s>';
                        fixedAdress.innerHTML = data.product.origin;
                        fixedPerProduct.innerHTML = data.product.price_per_item;
                        fixedComparePrice.innerHTML = data.product.compare_price;
                        fixedoffbtnPrice.innerHTML = data.product.discount_price;
                        fixedbtnPrice.innerHTML = data.product.price <= 0 ? data.discount_price : '<s>' + data
                            .product.price + ':-</s>';
                        if (data.product.discount_price == 0 || data.product.discount_price == null) {
                            off_price_bg.classList.add('hidden');
                            fixedOffPrice.classList.add('hidden');
                            fixedOffPricein.classList.add('hidden');
                            fixedoffbtnPrice.classList.add('hidden');
                        } else {
                            off_price_bg.classList.remove('hidden');
                            fixedOffPrice.classList.remove('hidden');
                            fixedOffPricein.classList.remove('hidden');
                            fixedoffbtnPrice.classList.remove('hidden');
                        }
                        if (data.next == null) {
                            next_product.classList.add('invisible');
                        } else {
                            next_product.classList.remove('invisible');

                        }
                        if (data.pre == null) {
                            pre_product.classList.add('invisible');
                        } else {
                            pre_product.classList.remove('invisible');

                        }

                        let result = DisplayCart.href.replace(":id", data.product.id);
                        DisplayCart.href = result;
                        next_product.setAttribute("onclick", "clickToOpen(" + data.next + ",'" + data.product
                            .items_status + "')");
                        pre_product.setAttribute("onclick", "clickToOpen(" + data.pre + ",'" + data.product
                            .items_status + "')");
                        // console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        </script>
        <script>
            function Product_ajax() {

                var product_popular = document.getElementById('product_popular').value;
                $.ajax({
                    type: "get",
                    url: "{{ route('index') }}",
                    data: {
                        data: product_popular
                    },
                    success: function(data) {
                        document.getElementById('content_section').innerHTML = data;
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });

            }
        </script>
    @endsection
    @section('js')
    @endsection

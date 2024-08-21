<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <title>Livshem - billigt är bäst</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/index.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="{{ asset('frontend/js/index.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tailwindcss.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.css') }}" />
    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/toastr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/home.card.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/livshem_cart.png') }}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .main-mobile-nav {
            transform: translateX(-100%) !important;
        }

        .main-nav {
            transform: translateX(0%);
            width: 100%;
            position: absolute;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .first-selected-nav {
            transform: translateX(100%);
            width: 100%;
            position: absolute;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .second-selected-nav {
            transform: translateX(200%);
            width: 100%;
            position: absolute;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .first-previous-nav,
        .second-previous-nav {
            padding: 30px;
            text-align: left;
        }

        @-webkit-keyframes slide {
            100% {
                left: 0;
            }
        }

        @keyframes slide {
            100% {
                left: 0;
            }
        }

        .filter-box-footer button {
            justify-content: center;
            display: flex;
            background-color: rgb(21 128 61);
            color: rgb(255, 255, 255);
            text-decoration: none;
            margin: 20px 50px;
            padding: 10px 20px;
            border-radius: 50px;
        }
    </style>
    <style>
        * {
            font-family: 'livshem-font';
        }

        .swiper-slide label {
            width: 100%;
        }

        .select-day-card {
            height: 8rem;
        }

        /* General Styling */
        .loader-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 1rem;
        }

        html,
        body {
            /* margin: 0; */
            height: 100%;
        }

        body {
            display: grid;
            /* grid-gap: 10px; */
            grid-template-columns: 1fr;
            grid-template-areas: "main" "footer";
            grid-template-rows: 1fr 318px;
        }

        .main-content {
            grid-area: main;
        }

        footer {
            grid-area: footer;
        }

        @media (max-width: 567px) {
            h1 {
                font-size: 7vw;
                text-align: center;
            }
        }

        .sort-area {
            display: flex;
            justify-content: space-between;
        }

        .home-sortby {
            width: 14%;
            border-radius: 25px;
        }

        .home-sortby option {}

        .sortby-dropdown {
            margin-right: 0px;
        }

        .sortby-dropdown button {
            color: #000 !important;
            /* border-radius: 20px; */
            padding: 5px 25px;
            background: #FFF !important;
        }

        .sortby-dropdown ul {}

        .sortby-dropdown ul li {}

        .sortby-dropdown ul li a {
            color: #000 !important;
        }

        .sortby-dropdown ul li a:hover {
            background: none;
        }

        .sortby-dropdown .dropdown-menu::before {
            border-bottom: 10px solid #fff;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            content: "";
            display: block;
            height: 0;
            position: absolute;
            right: 60px;
            top: -10px;
            width: 0;
        }

        .category-filter {
            position: absolute;
            right: 15px;
            top: -33px;
        }

        .swiper-custom {
            color: #268639 !important;
            font-weight: bold;
        }

        .swiper-custom::after {
            font-size: 30px !important;
        }

        @media(max-width:450px) {
            .category-filter {
                position: absolute;
                right: 15px;
                top: -33px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
{{--

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FVRLL9N46K"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-FVRLL9N46K');
    </script>
--}}

</head>

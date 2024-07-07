<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Livshem - billigt är bäst</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/index.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="{{ asset('frontend/js/index.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tailwindcss.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">-->

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

</head>

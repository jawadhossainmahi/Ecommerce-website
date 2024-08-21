<script src="{{ asset('app-assets/js/jquery.js') }}"></script>
<script src="{{ asset('app-assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
{{-- <script src="{{ asset('frontend/js/twitter-bootstrap.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>


<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/script.js') }}" type="module"></script>

@yield('js')
<script>
    @if ($errors->any())

        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.options.timeOut = 10000;
        toastr.error("Fyll i alla obligatoriska fält.");
    @endif
    @if (Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('message') }}");
    @endif
    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('danger'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.danger("{{ session('danger') }}");
    @endif


    let owlCarousel = $(".card-slides ").owlCarousel({
        loop: false,
        margin: 10,
        autoplay: false,
        autoHeight: true,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 2,
            },
            576: {
                items: 3,
            },
            767: {
                items: 4,
            },
            1200: {
                items: 6,
            },
            1400: {
                items: 6,
            },
        },
    });

    $('.time-card-slider').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            300: {
                items: 2
            },
            400: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    });
    // Vekans expriser
    let owlCarousel2 = $(".card-slides2").owlCarousel({
        loop: false,
        margin: 10,
        autoplay: false,
        autoHeight: true,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 2,
            },
            576: {
                items: 3,
            },
            767: {
                items: 4,
            },
            1200: {
                items: 6,
            },
            1400: {
                items: 6,
            },
        },
    });
</script>

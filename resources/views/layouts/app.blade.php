<!doctype html>
<html lang="en">

<!-- Mirrored from themesbrand.com/skote/layouts/vertical/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Aug 2020 11:26:29 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Sumbar Mountain Advanture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" />
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css')}}" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />


    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
     <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />


    <livewire:styles />



    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>

<body data-sidebar="white">

    <div id="layout-wrapper">

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        window.addEventListener('swal',function(e){
            Swal.fire(e.detail);
        });
    </script>


    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('assets/js/pages/lightbox.init.js')}}"></script>

    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>



    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
    <livewire:scripts />
</body>

<!-- Mirrored from themesbrand.com/skote/layouts/vertical/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Aug 2020 11:26:29 GMT -->
</html>

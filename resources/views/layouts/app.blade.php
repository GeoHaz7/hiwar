<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/DataTables/datatables.min.css') }}" />


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Dropzone -->
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('vendor/css/dropzone.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/style.css') }}" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div class="page-wrapper chiller-theme toggled ">

            @include('layouts.sideBar')

            <main class="mainContent toggled ">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ url('assets/DataTables/datatables.min.js') }}"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    {{-- ckeditor --}}
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Dropzone --}}
    <script src="{{ url('vendor/js/dropzone.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    <script>
        jQuery(function($) {

            $(".sidebar-dropdown > a").click(function() {
                $(".sidebar-submenu").slideUp(200);
                if (
                    $(this)
                    .parent()
                    .hasClass("active")
                ) {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .parent()
                        .removeClass("active");
                } else {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .next(".sidebar-submenu")
                        .slideDown(200);
                    $(this)
                        .parent()
                        .addClass("active");
                }
            });

            $("#close-sidebar").click(function() {
                $(".page-wrapper").removeClass("toggled");
                $(".mainContent").removeClass("toggled");
            });
            $("#show-sidebar").click(function() {
                $(".page-wrapper").addClass("toggled");
                $(".mainContent").addClass("toggled");
            });




        });
    </script>


    @yield('js')
</body>

</html>

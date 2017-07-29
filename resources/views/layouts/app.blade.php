<!DOCTYPE html>
<html class="no-focus"> 
    <head>
        <meta charset="utf-8">

        <title>{!! config('app.name', 'Laravel') !!}</title>
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{!! csrf_token() !!}">
        <meta name="description" content="OneUI - Admin Dashboard Template & UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        {{-- Icons --}}
        {{-- The following icons can be replaced with your own, they are used by desktop and mobile browsers --}}
        <link rel="shortcut icon" href="{!! ripple_asset('/img/favicons/favicon.png') !!}">

        <link rel="icon" type="image/png" href="{!! ripple_asset('/img/favicons/favicon-16x16.png') !!}" sizes="16x16">
        <link rel="icon" type="image/png" href="{!! ripple_asset('/img/favicons/favicon-32x32.png') !!}" sizes="32x32">
        <link rel="icon" type="image/png" href="{!! ripple_asset('/img/favicons/favicon-96x96.png') !!}" sizes="96x96">
        <link rel="icon" type="image/png" href="{!! ripple_asset('/img/favicons/favicon-160x160.png') !!}" sizes="160x160">
        <link rel="icon" type="image/png" href="{!! ripple_asset('/img/favicons/favicon-192x192.png') !!}" sizes="192x192">

        <link rel="apple-touch-icon" sizes="57x57" href="{!! ripple_asset('/img/favicons/apple-touch-icon-57x57.png') !!}">
        <link rel="apple-touch-icon" sizes="60x60" href="{!! ripple_asset('/img/favicons/apple-touch-icon-60x60.png') !!}">
        <link rel="apple-touch-icon" sizes="72x72" href="{!! ripple_asset('/img/favicons/apple-touch-icon-72x72.png') !!}">
        <link rel="apple-touch-icon" sizes="76x76" href="{!! ripple_asset('/img/favicons/apple-touch-icon-76x76.png') !!}">
        <link rel="apple-touch-icon" sizes="114x114" href="{!! ripple_asset('/img/favicons/apple-touch-icon-114x114.png') !!}">
        <link rel="apple-touch-icon" sizes="120x120" href="{!! ripple_asset('/img/favicons/apple-touch-icon-120x120.png') !!}">
        <link rel="apple-touch-icon" sizes="144x144" href="{!! ripple_asset('/img/favicons/apple-touch-icon-144x144.png') !!}">
        <link rel="apple-touch-icon" sizes="152x152" href="{!! ripple_asset('/img/favicons/apple-touch-icon-152x152.png') !!}">
        <link rel="apple-touch-icon" sizes="180x180" href="{!! ripple_asset('/img/favicons/apple-touch-icon-180x180.png') !!}">
        {{-- END Icons --}}

        {{-- Stylesheets --}}
        {{-- Web fonts --}}
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link href="{!! ripple_asset('css/app.css') !!}" rel="stylesheet">
        {{-- Page JS Plugins CSS go here --}}

        {{-- OneUI CSS framework --}}
        <link rel="stylesheet" id="css-main" href="{!! ripple_asset('/css/oneui.min.css') !!}">
        <link rel="stylesheet" id="css-theme" href="{!! ripple_asset('/css/themes/amethyst.min.css') !!}">

        {{-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: --}}
        {{-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> --}}
        {{-- END Stylesheets --}}
    </head>
    <body>
        {{-- Page Container --}}
        {{--
            Available Classes:

            'sidebar-l'                  Left Sidebar and right Side Overlay
            'sidebar-r'                  Right Sidebar and left Side Overlay
            'sidebar-mini'               Mini hoverable Sidebar (> 991px)
            'sidebar-o'                  Visible Sidebar by default (> 991px)
            'sidebar-o-xs'               Visible Sidebar by default (< 992px)

            'side-overlay-hover'         Hoverable Side Overlay (> 991px)
            'side-overlay-o'             Visible Side Overlay by default (> 991px)

            'side-scroll'                Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (> 991px)

            'header-navbar-fixed'        Enables fixed header
        --}}
        <div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
            
            {{-- Right Sidebar --}}
            @include('Ripple::layouts.right-sidebar')
            
            {{-- Left Sidebar --}}
            @include('Ripple::layouts.left-sidebar')
            
            {{-- Header --}}
            @include('Ripple::layouts.header')

            {{-- Main Container --}}
            <main id="main-container">
                
                @yield('page-content')
                
            </main>
            {{-- END Main Container --}}
            
            {{-- Footer --}}
            @include('Ripple::layouts.footer')

        </div>
        {{-- END Page Container --}}

        {{-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js --}}
        <script src="{!! ripple_asset('/js/app.js') !!}"></script>
        <script src="{!! ripple_asset('/js/oneui.min.js') !!}"></script>

        {{-- Page JS Plugins + Page JS Code --}}
    </body>
</html>
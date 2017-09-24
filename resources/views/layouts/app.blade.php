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
        {{-- END Icons --}}

        {{-- Stylesheets & Web fonts --}}
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link href="{!! ripple_asset('/css/app.css') !!}" rel="stylesheet">
        @include('Ripple::layouts.links')
        @jsRoutes
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
        <div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed sidebar-mini">

            {{-- Right Sidebar --}}
            @include('Ripple::layouts.right-sidebar')

            {{-- Left Sidebar --}}
            @include('Ripple::layouts.left-sidebar')

            {{-- Header --}}
            @include('Ripple::layouts.header')

            {{-- Main Container --}}
            <main id="main-container" >

                @yield('page-content')

            </main>
            {{-- END Main Container --}}

            {{-- Footer --}}
            @include('Ripple::layouts.footer')

        </div>
        {{-- END Page Container --}}

        {{-- JS Scripts --}}
        <script src="{!! ripple_asset('/js/app.js') !!}"></script>
        <script src="{!! ripple_asset('/js/functions.js') !!}"></script>
        @include('Ripple::layouts.scripts')

    </body>
</html>
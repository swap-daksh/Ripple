<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{!! config('app.name', 'Laravel') !!}</title>
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{!! csrf_token() !!}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Ripple - Admin pane for laravel framework">
        <meta name="author" content="Yash Pal">
        <meta name="robots" content="noindex, nofollow">
        <link rel="icon" type="image/png" href="{!! ripple_asset('/img/favicons/favicon.png') !!}">
        {{-- Stylesheets & Web fonts --}}
        @include('Ripple::layouts.beta-links')
        @jsRoutes
    </head>
    <body class="home">
        <div id="app" class="container-fluid" style="">
            {{-- Header --}}
            @include('Ripple::layouts.beta-header')
            <div class="row" >
                @include('Ripple::layouts.beta-sidebar')
                <main class="clearfix rpl-container col-md-10"> 
                    {{-- Main Container --}}
                    <div class="content-outlet content-wrapper p-0 container-fluid">
                        @include('Ripple::layouts.beta-page-title')
                        @yield('page-content') 
                    </div>
                </main>
            </div>
            @include('Ripple::layouts.beta-footer')
        </div>
        <div class="ripple-loader" id="ripple-loader">
            <img class="loader-img" src="{!! ripple_asset('/img/loaders/flip-circle-google.svg') !!}" alt="">
        </div>
        {{-- JS Scripts --}}
        <script src="{!! ripple_asset('/js/beta-app.js') !!}"></script>
        <script src="{!! ripple_asset('/js/beta-functions.js') !!}"></script>
        @include('Ripple::layouts.beta-scripts')
    </body>
</html>
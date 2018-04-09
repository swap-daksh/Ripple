<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{!! config('app.name', 'Laravel') !!}</title>
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{!! csrf_token() !!}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="OneUI - Admin Dashboard Template & UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        {{-- Stylesheets & Web fonts --}}
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link href="{!! ripple_asset('/css/app.css') !!}" rel="stylesheet">
        @include('Ripple::layouts.links')
        @jsRoutes
    </head>
    <body class="home">
        <div id="app" >
            {{-- Header --}}
            @include('Ripple::layouts.header')
            <main class="clearfix " >
                {{-- Right Sidebar --}}
                @include('Ripple::layouts.left-sidebar')
                {{-- Main Container --}}
                <div class="col-md-10 content-wrapper no-padding">
                    <div class="content-outlet" >
                    @yield('page-content') 
                    </div>
                    @include('Ripple::layouts.footer')
                </div>
                
            </main>
            
        </div>
        {{-- JS Scripts --}}
        <script src="{!! ripple_asset('/js/app.js') !!}"></script>
        <script src="{!! ripple_asset('/js/angular.min.js') !!}"></script>
        <!-- <script src="{!! ripple_asset('/js/vue.js') !!}"></script> -->
        <script src="{!! ripple_asset('/js/functions.js') !!}"></script>
        @include('Ripple::layouts.scripts')
    </body>
</html>








<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{!! config('app.name', 'Laravel') !!}</title>
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{!! csrf_token() !!}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Ripple - Admin panel for laravel framework">
        <meta name="author" content="Yash Pal">
        <meta name="robots" content="noindex, nofollow">
        <link rel="icon" type="image/png" href="{!! ripple_asset('/img/favicons/favicon.png') !!}">
        {{-- Stylesheets & Web fonts --}}
        <link rel="stylesheet" href="{!! ripple_asset('/css/beta-app.css') !!}" rel="stylesheet">
        @jsRoutes
        <style>
                html, body {
                height: 100%;
                }

                body {
                display: -ms-flexbox;
                display: -webkit-box;
                display: flex;
                -ms-flex-align: center;
                -ms-flex-pack: center;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
                }

                .form-signin {
                width: 100%;
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
                }
                .form-signin .checkbox {
                font-weight: 400;
                }
                .form-signin .form-control {
                position: relative;
                box-sizing: border-box;
                height: auto;
                padding: 10px;
                font-size: 16px;
                }
                .form-signin .form-control:focus {
                z-index: 2;
                }
                .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
                }
                .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                }

        </style>
    </head>
    <body>
        <form class="form-signin" method="post" action="{!! route('Ripple::adminLoginAttempt') !!}">
            {!! csrf_field() !!}
            <div class="text-center mb-4">
                <a class="navbar-brand" href="{!! route('Ripple::dashboard') !!}"><i class="fab fa-laravel fa-2x"></i> Ripple</a>
                <h1 class="h3 mb-3 font-weight-normal">Login</h1>
            </div>
            
            @if ($errors->has('email'))
                <div class="alert alert-danger"><strong>{{ $errors->first('email') }}</strong></div>
            @endif
            @if ($errors->has('password'))
                <div class="alert alert-danger"><strong>{{ $errors->first('password') }}</strong></div>
            @endif

            <div class="form-label-group">
                <input id="inputEmail" class="form-control" name="email" placeholder="Email address" required="" autofocus="" type="email">
            </div>
            <div class="form-label-group">
                <input id="inputPassword" class="form-control" name="password" placeholder="Password" required="" type="password">

            </div>


            <div class="custom-control mb-3 custom-checkbox">
                <input type="checkbox" name="remember" class="custom-control-input" id="rememberme">
                <label class="custom-control-label" for="rememberme">Remember me</label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted text-center">© {!! date('Y')- 1 !!}-{!! date('Y') !!}</p>
        </form>
        <script src="{!! ripple_asset('/js/beta-app.js') !!}"></script>
    </body>
</html>
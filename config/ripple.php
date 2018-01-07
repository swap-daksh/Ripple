<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Controllers config
      |--------------------------------------------------------------------------
      |
      | Here you can specify ripple controller settings such as namespace
      |
     */
    'controllers' => [
        'namespace' => 'YPC\\Ripple\\Http\\Controllers',
    ],
    /*
      |----------------------------------------------------------------------------
      |	Assets Config
      |----------------------------------------------------------------------------
      |
      | Here you can specify ripple assets path
      |
     */
    'assets_url' => '/vendor/ypc/ripple/public',
    /*
      |----------------------------------------------------------------------------
      |	Facades Aliases
      |----------------------------------------------------------------------------
      |
      | Here you can specify ripple Facades Aliases
      |
     */
    'aliases' => [
        'Ripple' => YPC\Ripple\Support\Facades\Ripple::class,
    ],
    /*
      |----------------------------------------------------------------------------
      |	Facades Classes
      |----------------------------------------------------------------------------
      |
      | Here you can specify ripple Facades Classes
      |
     */
    'facades' => [
        'ripple' => \YPC\Ripple\Ripple::class
    ],
    /*
      |----------------------------------------------------------------------------
      |	Middlewares Classes
      |----------------------------------------------------------------------------
      |
      | Here you can specify ripple Middleware Classes
      |
     */
    'middlewares' => [
        "hasBreadEnabled" => \YPC\Ripple\Http\Middleware\HasBreadEnabled::class
    ],
];

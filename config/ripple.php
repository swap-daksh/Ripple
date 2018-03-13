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
        'Database' => YPC\Ripple\Support\Facades\Database::class,
        'Bread' => YPC\Ripple\Support\Facades\Bread::class,
        'Relation' => YPC\Ripple\Support\Facades\Relation::class,
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
        'ripple' => \YPC\Ripple\Support\Core\Ripple::class,
        'bread' => \YPC\Ripple\Support\Core\Bread::class,
        'relation' => \YPC\Ripple\Support\Core\Relation::class,
        'database' => \YPC\Ripple\Support\Database\Database::class,
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
        "hasBreadEnabled" => \YPC\Ripple\Http\Middleware\HasBreadEnabled::class,
        "RedirectIfNotAdmin"=> \YPC\Ripple\Http\Middleware\RedirectIfNotAdmin::class,
    ],
];

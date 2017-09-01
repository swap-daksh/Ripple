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
        'namespace' => 'GitLab\\Ripple\\Http\\Controllers',
    ],
    /*
      |----------------------------------------------------------------------------
      |	Assets Config
      |----------------------------------------------------------------------------
      |
      | Here you can specify ripple assets path
      |
     */
    'assets_url' => '/vendor/gitlab/ripple/public',
    /*
      |----------------------------------------------------------------------------
      |	Aliases
      |----------------------------------------------------------------------------
      |
      | Here you can specify ripple Facades
      |
     */
    'aliases' => [
        'Ripple' => GitLab\Ripple\Support\Facades\Ripple::class,
    ],
];

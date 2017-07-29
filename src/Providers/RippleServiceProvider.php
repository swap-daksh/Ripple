<?php

namespace GitLab\Ripple\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class RippleServiceProvider extends ServiceProvider {

  /**
  | Ripple Commands
  */
  protected $commands = [
    'GitLab\Ripple\Commands\RippleInstall',
    'GitLab\Ripple\Commands\RippleCssJs'
  ];

  /**
  * Bootstrap the application services.
  *
  * @return void
  */
  public function boot() {

    //Load routes from "routes/web.php"...
    $this->loadRoutesFrom(realpath(__DIR__.'/../../routes/web.php'));

    //Load Package Views...
    $this->loadViewsFrom(realpath(__DIR__.'/../../resources/views'), 'Ripple');

    //Publishable Assets...
    $this->publishes([realpath(__DIR__.'/../../resources/assets')=>public_path('vendor/etu/ripple/assets/')], 'assets');

    //Publishable Config...
    $this->publishes([realpath(__DIR__.'/../../config')=>config_path('/')], 'config');

    //Publishable Database...
    $this->publishes([realpath(__DIR__.'/../../database/migrations')=>database_path('/migrations')], 'database');
    
    //Publishable Css...
    $this->publishes([realpath(__DIR__.'/../../resources/assets/css')=>public_path('vendor/etu/ripple/assets/css/')], 'css');
    
    //Publishable Js...
    $this->publishes([realpath(__DIR__.'/../../resources/assets/js')=>public_path('vendor/etu/ripple/assets/js/')], 'js');


  }

  /**
  * Register the application services.
  *
  * @return void
  */
  public function register() {

    $this->commands($this->commands);
    /*$this->commands([
      GitLab\Ripple\Commands\RippleInstall::class,
    ]);*/
  }

} 

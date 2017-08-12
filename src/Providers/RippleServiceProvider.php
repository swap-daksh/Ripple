<?php

namespace GitLab\Ripple\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use GitLab\Ripple\Support\Blade\RippleBlade;

class RippleServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {

        # Load routes from "routes/web.php"...
        $this->loadRoutesFrom(realpath(__DIR__ . '/../../routes/web.php'));

        # Load Package Views...
        $this->loadViewsFrom(realpath(__DIR__ . '/../../resources/views'), 'Ripple');

        # Load Ripple Publishes
        $this->loadPublishableResources();

        # Load Ripple Blade Directives
        $this->loadBladeDirectives();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        #Register Ripple commands
        $this->loadCommands();

        #Register Ripple Facade Class to app
        $this->app->bind('ripple', \GitLab\Ripple\Ripple::class);

#Load All Aliases to app
        $this->loadAlias();
    }

    /**
     * Register all aliases from configuration
     */
    public function loadAlias() {
        $loadAlias = AliasLoader::getInstance();
        if (!is_null(config('ripple.aliases'))):
            foreach (config('ripple.aliases') as $abstract => $class):
                $loadAlias->alias($abstract, $class);
            endforeach;
        endif;
    }

    public function loadCommands() {
        $this->commands([
            \GitLab\Ripple\Commands\RippleInstall::class,
            \GitLab\Ripple\Commands\RippleCssJs::class
        ]);
    }

    public function loadPublishableResources() {
        $publishes = [
            #Publishable Assets
            "assets" => [realpath(__DIR__ . '/../../public') => public_path('vendor/gitlab/ripple/public/')],
            #Publishable Configuration
            "config" => [realpath(__DIR__ . '/../../config') => config_path('/')],
            #Publishable Database
            "database" => [realpath(__DIR__ . '/../../database/migrations') => database_path('/migrations')],
            #Publishable CSS
            "css" => [realpath(__DIR__ . '/../../public/css') => public_path('vendor/gitlab/ripple/public/css/')],
            #Publishable JS
            "js" => [realpath(__DIR__ . '/../../public/js') => public_path('vendor/gitlab/ripple/public/js/')]
        ];
        foreach ($publishes as $tag => $paths):
            $this->publishes($paths, $tag);
        endforeach;
    }

    function loadBladeDirectives() {
        $RippleBlade = new RippleBlade();
        foreach ((new \ReflectionClass(RippleBlade::class))->getMethods() as $BladeMethod) {
            $RippleBlade->{$BladeMethod->name}();
        }
    }

}

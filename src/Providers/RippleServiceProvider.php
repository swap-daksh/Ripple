<?php

namespace YPC\Ripple\Providers;

use YPC\Ripple\Support\Blade\RippleBlade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class RippleServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $Router)
    {
        #Setting up default string length
        Schema::defaultStringLength(191);

        #Load Ripple Helpers
        $this->loadHelpers();
        
        #Load routes from "routes/web.php"...
        $this->loadRoutesFrom(realpath(__DIR__ . '/../../routes/web.php'));

        # Load Migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        #Load Package Views...
        $this->loadViewsFrom(realpath(__DIR__ . '/../../resources/views'), 'Ripple');

        #Load Ripple Publishes
        $this->loadPublishableResources();

        #Load Ripple Blade Directives
        $this->loadBladeDirectives(new RippleBlade());

        #Register Doctorine Custom Datatypes
        $this->registerCustomDataTypes();

        #Load All Middlewares to app
        $this->loadMiddlewares($Router);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        #Register Ripple commands
        $this->loadCommands();

        #Register Ripple Facades to app
        $this->bindFacades();

        #Load All Aliases to app
        $this->loadAlias();
    }

    /**
     * Register Middlewares to the admin panel
     */
    public function loadMiddlewares(Router $Router)
    {
        foreach (config('ripple.middlewares', []) as $name => $class) {
            if (app()->version() >= 5.4) {
                $Router->aliasMiddleware($name, $class);
            } else {
                $Router->middleware($name, $class);
            }
        }
    }

    /**
     * Register all aliases from configuration.
     */
    public function loadAlias()
    {
        $loadAlias = AliasLoader::getInstance();
        foreach (config('ripple.aliases', []) as $abstract => $class) :
            $loadAlias->alias($abstract, $class);
        endforeach;
    }

    public function bindFacades()
    {
        foreach (config('ripple.facades', []) as $facade => $class) :
            $this->app->bind($facade, $class);
        endforeach;
    }

    public function loadCommands($commands = array())
    {
        #Load All Commands
        foreach (glob(__DIR__ . '/../Commands/*.php') as $command) :
            $commands[] = '\YPC\Ripple\Commands\\' . basename($command, '.php');
        endforeach;
        #Register All Commands
        $this->commands($commands);
    }

    public function loadPublishableResources()
    {
        
        $publishes = [
            #Publishable Assets
            'assets' => [realpath(__DIR__ . '/../../public') => public_path('vendor/ypc/ripple/public/')],
            #Publishable Images
            'images' => [realpath(__DIR__ . '/../../public/img') => public_path('vendor/ypc/ripple/public/img/')],
            #Publishable Configuration
            'config' => [realpath(__DIR__ . '/../../config') => config_path('/')],
            #Publishable Database
            'database' => [realpath(__DIR__ . '/../../database/migrations') => database_path('/migrations')],
            #Publishable CSS
            'css' => [realpath(__DIR__ . '/../../public/css') => public_path('vendor/ypc/ripple/public/css/')],
            #Publishable JS
            'js' => [realpath(__DIR__ . '/../../public/js') => public_path('vendor/ypc/ripple/public/js/')],
        ];
        foreach ($publishes as $tag => $paths) :
            $this->publishes($paths, $tag);
        endforeach;
    }

    public function loadBladeDirectives($RippleBlade)
    {
        foreach ((new \ReflectionClass(RippleBlade::class))->getMethods() as $BladeMethod) {
            $RippleBlade->{$BladeMethod->name}();
        }
    }

    public function loadHelpers()
    {
        foreach (glob(__DIR__ . '/../Support/Helpers/*.php') as $file) {
            require_once realpath($file);
        }
    }

    public function registerCustomDataTypes()
    {
        foreach (\YPC\Ripple\Support\Database\DataTypes\Type::$register as $datatype => $class) :
            \Doctrine\DBAL\Types\Type::addType($datatype, $class);
        endforeach;
    }
}

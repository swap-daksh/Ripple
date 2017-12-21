<?php

namespace YPC\Ripple\Support\Router;

use Illuminate\Routing\Router;

/**
 * Description of JavascriptRouter.
 *
 * @author Yash Pal
 */
class JsRouter
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function jsRoutes()
    {
        return $this->script(self::routes(), rtrim(config('app.url'), '/'));
    }

    public function script($routes, $url)
    {
        return <<<EOT
        <script type="text/javascript">
            var routes = JSON.parse('$routes'), baseUrl = '$url';
            function route(name, params = {}, absolute = true){
                var url = (routes[name].domain || baseUrl).replace(/\/+$/, '')+'/';
                url = (absolute ? url : '') + routes[name].uri;

                return url.replace(/\{([^}]+)\}/gi, function (param) {
                    var key = param.replace(/\{|\}/gi, '');
                    if (params[key] === undefined) {
                        throw 'Error: "' + key + '" parameter is required for route "' + name + '"';
                    }
                    return params[key];
                })
            }
            if (typeof exports !== 'undefined') { exports.route = route }
        </script>
EOT;
    }

    public function routes()
    {
        return (string) collect($this->router->getRoutes()->getRoutesByName())->map(function ($Route) {
            return collect($Route)
                                    ->only('uri', 'methods')
                                    ->put('domain', $Route->domain());
        });
    }
}

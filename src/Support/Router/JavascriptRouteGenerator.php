<?php

namespace GitLab\Ripple\Support\Router;

use Illuminate\Routing\Router;

/**
 * Description of JavascriptRouteGenerator
 *
 * @author Yash Pal
 */
class JavascriptRouteGenerator {

    private $router;
    public $routes;

    public function __construct(Router $router) {
        $this->router = $router;
    }

    public function generate() {
        $json = (string) $this->nameKeyedRoutes();
        $appUrl = rtrim(config('app.url'), '/') . '/';
        $routeFunction = "";
//        $routeFunction = file_get_contents(__DIR__ . '/js/route.js');
        return <<<EOT
<script type="text/javascript">
    var namedRoutes = JSON.parse('$json'),
        baseUrl = '$appUrl';
                console.log(namedRoutes);
    $routeFunction
</script>
EOT;
    }

    public function nameKeyedRoutes() {
        dd($this->router);
        return collect($this->router->getRoutes()->getRoutesByName())
                        ->map(function ($route) {
                            return collect($route)->only(['uri', 'methods'])
                                    ->put('domain', $route->domain());
                        });
    }

}

<?php

namespace GitLab\Ripple\Support\Blade;

use Illuminate\Support\Facades\Blade;
use GitLab\Ripple\Support\Router\JsRouter;

class RippleBlade {

    public function jsRoutes() {
        Blade::directive('jsRoutes', function () {
            return "<?= app('" . JsRouter::class . "')->jsRoutes(); ?>";
        });
    }

}

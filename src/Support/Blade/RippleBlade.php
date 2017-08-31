<?php

namespace GitLab\Ripple\Support\Blade;

use GitLab\Ripple\Support\Router\JsRouter;
use Illuminate\Support\Facades\Blade;

class RippleBlade
{
    public function jsRoutes()
    {
        Blade::directive('jsRoutes', function () {
            return "<?= app('".JsRouter::class."')->jsRoutes(); ?>";
        });
    }
}

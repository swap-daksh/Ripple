<?php

namespace YPC\Ripple\Http\Controllers;

class RouteController extends Controller
{

    public function routeIndex()
    {
        return view('Ripple::routes.routeIndex');
    }

}

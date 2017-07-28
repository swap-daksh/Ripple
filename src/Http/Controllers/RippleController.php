<?php

namespace ETU\Ripple\Http\Controllers;

use Illuminate\Http\Request;

class RippleController extends Controller {

    public function index() {
        dd(ripple_asset('/js/jquery.js'));
        dd('hureee We are in Index Method');
    }

    public function dashboard() {
        return view('Ripple::dashboard');
    }

    public function settings() {
        return view('Ripple::settings.settings');
    }

}

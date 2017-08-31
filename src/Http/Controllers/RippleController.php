<?php

namespace GitLab\Ripple\Http\Controllers;

class RippleController extends Controller
{
    public function index()
    {
        dd(ripple_asset('/js/jquery.js'));
        dd('hureee We are in Index Method');
    }

    public function dashboard()
    {
//        dd('This is Ripple Dashboard');
        return view('Ripple::dashboard');
    }

    public function settings()
    {
        return view('Ripple::settings.settings');
    }
}

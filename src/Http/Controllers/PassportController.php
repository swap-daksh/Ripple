<?php

namespace YPC\Ripple\Http\Controllers;

class PassportController extends Controller
{


    public function appPassport()
    {
        return view('Ripple::passport.passportIndex');
    }
}

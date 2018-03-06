<?php

namespace YPC\Ripple\Http\Controllers;


class PassportController extends Controller{


    public function AppPassport(){
        return view('Ripple::passport.passportIndex');
    }
}
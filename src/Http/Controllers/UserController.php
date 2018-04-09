<?php

namespace YPC\Ripple\Http\Controllers;

class UserController extends Controller
{

    public function userIndex()
    {
        return view('Ripple::users.userIndex');
    }

    public function userProfile()
    {
        return view('Ripple::users.userProfile');
    }
}

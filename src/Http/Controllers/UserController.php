<?php

namespace GitLab\Ripple\Http\Controllers;

class UserController extends Controller
{
    public function userIndex(){
        return view('Ripple::users.userIndex');
    }
}

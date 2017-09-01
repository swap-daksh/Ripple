<?php

namespace GitLab\Ripple\Http\Controllers;

class PostController extends Controller
{
    public function postIndex(){
        return view('Ripple::posts.postIndex');
    }
}

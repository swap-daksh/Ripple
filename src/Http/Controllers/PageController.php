<?php

namespace GitLab\Ripple\Http\Controllers;

class PageController extends Controller
{
    public function pageIndex()
    {
        return view('Ripple::pages.pageIndex');
    }
    
    public function pageAdd()
    {
        return view('Ripple::pages.pageAdd');
    }
}

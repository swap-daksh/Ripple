<?php

namespace GitLab\Ripple\Http\Controllers;

class PageController extends Controller
{
    public function pageIndex()
    {
        return view('Ripple::pages.pageIndex');
    }
}

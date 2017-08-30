<?php

namespace GitLab\Ripple\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller {

    public function pageIndex() {
        
        return view('Ripple::pages.pageIndex');
    }

}

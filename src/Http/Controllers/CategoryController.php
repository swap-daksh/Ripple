<?php

namespace YPC\Ripple\Http\Controllers;

class CategoryController extends Controller {


    /**
     * Show the categories list view
     * 
     * @return \Illuminate\Http\Response
     */
    public function categoriesIndex() {
        return view('Ripple::categories.categoriesIndex');
    }

}

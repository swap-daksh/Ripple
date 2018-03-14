<?php

namespace YPC\Ripple\Http\Controllers;


use Illuminate\Support\Facades\DB;
class CategoryController extends Controller {


    /**
     * Show the categories list view
     * 
     * @return \Illuminate\Http\Response
     */
    public function categoriesIndex() {
        return view('Ripple::categories.categoriesIndex');
    }


    /**
     * Show the Add Category form
     * 
     * @return \Illuminate\Http\Response
     */
    public function categoriesAdd(){

        if(request()->has('new-category')){
            $categories = request('category');
            $categories['slug'] = str_slug($categories['name'], '_');
            if($categories['description'] == ''){
                $categories['description'] = 'This is default description ';
            }
            //dd($categories);
            if(!DB::table(prefix('categories'))->where('slug', str_slug($categories['name'], '_'))->exists()){
                if(DB::table(prefix('categories'))->insert($categories)){
                    session()->flash('success', 'Category successfully saved.');
                    return back();
                }else{
                    session()->flash('error', 'Oops! something went wrong. The category you want to create it maybe already registered.');
                }
            }
            
        }

        return view('Ripple::categories.categoriesAdd');
    }

}

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
        if($this->categoriesAdd()) {
            return back();
        }
        return view('Ripple::categories.categoriesIndex');
    }


    /**
     * Show the Add Category form
     * 
     * @return \Illuminate\Http\Response
     */
    public function categoriesAdd( ) 
    {

        if (request()->has('new-category') ) {
            $categories = request('category');
            $categories['slug'] = str_slug($categories['name'], '_');
            if ($categories['description'] == '' ) {
                $categories['description'] = 'This is default description ';
            }
            
            if (!DB::table(prefix('categories'))->where('slug', str_slug($categories['name'], '_'))->exists() ) {
                if (DB::table(prefix('categories'))->insert($categories) ) {
                    session()->flash('success', 'Category successfully saved.');
                    return true;
                } else {
                    session()->flash('error', 'Oops! something went wrong. The category you want to create it maybe already registered.');
                    return false;
                }
            }
            
        }

    }


    /**
     * Show Category/Tag edit form
     * 
     * @return \Illuminate\Http\Response
     */
    public function categoryEdit($id){
        $category = DB::table(prefix('categories'))
        ->where('id', $id)
        ->first();
        return view('Ripple::categories.categoriesEdit', compact('category'));
    }
}

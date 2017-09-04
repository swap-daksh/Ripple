<?php

namespace GitLab\Ripple\Support\Traits;

use GitLab\Ripple\Models\Category;
use Illuminate\Support\Facades\DB;

trait Categories {

    public function allCategories($key = 'parent', $value = 0, $compare = '>=') {
        return DB::table('categories')->where('type', 'category')->where($key, $compare, $value)->get();
    }
    public function allTags($key = 'parent', $value = 0, $compare = '>=') {
        return DB::table('categories')->where('type', 'tag')->where($key, $compare, $value)->get();
    }

}

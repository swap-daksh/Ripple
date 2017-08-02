<?php

namespace GitLab\Ripple\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GitLab\Ripple\Traits\DatabaseTables;

class DatabaseController extends Controller {

    use DatabaseTables;

    public function database() {
        $tables = self::tables();
        return view('Ripple::database.database-view', compact('tables'));
    }
    
    public function createTable(){
        if(request()->has('create-table')):
            dd(request()->all());
        endif;
        return view("Ripple::database.database-create");
    }

}

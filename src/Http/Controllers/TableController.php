<?php

namespace GitLab\Ripple\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public function database()
    {
//        dd(DB::select('SHOW TABLES'));
        $tables = DB::select('SHOW TABLES');
//        $array = array('as'=>'adfdfs','ab'=>'ab', 'ac'=>'ac');
//        dd(reset($array));
//        $db_table = array_map(function($table){
//            $tbl = get_object_vars($table);
//            dd(reset($tbl));
//            dd($a);
//        }, $tables);
//        dd(array_map(function ($table) {
//            $table = get_object_vars($table);
//
//            return reset($table);
//        }, DB::select('SHOW TABLES')));
        return view('Ripple::database.database-view', compact('tables'));
    }

    public function dashboard()
    {
        return view('Ripple::dashboard');
    }

    public function settings()
    {
        return view('Ripple::settings.settings');
    }
}

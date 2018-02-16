<?php 

namespace YPC\Ripple\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Router;

class AjaxController extends Controller
{

    /**
     * Ajax Route to get sync data of a column
     */
    public function synchronizedColumn(){
        $response = DB::table(request('table'))->where(request('column'), request('column_value'))->get();
        return response()->json($response);
    }
}
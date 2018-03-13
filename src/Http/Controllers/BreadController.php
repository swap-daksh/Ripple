<?php

namespace YPC\Ripple\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Router;

class BreadController extends Controller
{





    /**
     * BreadController@createBread route method to create new Bread Module.
     *
     * @param string $table
     * @return mixed
     */
    public function createBread($table)
    { 
        if (DB::table(prefix('breads'))->where('table', request('table'))->exists()) :
            return redirect()->route('Ripple::adminEditBread', ['table' => $table]);
        endif;
        if (request()->has('create-bread')) {
            if (!(DB::table(prefix('breads'))->where('table', request('table'))->exists())) {
                $bread = self::insertBread(json_decode(request('bread-info'), true));
            }
            if (count($bread) === 1 && true === $bread[0]) {
                session()->flash('success', 'Bread successfully created.');
            } else {
                session()->flash('error', 'Oops! something went wrong.');
            }
            return redirect()->route('Ripple::adminEditBread', ['table' => $table]);
        }
        return view('Ripple::bread.beta-breadCreateModule', compact('table'));
    }






    /**
     * BreadController@editBread route method for edit module Bread.
     *
     * @param string $table
     * @return mixed
     */
    public function editBread($table)
    {
        if (request()->has('edit-bread')) :
            try {
            $bread = json_decode(request('bread-info'), true);
            $bread['model'] = str_replace('\\', '\\\\', $bread['model']);
            $bread['controller'] = str_replace('\\', '\\\\', $bread['controller']);
            DB::table(prefix('breads'))->where('id', $bread['id'])->update(array_diff($bread, ['id' => $bread['id']]));
            collect(json_decode(request('bread-columns'), true))->map(function ($column) {
                $column['updated_at'] = date('Y-m-d h:i:s');
                DB::table(prefix('bread_columns'))->where('id', $column['id'])->update(array_diff($column, ['id' => $column['id']]));
            });
            session()->flash('success', 'Bread successfully updated.');
            return back();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        endif;
        return view('Ripple::bread.beta-breadEditModule', compact('table'));
    }





    /**
     * BreadController@deleteBread route method to delete breads
     *
     * @param string $table
     */
    public function deleteBread($table)
    {
        $bread = DB::table(prefix('breads'))->where('table', $table)->first();
        if (DB::table(prefix('breads'))->where('id', $bread->id)->delete()) {
            if (DB::table(prefix('bread_columns'))->where('bread', $bread->id)->delete()) {
                session()->flash('success', 'Bread successfully deleted.');
                return redirect(route('Ripple::databaseTableBreads'));
            }
        }
    }





    /**
     * BreadController@listBreads route method for listing all bread modules.
     *
     * @return mixed
     */
    public function listBreads()
    {
        $breads = DB::table(prefix('breads'))->where('status', 1)->get();
        return view('Ripple::bread.beta-breadModules', compact('breads'));
    }



    /**
     * BreadController@updateBreadStatus route method for update bread status
     *
     * @return json
     */
    public function updateBreadStatus()
    {
        $status = DB::table(prefix('breads'))->where('table', request('table'))->value('status');

        if (DB::table(prefix('breads'))->where('table', request('table'))->update(['status' => !$status, 'updated_at' => date('Y-m-d h:i:s')])) :
            return response()->json(['status' => 'OK', 'msg' => '"' . request('table') . '" bread status has been updated.']);
        else :
            return response()->json(['status' => 'NOK', 'msg' => '"' . request('table') . '" bread status has not updated.']);
        endif;
    }

    /**
     * BreadController@breadBrowse route method for browse all bread records
     *
     * @param string $slug
     * @return mixed
     */
    public function breadBrowse($slug)
    {
        $browse = new \stdClass();
        $bread = DB::table(prefix('breads'))->where('slug', $slug)->first();
        $table = $bread->table;
        $records = DB::table($table)->get();
        $columns = DB::table(prefix('bread_columns'))->where('bread', $bread->id)->orderBy('order')->get();
        return view('Ripple::bread.breadBrowse', compact('table', 'bread', 'records', 'columns'));
    }

    /**
     * BreadController@breadView route method to view a single record
     *
     * @param string $slug
     * @param integer $id
     * @return mixed
     */
    public function breadView($slug, $id)
    {
        $view = new \stdClass();
        $view->bread = DB::table(prefix('breads'))->where('slug', $slug)->first();
        $view->table = $view->bread->table;
        $view->columns = DB::table(prefix('bread_columns'))->where('bread', $view->bread->id)->get();
        $view->data = DB::table($view->table)->where('id', $id)->first();
        $bread = DB::table(prefix('breads'))->where('slug', $slug)->first();
        $table = $bread->table;
        $columns = DB::table(prefix('bread_columns'))->where('bread', $bread->id)->orderBy('order')->get();
        return view('Ripple::bread.breadView', compact('table', 'id', 'columns', 'bread', 'view'));
    }

    /**
     * BreadController@breadEdit route method to edit/update bread record
     *
     * @param string $slug
     * @param integer $id
     * @return mixed
     */
    public function breadEdit($slug, $id)
    {
        $browse = new \stdClass();
        $bread = DB::table(prefix('breads'))->where('slug', $slug)->first();
        $table = $bread->table;
        //dd(\YPC\Ripple\Support\Facades\Relation::getRelation(['table' => 'users', 'column' => 'email', 'display' => 'name']));
        $columns = DB::table(prefix('bread_columns'))->where('bread', $bread->id)->orderBy('order')->get();
        if (request()->has('bread-edit')) {
            if (DB::table(request('table'))->where('id', request('edit-id'))->update($this->renderBreadColumns(request('column')))) {
                session()->flash('success', ucfirst($bread->display_singular) . ' successfully updated');
                return back();
            }
        }
        $edit = DB::table($table)->where('id', $id)->first();

        return view('Ripple::bread.breadEdit', compact('table', 'id', 'edit', 'columns', 'bread'));
    }

    /**
     * BreadController@breadAdd route method to add record to bread
     *
     * @param string $slug
     * @return mixed
     */
    public function breadAdd($slug)
    {
        if (request()->has('bread-add')) {
            $BREAD_ADDED = DB::table(request('table'))->insert($this->renderBreadColumns(request('column')));

            /**
             * Check whether the bread is added or not.
             */
            if ($BREAD_ADDED) {
                session()->flash('success', 'New record inserted into database table');
            }
        }
        $bread = DB::table(prefix('breads'))->where('slug', $slug)->first();
        $table = $bread->table;
        $columns = DB::table(prefix('bread_columns'))->where('bread', $bread->id)->orderBy('order')->get();
        return view('Ripple::bread.breadAdd', compact('table', 'columns', 'bread'));
    }

    /**
     * BreadController@breadDelete route method to delete bread record
     *
     *
     * @param integer $id
     * @return mixed
     */
    public function breadDelete($slug, $id)
    {
        $bread = DB::table(prefix('breads'))->where('slug', $slug)->first();
        if(DB::table($bread->table)->where('id', $id)->delete()){
            session()->flash('success', $bread->display_singular.' successfully deleted.');
            return redirect()->route("Ripple::adminBreadBrowse", ['slug'=>$slug]);
        }
    }



    /**
     * Get array of all breads
     */
    private function renderBreadColumns($columns){
        return collect($columns)->map(function($value, $name){
            if($value instanceof \Illuminate\Http\UploadedFile){
                $extension = $value->extension();
                $file_name = str_singular(request('table'))."_".str_random(20).'.'.$extension;
                $path = 'public';
                if(request($name.'_upload_path') !== null){
                    $path .= '/'.rtrim(ltrim(request($name.'_upload_path'), '/'), '/');
                }
                return $value->storeAs($path, $file_name);
            }
            return $value;
        })->toArray();
    }




    /**
     * insert bread details to rpl_breads
     *
     * @param array $breadInfo
     * @return array
     */
    private static function insertBread(array $breadInfo)
    {
        $insertBread = array_merge($breadInfo, ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')]);
        $bread = DB::table(prefix('breads'))->insertGetId($insertBread);
        if ($bread !== null) {
            return self::insertBreadColumn($bread);
        }
    }

    /**
     * Insert bread columns of bread module to rpl_bread_columns
     *
     * @param array|object $bread
     * @return array
     */
    private static function insertBreadColumn($bread)
    {
        return array_unique(collect(array_values(json_decode(request('bread-columns'), true)))->map(function ($item, $order) use ($bread) {
            $item['bread'] = $bread;
            $item['order'] = $order;
            return DB::table(prefix('bread_columns'))->insert($item);
        })->toArray());
    }

}

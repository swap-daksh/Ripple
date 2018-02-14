<?php

namespace YPC\Ripple\Http\Controllers;

use YPC\Ripple\Schema\Table;
use YPC\Ripple\Support\Traits\DatabaseTables;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{

    use DatabaseTables;

    /**
     * DatabaseController@databaseModule route method for database module
     * 
     * @return mixed
     */
    public function databaseModule()
    {
        return view('Ripple::database.beta-databaseModules');
    }

    /**
     * DatabaseController@tableBreads route method for list all breads
     * 
     * @return mixed
     */
    public function tableBreads()
    {
        $tables = self::tables();
        return view('Ripple::database.beta-databaseTableBreads', compact('tables'));
    }

    public function database()
    {
        if (request()->has('table')) :
            if ((new Table(request()->all()))->make(request()->all())->create()) :
            session()->flash('success', 'Table Successfully Created');
        return redirect()->route('Ripple::adminViewTable', ['table' => session('table')]);
        else :
            session()->flash('error', 'Table "' . session('table') . '" already exists.');
        return redirect()->route('Ripple::adminDatabase');
        endif;
        endif;
//        dd(dbal_db()->listTableColumns('users'));
        $tables = self::tables();

        return view('Ripple::database.beta-database', compact('tables'));
    }

    public function createTable()
    {
        if (request()->has('table')) :
            if ((new Table(request()->all()))->make(request()->all())->create()) :
            session()->flash('success', 'Table Successfully Created');
        return redirect()->route('Ripple::adminViewTable', ['table' => session('table')]);
        else :
            session()->flash('error', 'Table "' . session('table') . '" already exists.');
        return redirect()->route('Ripple::adminDatabase');
        endif;
        endif;
        return view('Ripple::database.beta-create-table');
    }

    public function viewTable($table)
    {
        if (request()->has('table')) {
            dd(request());
        }
        $columns = dbal_db()->listTableColumns($table);
        return view('Ripple::database.database-table', compact('table', 'columns'));
    }

    /**
     * function for table relationship view
     * 
     * @return mixed
     */
    public function tableRelationship()
    {
        if (request()->has('table-relation')) {
            if (!$this->hasRelationExists(request('relation'))) {
                if ($this->createRelation(request('relation'))) {
                    session()->flash('success', 'Relation successfully created.');
                    return back();
                }
            } else {
                session()->flash('error', 'Relation already exists.');
                return back();
            }
        }

        $relations = DB::table(prefix('relations'))->get();
        return view('Ripple::database.beta-tableRelations', compact('relations'));
    }



    public function deleteTableRelation($id)
    {
        if (DB::table(prefix('relations'))->where('id', base64_decode($id))->delete()) {
            session()->flash('success', 'Table Relation successfully deleted.');
            return back();
        }
        session()->flash('error', 'Oops! something went wrong');
        return back();
    }


    /**
     * Determine if the relation is exists or not
     * 
     * @param array $request
     * @return boolean
     */
    private function hasRelationExists($request)
    {
        return DB::table(prefix('relations'))->where('rel_table', $request['rel_table'])->where('rel_column', $request['rel_column'])->where('ref_table', $request['ref_table'])->where('ref_column', $request['ref_column'])->exists();
    }


    /**
     * Create new table relation 
     * 
     * @param array $request
     * @return boolean
     */
    private function createRelation($request)
    { 
        return DB::table(prefix('relations'))->insert(array_merge($request, ['status' => 1, 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')]));
        //return DB::table(prefix('relations'))->insert(['rel_table' => $request['rel_table'], 'rel_column' => $request['rel_column'], 'ref_table' => $request['ref_table'], 'ref_column' => $request['ref_column'], 'ref_display' => $request['ref_display'], 'status' => 1, 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')]);
    }
}

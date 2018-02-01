<?php

namespace YPC\Ripple\Http\Controllers;

use YPC\Ripple\Schema\Table;
use YPC\Ripple\Support\Traits\DatabaseTables;

class DatabaseController extends Controller
{

    use DatabaseTables;

    public function database()
    {
       if (request()->has('table')) :
            if ((new Table(request()->all()))->make(request()->all())->create()):
                session()->flash('success', 'Table Successfully Created');
                return redirect()->route('Ripple::adminViewTable', ['table' => session('table')]);
            else:
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
            if ((new Table(request()->all()))->make(request()->all())->create()):
                session()->flash('success', 'Table Successfully Created');
                return redirect()->route('Ripple::adminViewTable', ['table' => session('table')]);
            else:
                session()->flash('error', 'Table "' . session('table') . '" already exists.');
                return redirect()->route('Ripple::adminDatabase');
            endif;
        endif;
        return view('Ripple::database.beta-create-table');
    }

    public function viewTable($table)
    {
        if(request()->has('table')){
            dd(request());
        }
        $columns = dbal_db()->listTableColumns($table);
        return view('Ripple::database.database-table', compact('table', 'columns'));
    }

}

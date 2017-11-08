<?php

namespace GitLab\Ripple\Http\Controllers;

use GitLab\Ripple\Schema\Table;
use GitLab\Ripple\Support\Traits\DatabaseTables;

class DatabaseController extends Controller
{

    use DatabaseTables;

    public function database()
    {
//        dd(dbal_db()->listTableColumns('users'));
        $tables = self::tables();

        return view('Ripple::database.database-view', compact('tables'));
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
        return view('Ripple::database.database-create');
    }

    public function viewTable($table)
    {
        $columns = dbal_db()->listTableColumns($table);
        return view('Ripple::database.database-table', compact('table', 'columns'));
    }

}

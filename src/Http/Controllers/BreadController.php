<?php

namespace GitLab\Ripple\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BreadController extends Controller
{

    public function createBread($table)
    {
        if (DB::table('breads')->where('table', request('table'))->exists()):
            return redirect()->route('Ripple::adminEditBread', ['table' => $table]);
        endif;
        if (request()->has('create-bread')) {
            if (!(DB::table('breads')->where('table', request('table'))->exists())) {
                $bread = self::insertBread();
            }
            if (count($bread) === 1 && true === $bread[0]) {
                session()->flash('success', 'Bread successfully created.');
            } else {
                session()->flash('error', 'Oops! something went wrong.');
            }
            return redirect()->route('Ripple::adminEditBread', ['table' => $table]);
        }
        $exists = DB::table('breads')->where('table', $table)->exists();
        $tableDetails = dbal_db()->listTableDetails($table);

        return view('Ripple::bread.bread-create', compact('table', 'tableDetails', 'exists'));
    }

    public function editBread($table)
    {
        if (request()->has('edit-bread')):
            dd(request()->all());
        endif;
        $exists = DB::table('breads')->where('table', $table)->exists();
        $breadDetails = DB::table('breads')->where('table', $table)->first();
//        dd(collect($breadDetails)->toJson());
        $tableDetails = dbal_db()->listTableDetails($table);
        $breadTableRows = DB::table('bread_columns')->where('bread', $breadDetails->id)->orderBy('order', "DESC")->get();
//        dd(DB::table('bread_columns')->where('bread', $breadDetails->id)->get());
        $breadRows = collect(DB::table('bread_columns')->where('bread', $breadDetails->id)->get())->mapWithKeys(function($item) {
            return [$item->column => $item];
        });
//        dd($breadRows);
        return view('Ripple::bread.bread-edit', compact('table', 'tableDetails', 'breadDetails', 'breadRows', 'exists', 'breadTableRows'));
    }

    private static function tableColumns($columns)
    {
        $abc = collect($columns)->mapWithKeys(function($column) {
            return [
                'name'=>$column->getName(),
                'type'=>$column->getType(),
                'notnull'=>$column->getNotnull()
            ];
        });
    }

    private static function insertBread()
    {
        $bread = DB::table('breads')->insertGetId(['table' => request('table'), "display_singular" => request('display_singular'), "display_plural" => request('display_plural'), "slug" => request('slug'), "icon" => request('icon'), "model" => request('model'), "controller" => request('controller'), "description" => request('description'), "created_at" => date('Y-m-d h:i:s'), "updated_at" => date('Y-m-d h:i:s')]);
        if ($bread !== null) {
            return self::insertBreadColumn($bread);
        }
    }

    private static function insertBreadColumn($bread)
    {
        return array_unique(collect(request('bread'))->map(function($item, $order) use ($bread) {
                    $item['bread'] = $bread;
                    $item['order'] = $order;
                    return DB::table('bread_columns')->insert($item);
                })->toArray());
    }

}

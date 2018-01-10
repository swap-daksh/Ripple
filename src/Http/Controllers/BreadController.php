<?php

namespace YPC\Ripple\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Router;

class BreadController extends Controller
{

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
        return view('Ripple::bread.bread-create', compact('table'));
    }

    public function editBread($table)
    {
        if (request()->has('edit-bread')) :
            try {
                $bread = request('bread')['detail'];
                DB::table(prefix('breads'))->where('id', $bread['id'])->update(array_diff($bread, ['id' => $bread['id']]));
                collect(json_decode(request('bread')['columns'], true))->map(function ($column) {
                    DB::table(prefix('bread_columns'))->where('id', $column['id'])->update(array_diff($column, ['id' => $column['id'], '$$hashKey' => $column['$$hashKey'], 'created_at' => $column['created_at']]));
                });
                session()->flash('success', 'Bread successfully updated.');
                return back();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        endif;
        $exists = DB::table(prefix('breads'))->where('table', $table)->exists();
        $breadDetails = DB::table(prefix('breads'))->where('table', $table)->first();

        $tableDetails = dbal_db()->listTableDetails($table);

        $breadTableRows = DB::table(prefix('bread_columns'))->where('bread', $breadDetails->id)->orderBy('order', "DESC")->get();
        $breadRows = collect(DB::table(prefix('bread_columns'))->where('bread', $breadDetails->id)->get())->mapWithKeys(function ($item) {
            return [$item->column => $item];
        });
        return view('Ripple::bread.bread-edit', compact('table', 'tableDetails', 'breadDetails', 'breadRows', 'exists', 'breadTableRows'));
    }

    private static function tableColumns($columns)
    {
        $abc = collect($columns)->mapWithKeys(function ($column) {
            return [
                'name' => $column->getName(),
                'type' => $column->getType(),
                'notnull' => $column->getNotnull()
            ];
        });
    }

    private static function insertBread(Array $breadInfo)
    {
        $insertBread = array_merge($breadInfo, ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')]);
        $bread = DB::table(prefix('breads'))->insertGetId($insertBread);
        if ($bread !== null) {
            return self::insertBreadColumn($bread);
        }
    }

    private static function insertBreadColumn($bread)
    {
        return array_unique(collect(array_values(json_decode(request('bread-columns'), true)))->map(function ($item, $order) use ($bread) {
                    $item['bread'] = $bread;
                    $item['order'] = $order;
                    return DB::table(prefix('bread_columns'))->insert($item);
                })->toArray());
    }

    public function updateBreadStatus()
    {
        /* if (!DB::table('rpl_breads')->where('table', request('table'))->exists()) {
          return response()->json(['status' => 'NOK', 'msg' => 'Table "' . request('table') . '" Bread not created yet.', 'table' => request('table')]);
          } */
        $breadMeta = DB::table(prefix('breads_meta'));
        if ($breadMeta->where('table', request('table'))->where('key', 'status')->exists()) :
            $status = DB::table(prefix('breads_meta'))->where('table', request('table'))->where('key', 'status')->value('value');
            if ($breadMeta->where('table', request('table'))->where('key', 'status')->update(['value' => !$status, 'updated_at' => date('Y-m-d h:i:s')])) :
                return response()->json(['status' => 'OK', 'msg' => '"' . request('table') . '" bread status has been updated.']);
            else :
                return response()->json(['status' => 'NOK', 'msg' => '"' . request('table') . '" bread status has not updated.']);
            endif;
        else :
            if ($breadMeta->insert(['table' => request('table'), 'value' => 1, 'key' => 'status', 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')])) :
                return response()->json(['status' => 'OK', 'msg' => '"' . request('table') . '" bread status has been updated.']);
            else :
                return response()->json(['status' => 'NOK', 'msg' => '"' . request('table') . '" bread status has not updated.']);
            endif;
        endif;
    }

    public function breadBrowse($slug)
    {
        $bread = DB::table(prefix('breads'))->where('slug', $slug)->first();
        $table = $bread->table;
        $records = DB::table($table)->get();
        $columns = DB::table(prefix('bread_columns'))->where('bread', $bread->id)->get();
        return view('Ripple::bread.breadBrowse', compact('table', 'records', 'columns'));
    }

    public function breadView($slug, $id)
    {
        return view('Ripple::bread.breadView', compact('table', 'id'));
    }

    public function breadEdit($slug, $id)
    {
        return view('Ripple::bread.breadEdit', compact('table', 'id'));
    }

    // function to add record
    public function breadAdd($slug)
    {
        return view('Ripple::bread.breadAdd', compact('table'));
    }

    // function to add record
    public function breadDelete()
    {
        return view('Ripple::bread.breadAdd');
    }

}

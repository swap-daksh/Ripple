<?php

namespace YPC\Ripple\Support\Core;

use Illuminate\Support\Facades\DB;

class Relation
{

    /**
     * Determine if the table column has any relation defined.
     * 
     * @param string $table
     * @param string $column
     * @return boolean
     */
    public function hasRelation($table, $column)
    {
        return DB::table(prefix('relations'))->where('rel_table', $table)->where('rel_column', $column)->exists();
    }

    /**
     * Get all values of relation column.
     * 
     * @param string $table
     * @param string $column
     */
    public function getRelation($table, $column, $conversion = 'toArray')
    {
        $relation = DB::table(prefix('relations'))->where('rel_column', $column)->first();
        return collect(DB::table($relation->ref_table)->orderBy($relation->ref_display, 'asc')->get())
            ->mapWithKeys(function ($data) use ($relation) {
                return [$data->{$relation->ref_column} => $data->{$relation->ref_display}];
            })->{$conversion}();
    }


}

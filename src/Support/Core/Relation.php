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
        //dd(DB::table($relation->ref_table)->orderBy($relation->ref_display, 'asc')->get());
        return collect(DB::table($relation->ref_table)->orderBy($relation->ref_display, 'asc')->get())
            ->mapWithKeys(function ($data) use ($relation) {
                return [$data->{$relation->ref_column} => $data->{$relation->ref_display}];
            })->{$conversion}();
    }




    
    /**
     * Get the display value of table relations
     * 
     * @param string $table
     * @param string $column
     * @param string|int $column_value
     * @return string|int
     */
    public function get_value($table, $column, $column_value){
        $relation = DB::table(prefix('relations'))->where('rel_column', $column)->first();
        return DB::table($relation->ref_table)->where($relation->ref_column, $column_value)->first()->{$relation->ref_display};
    }


    /**
     * Determine if the column has referenced with Synchronized 
     * 
     * @param string $rel_table
     * @param string $column
     * @return boolean
     */
    public function hasSyncRef($rel_table, $column){
        $this->rel_table = $rel_table;
        $this->column = $column;
        return DB::table(prefix('relations'))->where('rel_table', $rel_table)->where('sync_with', $column)->where('sync_result', 1)->exists();
    }



    /**
     * Determine if the column is dependent upon another column or not
     * 
     * 
     */
    public function isDependent($rel_table, $rel_column){
        return DB::table(prefix('relations'))->where('rel_table', $rel_table)->where('rel_column', $rel_column)->where('sync_result', 1)->exists();
    }




    /**
     * Get the details of relation synchronized data
     * 
     * @param string $rel_table
     * @param string $column
     * @return array|object
     */
    public function dataSync(){
        return DB::table(prefix('relations'))
        ->where('rel_table', $this->rel_table)
        ->where('sync_with', $this->column)
        ->where('sync_result', 1)
        ->select('id', 'rel_table', 'rel_column', 'ref_table', 'ref_column', 'ref_display', 'sync_result', 'sync_with', 'sync_table', 'sync_column')
        ->first();
    }


}

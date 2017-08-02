<?php

namespace GitLab\Ripple\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GitLab\Ripple\Traits\DatabaseTables;
use Illuminate\Support\Facades\Schema;

class DatabaseController extends Controller {

    use DatabaseTables;

    public function database() {
        $tables = self::tables();
        return view('Ripple::database.database-view', compact('tables'));
    }

    public function createTable() {

        

        if (request()->has('create-table')):
            dd(request()->all(), $this->checkTableColumns());
        endif;
        return view("Ripple::database.database-create");
    }
    
    public function checkTableColumns(){
        Schema::create('cars', function ($table) {
            $table->bigIncrements('id')->after('column')->default('')->unsigned();
            $table->bigInteger('votes');
            $table->binary('data');
            $table->boolean('confirmed');   
            $table->char('name', 4);
            $table->date('created_at');
            $table->dateTime('created_at');
            $table->dateTimeTz('created_at');
            $table->decimal('amount', 5, 2);
            $table->double('column', 15, 8);
            $table->enum('choices', ['foo', 'bar']);
            $table->float('amount', 8, 2);
            $table->increments('id');
            $table->integer('votes');
            $table->ipAddress('visitor');
            $table->json('options');
            $table->jsonb('options');
            $table->longText('description');
            $table->macAddress('device');
            $table->mediumIncrements('id');
            $table->mediumInteger('numbers');
            $table->mediumText('description');
            $table->morphs('taggable');
            $table->nullableMorphs('taggable');
            $table->nullableTimestamps();
            $table->rememberToken();
            $table->smallIncrements('id');
            $table->smallInteger('votes');
            $table->softDeletes();
            $table->string('email');
            $table->string('name', 100);
            $table->text('description');
            $table->time('sunrise');
            $table->timeTz('sunrise');
            $table->tinyInteger('numbers');
            $table->timestamp('added_on');
            $table->timestampTz('added_on');
            $table->timestamps();
            $table->timestampsTz();
            $table->unsignedBigInteger('votes');
            $table->unsignedInteger('votes');
            $table->unsignedMediumInteger('votes');
            $table->unsignedSmallInteger('votes');
            $table->unsignedTinyInteger('votes');
            $table->uuid('id');
            dd($table->getColumns());
        });
    }

}

<?php

namespace GitLab\Ripple\Http\Controllers;

use GitLab\Ripple\Schema\Table;
use GitLab\Ripple\Support\Traits\DatabaseTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use GitLab\Ripple\Support\Database\Schema\SchemaManager;

use GitLab\Ripple\Support\Database\DataTypes\MediumInt;
use Doctrine\DBAL\Types\Type;

class DatabaseController extends Controller
{

    use DatabaseTables;

    public function database()
    {
        $tables = self::tables();

        return view('Ripple::database.database-view', compact('tables'));
    }

    public function createTable()
    {
//        dd(\Doctrine\DBAL\Types\Type::getTypesMap());
        if (request()->has('create-table')):

            dump(request('columns'));
            $table = (new Table(request('table')))->columns(request('columns'))->create();

//        dd($table);
//        dd(request('columns')[1]);
//        dd(request()->all(), request('columns')[1], $this->checkTableColumns());
        endif;

        return view('Ripple::database.database-create');
    }

    public function checkTableColumns()
    {

//        dd($column);
        dd(request()->all());
        Schema::create('cars', function ($table) {
            $column = [];
            $attributes = [];
            foreach (request('columns') as $columns):
                $column['name'] = $columns['name'];
                $column['type'] = strtolower($columns['type']);
                foreach ($columns['attributes'] as $name => $value):
                    if ($name == 'type') {
                        if ($value != '') {
                            $column['attributes'][strtolower($value)] = true;
                        }
                        continue;
                    }
                    if ($value == 'on') {
                        $column['attributes'][$name] = true;
                        continue;
                    }
                    $column['attributes'][$name] = $value;
                endforeach;

//                dd($column);
                $table->addColumn($column['type'], $column['name'], $column['attributes']);
            endforeach;
//            dd($column);
//            $table->bigIncrements('id')->index()->primary()->nullable()->unique()->after('column')->default('')->unsigned();
//            $table->bigInteger('votes');
//            $table->binary('data');
//            $table->boolean('confirmed');
//            $table->char('name', 4);
//            $table->date('created_at');
//            $table->dateTime('created_at');
//            $table->dateTimeTz('created_at');
//            $table->decimal('amount', 5, 2);
//            $table->double('column', 15, 8);
//            $table->enum('choices', ['foo', 'bar']);
//            $table->float('amount', 8, 2);
            $table->increments('id');
//            $table->integer('votes');
//            $table->ipAddress('visitor');
//            $table->json('options');
//            $table->jsonb('options');
//            $table->longText('description');
//            $table->macAddress('device');
//            $table->mediumIncrements('id');
//            $table->mediumInteger('numbers');
//            $table->mediumText('description');
//            $table->morphs('taggable');
//            $table->nullableMorphs('taggable');
//            $table->nullableTimestamps();
//            $table->rememberToken();
//            $table->smallIncrements('id');
//            $table->smallInteger('votes');
//            $table->softDeletes();
//            $table->string('email');
//            $table->string('name', 100);
//            $table->text('description');
//            $table->time('sunrise');
//            $table->timeTz('sunrise');
//            $table->tinyInteger('numbers');
//            $table->timestamp('added_on');
//            $table->timestampTz('added_on');
//            $table->timestamps();
//            $table->timestampsTz();
//            $table->unsignedBigInteger('votes');
//            $table->unsignedInteger('votes');
//            $table->unsignedMediumInteger('votes');
//            $table->unsignedSmallInteger('votes');
//            $table->unsignedTinyInteger('votes');
//            $table->uuid('id');
            dd($table->getColumns());
        });
    }

}

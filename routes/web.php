<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

use GitLab\Ripple\Support\Blade\RippleBlade;
use Illuminate\Support\Facades\DB;

//use Illuminate\Database\DatabaseManager;
//use Doctrine\DBAL\Schema\SchemaException;
//use Doctrine\DBAL\Schema\Table as DoctrineTable;

Route::group(['as' => 'Ripple::', 'namespace' => config('ripple.controllers.namespace', 'GitLab\Ripple\Http\Controllers'), 'middleware' => ['web'], 'prefix' => 'admin'], function () {
    /*
      |----------------------------------------------------------------------
      |	Admin Route
      |----------------------------------------------------------------------
     */
    Route::any('/', 'RippleController@dashboard')->name('dashboard');

    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                              Settings
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::match(['get', 'post'], '/settings', 'SettingsController@settings')->name('adminSettings');
    Route::any('/setting/create', 'SettingsController@createSetting')->name('adminCreateSetting');
    Route::post('/setting/delete', 'SettingsController@deleteSetting')->name('adminDeleteSetting');

    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                              Database
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/database', 'DatabaseController@database')->name('adminDatabase');
    Route::any('/database/create', 'DatabaseController@createTable')->name('adminCreateTable');

    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Pages
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/pages', 'PageController@pageIndex')->name('adminPageIndex');
    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Posts
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/posts', 'PostController@postIndex')->name('adminPostIndex');
    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Users
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/users', 'UserController@userIndex')->name('adminUserIndex');

    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Other
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::get('/ripple', function () {
        return view('Ripple::welcome');
    });
    Route::get('/asdf/asdf/asdf/asdf/ripple', function () {
        return view('Ripple::welcome');
    })->name('asdf');
    Route::get('/test', 'RippleController@index');
    Route::get('/test-ripple', 'RippleController@index');

    Route::get('/testing-facades', function () {
        Ripple::help();
    });

    Route::get('/get-facade', function () {

//        $schema = new \Doctrine\DBAL\Schema\Schema();
//        $myTable = $schema->createTable("my_table");
//        $myTable->addColumn("id", "integer", array("unsigned" => true));
//        $myTable->addColumn("username", "string", array("length" => 32));
//        $myTable->setPrimaryKey(array("id"));
//        $myTable->addUniqueIndex(array("username"));
//        $schema->createSequence("my_table_seq");
//
//        $myForeign = $schema->createTable("my_foreign");
//        $myForeign->addColumn("id", "integer");
//        $myForeign->addColumn("user_id", "integer");
//        $myForeign->addForeignKeyConstraint($myTable, array("user_id"), array("id"), array("onUpdate" => "CASCADE"));
//
//        $queries = $schema->toSql(); // get queries to create this schema.
//        dump('asdf');
        $class = get_class(Mail::getFacadeRoot());
        dump($class);
//        $schema = (new \Doctrine\DBAL\Schema\Schema())->createTable('demo_testing');
//        $schema->addColumn("id", "integer", array('unsigned' => true));
//        $schema->addColumn("username", "string", array('length' => 50));
//        $schema->setPrimaryKey(array('id'));
//        DB::connection()->getDoctrineSchemaManager()->createTable($schema);
//                ->addColumn("id", "integer");
//         DB::connection()->getDoctrineSchemaManager()->toSql();
//        $schema->toSql();
//        dd($class, $schema, DB::connection()->getDoctrineSchemaManager()->listTableColumns('users'), DB::connection()->getDoctrineConnection()
//        );
    });

    Route::get('/testing-abc', function () {
        $RippleBLADE = new RippleBlade();
        $class = new ReflectionClass(GitLab\Ripple\Support\Blade\RippleBlade::class);
//        dd($class, $RippleBLADE);
        foreach ((new ReflectionClass(GitLab\Ripple\Support\Blade\RippleBlade::class))->getMethods() as $RippleBlade) {
            $RippleBLADE->{$RippleBlade->name}();
//            dd($RippleBlade, $RippleBlade);
//            dd()
        }
    });
});

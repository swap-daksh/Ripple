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

use YPC\Ripple\Support\Blade\RippleBlade;
use Illuminate\Support\Facades\DB;

//use Illuminate\Database\DatabaseManager;
//use Doctrine\DBAL\Schema\SchemaException;
//use Doctrine\DBAL\Schema\Table as DoctrineTable;

Route::group(['as' => 'Ripple::', 'namespace' => config('ripple.controllers.namespace', 'YPC\Ripple\Http\Controllers'), 'middleware' => ['web'], 'prefix' => 'admin'], function () {
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
    Route::any('/database/table/view/{table}', 'DatabaseController@viewTable')->name('adminViewTable');

    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                              CRUD/BREAD
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/bread/{table}/create', 'BreadController@createBread')->name('adminCreateBread');
    Route::any('/bread/{table}/edit', 'BreadController@editBread')->name('adminEditBread');
    Route::any('/bread/edit/{table}/rows', 'BreadController@editRowsBread')->name('adminEditRowsBread');
    Route::any('/database/table/view/{table}', 'DatabaseController@viewTable')->name('adminViewTable');
    Route::any('/bread/update/status', 'BreadController@updateBreadStatus')->name('updateBreadStatus');

    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Routing
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/routes', 'RouteController@routeIndex')->name('adminRouteIndex');
    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Pages
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/pages', 'PageController@pageIndex')->name('adminPageIndex');
    Route::any('/page/add', 'PageController@pageAdd')->name('adminPageAdd');
    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Posts
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/posts', 'PostController@postIndex')->name('adminPostIndex');
    Route::any('/post/add', 'PostController@postAdd')->name('adminPostAdd');
    Route::any('/post/edit', 'PostController@postEdit')->name('adminPostEdit');
    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Users
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/users/list', 'UserController@userIndex')->name('adminUserIndex');
    Route::any('/user/profile', 'UserController@userProfile')->name('adminUserProfile');

    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     all Bread Operation
      |-------------------------------------------------------------------------------------------------------------------
     */
    $abc = \Illuminate\Support\Facades\DB::table('breads')->get();
    foreach ($abc as $key => $bread) :
//        dd($bread);
        Route::any($bread->slug.'/browse', 'BreadController@breadBrowse')->name('adminBreadBrowse');
        Route::any($bread->slug.'/browse', function () use ($bread) {
            echo base64_encode('asdfasdf').'<br>';
            echo 'Hello this is ' . $bread->display_singular . ' page';
        });
        Route::any($bread->slug.'/add', function () use ($bread) {
            echo base64_encode('asdfasdf').'<br>';
            echo 'Hello this is ' . $bread->display_singular . ' page';
        });
        Route::any($bread->slug.'/edit/{id}', function ($id) use ($bread) {
            $encoded = base64_encode($id);
            echo $encoded .'<br>';
            echo base64_decode($encoded).'<br>';
            echo 'Hello this is ' . $bread->display_singular . ' Edit page id';
        });
        Route::any($bread->slug.'/view/{id}', function ($id) use ($bread) {
            $encoded = base64_encode($id);
            echo $encoded .'<br>';
            echo base64_decode($encoded).'<br>';
            echo 'Hello this is ' . $bread->display_singular . ' View page id';
        });
    endforeach;

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
        $class = new ReflectionClass(YPC\Ripple\Support\Blade\RippleBlade::class);
//        dd($class, $RippleBLADE);
        foreach ((new ReflectionClass(YPC\Ripple\Support\Blade\RippleBlade::class))->getMethods() as $RippleBlade)
        {
            $RippleBLADE->{$RippleBlade->name}();
//            dd($RippleBlade, $RippleBlade);
//            dd()
        }
    });
});

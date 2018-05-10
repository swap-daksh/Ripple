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

//use YPC\Ripple\Support\Blade\RippleBlade;
use YPC\Ripple\Support\Facades\Ripple;
use Illuminate\Support\Facades\Session;

//use Illuminate\Database\DatabaseManager;
//use Doctrine\DBAL\Schema\SchemaException;
//use Doctrine\DBAL\Schema\Table as DoctrineTable;
Route::group(['as' => 'Ripple::', 'namespace' => config('ripple.controllers.namespace', 'YPC\Ripple\Http\Controllers'), 'middleware' => ['web'], 'prefix' => 'admin'], function () {
    /*
     |-----------------------------------------------------------------------
     |  Authentication Routes
     |-----------------------------------------------------------------------
    */
    Route::get('/login', 'AdminAuthController@showLoginForm')
    ->name('adminLoginForm');
    
    Route::post('/login-admin', 'AdminAuthController@adminLogin')
    ->name('adminLoginAttempt');
    
    Route::post('/logout', 'AdminAuthController@adminLogin')
    ->name('adminLogout');
});

Route::group(['as' => 'Ripple::', 'namespace' => config('ripple.controllers.namespace', 'YPC\Ripple\Http\Controllers'), 'middleware' => ['web', 'RedirectIfNotAdmin'], 'prefix' => 'admin'], function () {
    /*
      |----------------------------------------------------------------------
      | Admin Route
      |----------------------------------------------------------------------
     */
    Route::any('/', 'RippleController@dashboard')->name('dashboard');




    /*
      |----------------------------------------------------------------------
      |  User Roles
      |----------------------------------------------------------------------
     */
    Route::any('/roles', "RoleController@rolesIndex")
    ->name('adminIndexRoles');
    



    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                              Settings
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/setting/modules', 'SettingsController@settingModule')
    ->name('settingModule');

    Route::any('/settings/{type}', 'SettingsController@settings')
    ->where(['type' => '[a-z]+'])
    ->name('adminSettings');
    Route::any('/setting/create', 'SettingsController@createSetting')
    ->name('adminCreateSetting');

    Route::post('/setting/delete', 'SettingsController@deleteSetting')
    ->name('adminDeleteSetting');

    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                              Database
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/database/modules', 'DatabaseController@databaseModule')
    ->name('databaseModule');

    Route::get('/database', 'DatabaseController@database')
    ->name('adminDatabase');

    Route::any('/database/create', 'DatabaseController@createTable')
    ->name('adminCreateTable');

    Route::any('/database/table/view/{table}', 'DatabaseController@viewTable')
    ->name('adminViewTable');

    Route::any('/database/table/relationship', 'DatabaseController@tableRelationship')
    ->name('databaseTableRelationship');

    Route::any('/database/delete/relation/{id}', 'DatabaseController@deleteTableRelation')
    ->name('deleteTableRelation');

    Route::any('/database/table/breads', 'DatabaseController@tableBreads')
    ->name('databaseTableBreads');


    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                              CRUD/BREAD
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/bread/{table}/create', 'BreadController@createBread')
    ->name('adminCreateBread');

    Route::any('/bread/{table}/edit', 'BreadController@editBread')
    ->name('adminEditBread');

    Route::any('/bread/{table}/delete', 'BreadController@deleteBread')
    ->name('adminDeleteBread');


    Route::any('/bread/edit/{table}/rows', 'BreadController@editRowsBread')
    ->name('adminEditRowsBread');

    Route::any('/database/table/view/{table}', 'DatabaseController@viewTable')
    ->name('adminViewTable');

    Route::any('/bread/update/status', 'BreadController@updateBreadStatus')
    ->name('updateBreadStatus');

    Route::any('/bread/modules', 'BreadController@listBreads')
    ->name('breadModule');


    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Routing
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/routes', 'RouteController@routeIndex')
    ->name('adminRouteIndex');

    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Pages
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/pages', 'PageController@pageIndex')
    ->name('adminPageIndex');

    Route::any('/page/add', 'PageController@pageAdd')
    ->name('adminPageAdd');

    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Posts
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/posts', 'PostController@postIndex')
    ->name('adminPostIndex');

    Route::any('/post/add', 'PostController@postAdd')
    ->name('adminPostAdd');

    Route::any('/post/edit', 'PostController@postEdit')
    ->name('adminPostEdit');


    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Categories
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/categories', 'CategoryController@categoriesIndex')
    ->name('adminIndexCategories');

    Route::any('/category/add', 'CategoryController@categoriesAdd')
    ->name('adminAddCategories');

    Route::any('/category/edit/{id}', 'CategoryController@categoryEdit')
    ->name('adminEditCategory');



    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Users
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::resource('users', 'UserController');

    # Product routes
    Route::resource('products', 'ProductController');


    /*
     |---------------------------------------------------------------------------------------------------------------------
     |                                    User Roles
     |---------------------------------------------------------------------------------------------------------------------
     */

    Route::resource('roles', 'RoleController');

     /*
     |---------------------------------------------------------------------------------------------------------------------
     |                                    Dealer Roles
     |---------------------------------------------------------------------------------------------------------------------
     */

    Route::resource('dealer', 'DealerController');

    Route::group(['prefix'=>'dealers'], function () {

        Route::any('approved', 'DealerController@showApproved')->name('dealerApproved');
        Route::any('unapproved', 'DealerController@showUnapproved')->name('dealerUnapproved');
        Route::any('sold', 'DealerController@showSold')->name('dealerSold');
    });


    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     All Bread Operation
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::group(['middleware' => ['hasBreadEnabled']], function () {
        Route::any('{slug}/browse', 'BreadController@breadBrowse')
        ->where('slug', Ripple::hasBreadSlug())
        ->name('adminBreadBrowse');

        Route::any('{slug}/add', 'BreadController@breadAdd')
        ->where('slug', Ripple::hasBreadSlug())
        ->name('adminBreadAdd');

        Route::any('{slug}/edit/{id}', 'BreadController@breadEdit')
        ->where('slug', Ripple::hasBreadSlug())
        ->name('adminBreadEdit');

        Route::any('{slug}/view/{id}', 'BreadController@breadView')
        ->where('slug', Ripple::hasBreadSlug())
        ->name('adminBreadView');

        Route::any('{slug}/delete/{id}', 'BreadController@breadDelete')
        ->where('slug', Ripple::hasBreadSlug())
        ->name('adminBreadDelete');
    });


    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                                     Api Management
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/passport', 'PassportController@appPassport')
    ->name('appPassport');


    /*
     |-------------------------------------------------------------------------------------------------------------------
     |                                      Ajax Routes
     |-------------------------------------------------------------------------------------------------------------------
    */
    Route::group(['prefix'=>'ajax'], function () {
        Route::post('sync/column', 'AjaxController@synchronizedColumn')
        ->name('ajaxGetSynchronizedColumn');
    });


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

        $class = get_class(\Illuminate\Support\Facades\Storage::getFacadeRoot());
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
    Route::get('/test', function () {
        return view('Ripple::test');
    });
    Route::get('/testing-abc', function () {
        $RippleBLADE = new RippleBlade();
        $class = new ReflectionClass(YPC\Ripple\Support\Blade\RippleBlade::class);
        //        dd($class, $RippleBLADE);
        foreach ((new ReflectionClass(YPC\Ripple\Support\Blade\RippleBlade::class))->getMethods() as $RippleBlade) {
            $RippleBLADE->{$RippleBlade->name}();
            //            dd($RippleBlade, $RippleBlade);
            //            dd()
        }
    });
});

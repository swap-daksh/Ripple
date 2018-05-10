<?php
namespace YPC\Ripple\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use YPC\Ripple\Support\Faker\FileFactory;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{


    /**
     * Show all roles
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = DB::table('rpl_roles')->get();
        return view('Ripple::roles.index', compact('roles'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(url(Storage::url(Storage::putFile('public', (new FileFactory())->image('test.png', 1000, 1000)))));
        //dd((new FileFactory())->image('test.jpg', 100, 200)->store());
        //dd(Storage::putFile('public', (new FileFactory())->image('test.jpg', 1000, 1000)));
        return view('Ripple::roles.create');
    }


    /**
     * Display the specified resource.'
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = DB::table('rpl_roles')->where('id', $id)->first();
        return view('Ripple::roles.show', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = $request->role;
        $id = DB::table('rpl_roles')->insertGetId($role);
        return redirect()->route('Ripple::roles.index', ['id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = DB::table('rpl_roles')->where('id', $id)->first();
        
        return view('Ripple::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = $request->role;
        if (DB::table('rpl_roles')->where('id', $id)->update($role)) {
                return redirect()->route('Ripple::roles.edit', ['id'=>$id]);
        }
        return redirect()->route('Ripple::roles.edit', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (DB::table('rpl_roles')->where('id', $id)->delete()) {
            return redirect()->route('Ripple::roles.index');
        }
    }
}

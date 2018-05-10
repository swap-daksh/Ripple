<?php
namespace YPC\Ripple\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use YPC\Ripple\Support\Faker\FileFactory;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('Ripple::users.index', compact('users'));
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
        return view('Ripple::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user;
        $user['avatar'] = $this->userImage('user_image');
        $id = DB::table('users')->insertGetId($user);
        return redirect()->route('Ripple::users.edit', ['id'=>$id]);
    }

    /**
     * Display the specified resource.'
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('Ripple::users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        
        return view('Ripple::users.edit', compact('user'));
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
        $user = $request->user;
        if ($userImage = $this->userImage('user_image', true)) {
            $user['avatar'] = $userImage;
        }
        if (user::where('id', $id)->update($user)) {
                return redirect()->route('Ripple::users.edit', ['id'=>$id]);
        }
        return redirect()->route('Ripple::users.edit', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (user::where('id', $id)->delete()) {
            return redirect()->route('Ripple::users.index');
        }
    }


    private function userImage($file, $update = false)
    {
        if (request()->hasFile($file)) {
            return storeFileAs($file, 'user-'.str_slug(request('user')['name']).md5(strtotime(date('Y-m-d'))));
        }
        if ($update) {
            return false;
        }
        return Storage::putFile(
            'public',
            (new FileFactory())
            ->image('user-'.str_slug(request('user')['name']).md5(strtotime(date('Y-m-d'))).'.png', 1000, 1000)
        );
    }
}


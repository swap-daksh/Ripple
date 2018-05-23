<?php
namespace YPC\Ripple\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use YPC\Ripple\Support\Faker\FileFactory;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\Maker;
use Auth;

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
     * Display User Profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        return view('Ripple::users.show', compact('user'));
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
        $roles = DB::table('rpl_roles')->get();
        $makers = Maker::get();
        return view('Ripple::users.create', compact('roles', 'makers'));
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

        $metas = $request->meta;
        if ($userImage = $this->userImage('user_avatar', true)) {
            $user['avatar'] = $userImage;
        }
        if ($metaLogo = $this->metaImage('meta_logo', true)) {
            $metas['logo'] = $metaLogo;
        }
        $user['avatar'] = $userImage;
        $metas['maker'] = implode(",", $metas['maker']);

        $id = DB::table('users')->insertGetId($user);

        #Get key and value of User Meta and process it for bulk insert
        
        foreach ($metas as $key => $meta) {
            UserMeta::updateOrCreate(array('user_id'=> $id,'meta_key'=>$key, 'meta_value'=>$meta));
        }


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
        $meta = UserMeta::where('user_id', $id)->pluck('meta_value', 'meta_key');
        return view('Ripple::users.show', compact('user', 'meta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $makers = Maker::get();
        $roles = DB::table('rpl_roles')->get();
        $user = User::where('id', $id)->first();
        $meta = UserMeta::where('user_id', $id)->pluck('meta_value', 'meta_key');
        return view('Ripple::users.edit', compact('user', 'roles', 'meta', 'makers'));
    }

    /**
     * Show the form for editing User Profile
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        $makers = Maker::get();
        $id = Auth::user()->id;
        $roles = DB::table('rpl_roles')->get();
        $meta = UserMeta::where('user_id', $id)->pluck('meta_value', 'meta_key');
        $user = User::where('id', $id)->first();

        return view('Ripple::users.edit', compact('user', 'roles', 'meta', 'makers'));
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
        $password = request('new-password');
        $user = $request->user;
        $metas = $request->meta;
        $metas['maker'] = implode(",", $metas['maker']);
        if (!(empty($password))) {
            $user['password'] = bcrypt($password);
        }
        if ($userImage = $this->userImage('user_avatar', true)) {
            $user['avatar'] = $userImage;
        }
        if ($metaLogo = $this->metaImage('meta_logo', true)) {
            $metas['logo'] = $metaLogo;
        }

      
        #Get key and value of User Meta and process it for bulk insert
        $meta_array = array();
        $i = 0;
        foreach ($metas as $key => $meta) {
            UserMeta::updateOrCreate(array('user_id'=> $id,'meta_key'=>$key, 'meta_value'=>$meta));
            ++$i;
        }
  
        
        User::where('id', $id)->update($user);

        return redirect()->route('Ripple::users.edit', ['id'=>$id]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $password = request('new-password');
        $user = $request->user;
        $metas = $request->meta;
        $metas['maker'] = implode(",", $metas['maker']);
        
        if (!(empty($password))) {
            $user['password'] = bcrypt($password);
        }
        if ($userImage = $this->userImage('user_avatar', true)) {
            $user['avatar'] = $userImage;
        }
        if ($metaLogo = $this->metaImage('meta_logo', true)) {
            $metas['logo'] = $metaLogo;
        }

        #Get key and value of User Meta and process it for bulk insert
        $meta_array = array();
        $i = 0;
        foreach ($metas as $key => $meta) {
              $meta_array[$i]  =  array('user_id'=> $id,'meta_key'=>$key, 'meta_value'=>$meta);
              UserMeta::updateOrCreate($meta_array[$i]);
              ++$i;
        }

        return redirect()->route('Ripple::editProfile');
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
            $image =  storeFileAs($file, 'user-'.str_slug(request('user')['name']).md5(strtotime(date('Y-m-d'))));
            return $image;
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

    private function metaImage($file, $update = false)
    {
        if (request()->hasFile($file)) {
            $image =  storeFileAs($file, 'dealer-'.str_slug(request('user')['name']).md5(strtotime(date('Y-m-d'))));
            return $image;
        }
        if ($update) {
            return false;
        }
        return Storage::putFile(
            'public',
            (new FileFactory())
            ->image('dealer-'.str_slug(request('user')['name']).md5(strtotime(date('Y-m-d'))).'.png', 1000, 1000)
        );
    }
}

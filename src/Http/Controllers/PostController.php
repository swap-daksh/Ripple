<?php

namespace YPC\Ripple\Http\Controllers;

use YPC\Ripple\Support\Facades\Ripple;
use YPC\Ripple\Support\Traits\Posts;

class PostController extends Controller
{

    use Posts;

    public function postIndex()
    {
        return view('Ripple::posts.postIndex');
    }

    public function postAdd()
    {
        $categories = Ripple::allCategories();
        $tags = Ripple::allTags();
        if (self::createPost()):
            session()->flash('success', 'Post successfully created.');
            return redirect()->route('Ripple::adminPostEdit', ['post' => session('post')]);
        endif;
        return view('Ripple::posts.postAdd', compact('categories', 'tags'));
    }

    public function postEdit()
    {
        if($this->updatePost()){
            return back();
        }
         $post = $this->post(request('post'));
        return view('Ripple::posts.postEdit', compact('post'));
    }

}

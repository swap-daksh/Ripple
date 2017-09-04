<?php

namespace GitLab\Ripple\Support\Traits;
use GitLab\Ripple\Models\Post;
trait Posts {

    private function createPost() {
        if(request()->has('post-create')):
            $createPost = ['title'=>request('post-title'),'slug'=>request('post-title'),'content'=>request('post-content'),'image'=>request('post-image'),'author'=>request('post-author'),'comments'=>request('post-comments'),'categories'=>request('post-category'),'tags'=>request('post-tag'),'type'=>request('post-type'),'status'=>request('post-'),'visibility'=>request('post-visibility')];
        endif;
    }

}

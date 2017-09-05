<?php

namespace GitLab\Ripple\Support\Traits;

use GitLab\Ripple\Models\Post;
use Illuminate\Support\Facades\DB;

trait Posts {

    private function createPost() {
        if (request()->has('post-create')):
            $slug = $this->post_slug(str_slug(request('post-title'), '-'));
            $createPost = ['title' => request('post-title'), 'slug' => $slug, 'content' => request('post-content'), 'image' => storeFileAs('post-image', $slug), 'author' => request('post-author'), 'comments' => request('post-comments'), 'categories' => json_encode(request('post-category')), 'tags' => json_encode(request('post-tag')), 'type' => request('post-type'), 'status' => request('post-status'), 'visibility' => request('post-visibility')];
            $DBinsert = DBinsert(new Post(), $createPost);
            if ($DBinsert):
                session()->flash('success', 'Post successfully created.');
                return $DBinsert;
            endif;
        endif;
    }

    private function post_slug($slug, $count = 0, $table = 'posts', $column = 'slug') {
        if (DB::table($table)->where($column, $slug)->exists()):
            $count++;
            $slugArray = explode('-', $slug);
            if (is_numeric(end($slugArray))):
                $integer = (int) end($slugArray);
                array_pop($slugArray);
                $sufix = ++$integer;
            else:
                $sufix = $count;
            endif;
            return $this->post_slug(join('-', $slugArray) . '-' . $sufix, $count);
        else:
            return $slug;
        endif;
    }

}

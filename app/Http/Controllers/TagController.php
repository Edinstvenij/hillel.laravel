<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Tag;

class TagController
{
    public function index($tagId)
    {
        $tag = Tag::find($tagId);
        $posts = Post::with('categories', 'tags', 'users')->whereHas('tags', function ($tag) use ($tagId) {
            $tag->where('tag_id', $tagId);
        })->get();

        return view('tag/index', compact('posts', 'tag'));
    }

}

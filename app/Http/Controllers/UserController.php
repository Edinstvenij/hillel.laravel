<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;

class UserController
{
    public function index($authorId)
    {
        $author = User::find($authorId);
        return view('author/index', compact('author'));
    }

    public function category($authorId, $categoryId)
    {
//        $posts = Post::all()->where('user_id', $authorId)->where('category_id', $categoryId);   Как такой вариант? Если он плох то почему?

        $posts = Post::whereHas('users', function ($user) use ($authorId) {
            $user->where('id', $authorId);
        })->where('category_id', $categoryId)->get();
        return view('author/category', compact('posts'));
    }
}

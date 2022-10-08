<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController
{
    public function index()
    {
        $posts = Post::paginate(5);
        $paginator = $posts->getOptions();
        return view('home', compact('posts'));
    }
}

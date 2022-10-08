<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;

class AdminController
{
    public function index()
    {
        return view('admin/index');
    }

    public function category()
    {
        $categories = Category::all();
        return view('admin/category/index', compact('categories'));
    }
}

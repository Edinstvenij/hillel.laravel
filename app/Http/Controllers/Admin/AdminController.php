<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController
{
    public function index()
    {
        return view('admin/index');
    }


    /**
     * block CRUD Categories
     */
    public function category()
    {
        $categories = Category::all();
        return view('admin/category/index', compact('categories'));
    }

}

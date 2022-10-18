<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController
{
    public function index($categoryId)
    {
        $category = Category::with('posts.users','posts.categories')->find($categoryId);
        return view('category/index', compact('category'));
    }
}

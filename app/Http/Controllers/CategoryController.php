<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController
{
    public function index($authorId)
    {
        $categories = Category::find($authorId);
        return view('category/index', compact('categories'));
    }
}

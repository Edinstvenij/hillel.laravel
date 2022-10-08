<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController
{
    public function index($categoryId)
    {
        $category = Category::find($categoryId);
        return view('category/index', compact('category'));
    }
}

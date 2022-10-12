<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminCategoryController
{
    /**
     * block CRUD Categories
     */
    public function category()
    {
        $categories = Category::all();
        return view('admin/category/index', compact('categories'));
    }

    public function create()
    {
        return view('admin/category/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:2', 'max:255'],
            'slug' => ['required', 'min:2', 'max:255']
        ]);

        Category::create($request->all());
        return redirect()->route('adminCategory');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin/category/edit', compact('category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'title' => ['required', 'min:2', 'max:255'],
            'slug' => ['required', 'min:2', 'max:255']
        ]);

        Category::find($request->input('id'))->update($request->all());
        return redirect()->route('adminCategory');
    }

    /**
     *      function delete(Category $category)
     *      category->delete();
     *      Работает, а потом прекращает работать
     */
    public function delete($id)
    {
        Category::find($id)->delete();
        return redirect()->route('adminCategory');
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin/category/trash', compact('categories'));
    }

    public function restore($id)
    {
        Category::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('adminCategoryTrash');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->where('id', $id)->first();
        foreach ($category->posts as $post) {
            $post->tags()->detach();
            $post->forceDelete();
        }
        $category->forceDelete();
        return redirect()->route('adminCategoryTrash');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
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

    public function categoryCreate()
    {
        return view('admin/category/create');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:2', 'max:255'],
            'slug' => ['required', 'min:2', 'max:255']
        ]);

        Category::create($request->all());
        return redirect()->route('adminCategory');
    }

    public function categoryEdit($id)
    {
        $category = Category::find($id);
        return view('admin/category/edit', compact('category'));
    }

    public function categoryUpdate(Request $request)
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
    public function categoryDelete($id)
    {
        Category::find($id)->delete();
        return redirect()->route('adminCategory');
    }

    public function categoryTrash()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin/category/trash', compact('categories'));
    }

    public function categoryRestore($id)
    {
        Category::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('adminCategoryTrash');
    }

    public function categoryForceDelete($id)
    {
        $category = Category::onlyTrashed()->where('id', $id)->first();
        foreach ($category->posts as $post) {
            $post->tags()->detach();
            $post->forceDelete();
        }
        $category->forceDelete();
        return redirect()->route('adminCategoryTrash');

    }


    /**
     * block CRUD Tags
     */
    public function tag()
    {
        $tags = Tag::all();
        return view('admin/tag/index', compact('tags'));
    }

    public function tagCreate()
    {
        return view('admin/tag/create');
    }

    public function tagStore(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:2', 'max:255'],
            'slug' => ['required', 'min:2', 'max:255']
        ]);

        Tag::create($request->all());
        return redirect()->route('adminTag');
    }

    public function tagEdit($id)
    {
        $tag = Tag::find($id);
        return view('admin/tag/edit', compact('tag'));
    }

    public function tagUpdate(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'title' => ['required', 'min:2', 'max:255'],
            'slug' => ['required', 'min:2', 'max:255']
        ]);

        Tag::find($request->input('id'))->update($request->all());
        return redirect()->route('adminTag');
    }

    public function tagDelete($id)
    {
        Tag::find($id)->delete();
        return redirect()->route('adminTag');
    }

    public function tagTrash()
    {
        $tags = Tag::onlyTrashed()->get();
        return view('admin/tag/trash', compact('tags'));
    }

    public function tagRestore($id)
    {
        Tag::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('adminTagTrash');
    }

    public function tagForceDelete($id)
    {
        $tag = Tag::onlyTrashed()->where('id', $id)->first();
        foreach ($tag->posts as $post) {
            $post->tags()->detach();
        }
        $tag->forceDelete();
        return redirect()->route('adminTagTrash');

    }


    /**
     * block CRUD Posts
     */
    public function post()
    {
        $posts = Post::all();
        return view('admin/post/index', compact('posts'));
    }

    public function postCreate()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();
        return view('admin/post/create', compact('categories', 'tags', 'users'));
    }

    public function postStore(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'tags_id' => ['required'],
            'category_id' => ['required'],
            'title' => ['required', 'min:2', 'max:255'],
            'body' => ['required', 'min:2', 'max:255']
        ]);

        $post = Post::create($request->all());
        $post->tags()->sync($request->tags_id);
        return redirect()->route('adminPost');
    }

    public function postEdit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();
        return view('admin/post/edit', compact('post', 'tags', 'categories', 'users'));
    }

    public function postUpdate(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'tags_id' => ['required'],
            'category_id' => ['required'],
            'title' => ['required', 'min:2', 'max:255'],
            'body' => ['required', 'min:2', 'max:255']
        ]);

        $post = Post::find($request->input('id'));
        $post->update($request->all());
        $post->tags()->sync($request->tags_id);
        return redirect()->route('adminPost');
    }

    public function postDelete($id)
    {
        Post::find($id)->delete();
        return redirect()->route('adminPost');
    }

    public function postTrash()
    {
        $posts = Post::onlyTrashed()->get();
        return view('admin/post/trash', compact('posts'));
    }

    public function postRestore($id)
    {
        Post::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('adminPostTrash');
    }

    public function postForceDelete($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        $post->tags()->detach();
        $post->forceDelete();
        return redirect()->route('adminPostTrash');

    }
}

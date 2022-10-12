<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPostController
{
    /**
     * block CRUD Posts
     */
    public function post()
    {
        $posts = Post::all();
        return view('admin/post/index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();
        return view('admin/post/create', compact('categories', 'tags', 'users'));
    }

    public function store(Request $request)
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

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();
        return view('admin/post/edit', compact('post', 'tags', 'categories', 'users'));
    }

    public function update(Request $request)
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

    public function delete($id)
    {
        Post::find($id)->delete();
        return redirect()->route('adminPost');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->get();
        return view('admin/post/trash', compact('posts'));
    }

    public function restore($id)
    {
        Post::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('adminPostTrash');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        $post->tags()->detach();
        $post->forceDelete();
        return redirect()->route('adminPostTrash');

    }
}

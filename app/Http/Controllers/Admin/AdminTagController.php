<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;

class AdminTagController
{
    /**
     * block CRUD Tags
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin/tag/index', compact('tags'));
    }

    public function create()
    {
        return view('admin/tag/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:2', 'max:255'],
            'slug' => ['required', 'min:2', 'max:255']
        ]);

        Tag::create($request->all());
        return redirect()->route('adminTag');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin/tag/edit', compact('tag'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'title' => ['required', 'min:2', 'max:255'],
            'slug' => ['required', 'min:2', 'max:255']
        ]);

        Tag::find($request->input('id'))->update($request->all());
        return redirect()->route('adminTag');
    }

    public function delete($id)
    {
        Tag::find($id)->delete();
        return redirect()->route('adminTag');
    }

    public function trash()
    {
        $tags = Tag::onlyTrashed()->get();
        return view('admin/tag/trash', compact('tags'));
    }

    public function restore($id)
    {
        Tag::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('adminTagTrash');
    }

    public function forceDelete($id)
    {
        $tag = Tag::onlyTrashed()->where('id', $id)->first();
        foreach ($tag->posts as $post) {
            $post->tags()->detach();
        }
        $tag->forceDelete();
        return redirect()->route('adminTagTrash');

    }
}

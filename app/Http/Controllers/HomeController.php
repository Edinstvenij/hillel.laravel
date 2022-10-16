<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Rating;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with(['users', 'categories', 'tags', 'ratings'])->paginate(5);
        $allRating = 0;
        return view('home', compact('posts', 'allRating'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('post/show', compact('post'));
    }

    public function addRating(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'rating' => ['required', 'int'],
        ]);

        $rating = new Rating();
        $rating->rating = $request->input('rating');
        $rating->ratingable_id = $request->input('id');
        $rating->ratingable_type = Post::class;
        $rating->save();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Rating;
use Dcblogdev\Dropbox\Facades\Dropbox;
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

    public function test()
    {

        Dropbox::files()->upload('/public', base_path() . '/test.txt');
        Dropbox::files()->upload('/public', base_path() . '/' . 'README.md');

        Dropbox::files()->upload('/private', base_path() . '/' . '.env');
        Dropbox::files()->upload('/private', base_path() . '/artisan');

        Dropbox::files()->download('/private/.env', base_path() . '/storage/app/download_');
        Dropbox::files()->download('/public/README.md', base_path() . '/storage/app/public/download_');

        Dropbox::files()->listContents('/public');
        Dropbox::files()->listContents('/private');


        $folderContent = Dropbox::files()->listContents('/public');
        $entries = $folderContent['entries'];

        while ($folderContent['has_more']) {
            $folderContent = Dropbox::files()->listContentsContinue($folderContent['cursor']);
            $entries = array_merge($entries, $folderContent['entries']);
        }
        $result = [];
        foreach ($entries as $entry) {
            //if you want to ignore the folders
            if ($entry['.tag'] === 'folder') {
                continue;
            }

            $result['public'][] = [
                'path' => $entry['path_lower'],
                'name' => $entry['name'],
                'id' => $entry['id'],
                'size' => $entry['size'],
            ];
        }


        $folderContent = Dropbox::files()->listContents('/private');
        $entries = $folderContent['entries'];

        while ($folderContent['has_more']) {
            $folderContent = Dropbox::files()->listContentsContinue($folderContent['cursor']);
            $entries = array_merge($entries, $folderContent['entries']);
        }

        foreach ($entries as $entry) {
            //if you want to ignore the folders
            if ($entry['.tag'] === 'folder') {
                continue;
            }

            $result['private'][] = [
                'path' => $entry['path_lower'],
                'name' => $entry['name'],
                'id' => $entry['id'],
                'size' => $entry['size'],
            ];
        }
        dd($result);
    }
}

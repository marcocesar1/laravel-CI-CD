<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::query()->latest()->get();

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $post = new \App\Models\Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return response()->json([
            'data' => $post,
        ]);
    }
}

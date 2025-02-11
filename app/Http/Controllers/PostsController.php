<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\GenericService;

class PostsController extends GenericController
{
    public function __construct()
    {
        parent::__construct(
            service: new class(
                model: new Post(),
            ) extends GenericService {}
        );
    }

    public function index()
    {
        $posts = \App\Models\Post::query()->latest()->get();

        return response()->json([
            'data' => $posts,
        ]);
    }
}

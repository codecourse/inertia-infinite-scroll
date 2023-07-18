<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $posts = Post::latest()->paginate(10);

        if ($request->wantsJson()) {
            return PostResource::collection($posts);
        }

        return inertia()->render('Posts/Index', [
            'posts' => PostResource::collection($posts)
        ]);
    }
}

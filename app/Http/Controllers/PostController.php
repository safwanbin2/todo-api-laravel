<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();

        return response()->json([
            'message' => "Posts fetched successfully",
            'posts' => $posts,
        ]);
    }

    public function store()
    {
        $post = request()->validate([
            'title' => ['required', 'min:1', 'max:20'],
            'content' => ['required', 'min:1', 'max:255']
        ]);

        Post::create($post);

        return response()->json([
            'message' => "Post created successfully",
            'data' => null
        ]);
    }

    public function update($id)
    {

        // if (! Gate::allows('update-post')) {
        //     return response()->json([
        //         "message" => "You are not authorized!"
        //     ]);
        // }


        if (Gate::denies('update-post')) {
            return response()->json([
                "message" => "Not authorized"
            ]);
        }

        $attributes = request()->validate([
            'title' => ['required', 'min:1', 'max:20'],
            'content' => ['required', 'min:1', 'max:255']
        ]);
        $post = Post::find($id);
        $result = $post->update($attributes);
        return response()->json([
            'message' => "Post updated successfully",
            'data' => $result
        ]);
    }
}

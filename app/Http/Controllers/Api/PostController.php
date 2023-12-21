<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Post::all();
        // return PostResource::collection(Post::all());
        return new PostCollection(Post::all());
        // return new PostCollection(Post::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     'title' => 'required|max:255|unique:posts',
        //     'body' => 'required|min:10|max:2000'
        // ]);
        // $post = Post::create($request->only([
        //     'title',
        //     'body',
        // ]));

        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->save();

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // http://posts.test/api/posts/5
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // PUT Method: The entire resource is replaced
        // If the resource doesn't exist, it will be created
        
        // PATCH Method: Update are only a part of the resource
        $post->update($request->only([
            'title', 'body'
        ]));

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }
}

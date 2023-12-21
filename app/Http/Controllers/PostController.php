<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::orderBy('title', 'desc')->get();
        // $posts = Post::where('body', 'like', '%Rerum%')
        //             ->orderBy('title', 'desc')
        //             ->get();

        // Retrienving Single Models
        // $post = Post::where('body', 'like', '%Rerum%')->first();
        // $post = Post::firstWhere('body', 'like', '%molestias%');
        // $post = Post::find(1);


        // $post = Post::findOr(11, function() {
        //     return "No Post Found";
        // });
        // $post = Post::findOrFail(11);

        // $post = Post::where('body', 'like', 'abc')->firstOr(function() {
        //     return "No posts with abc content";
        // });
        // $post = Post::where('body', 'like', '%abc%')->firstOrFail();

        
        // echo $post->id . '<br>';
        // echo $post->body;
        // echo '<br>';
        // var_dump($posts);
        // die();

        // foreach ($posts as $post) {
        //     echo $post->title;
        //     echo '<br>';
        // }
        // $posts = Post::where('title', 'Vel unde.')->get();

        // die();
        // ddd($posts);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Gate::denies('create')) {
            abort(403, 'You do not have permission');
        }

        // $inspect = Gate::inspect('create');
        // if(!$inspect->allowed()) {
        //     // echo $inspect->message();
        //     die();
        // } 
    
        // Gate::authorize('create');

        // var_dump($request);
        // die();

        $request->validate([
            'title' => 'required|max:255|unique:posts',
            'body' => 'required|max:2000',
            'image' => 'nullable|image|max:2048|mimes:png,jpg,jpeg,gif,svg'
        ]);

        // $post = new Post;
        // $post->title = $request->title;
        // $post->body = $request->body;
        
        $imageName = null;
        if($request->hasFile('image')) {
            $imageName = time(). '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            // $post->image = $imageName;
        } 
        

        $post = $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $imageName
        ]);

        // $post->save();


        // return to_route('post.show', ['post' => $post->id]);
        return redirect()->route('posts.index')
                ->with('post_created', "The post $post->title has created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // if(! Gate::allows('update-post', $post)) {
        //     abort(403);
        // }
        Gate::authorize('update', $post);

        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:2000'
        ]);

        if($request->hasFile('image')) {
            $imageName = time(). '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->update([
                'title' => $request->title,
                'body' => $request->body,
                'image' => $imageName
            ]);
        }  else {
            $post->update([
                'title' => $request->title,
                'body' => $request->body
            ]);
        }
        
        return to_route('posts.show', $post);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        Gate::authorize('delete', $post);


        $post->delete();

        return to_route('posts.index')->with('post_deleted', 'The Post Was Deleted');
    }
}

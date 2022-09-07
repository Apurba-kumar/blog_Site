<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    //to create a middleware
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    public function index()
    {
        $posts = Post::latest()->get();
        return view('blogposts.blog', compact('posts'));
    }
    // public function show($slug)
    // {
    //     $post = Post::where('slug', $slug)->first();
    //     return view('blogposts.single_blog_post', compact('post'));
    // }

    //using route model binding
    public function show(Post $post){
        return view('blogposts.single_blog_post', compact('post'));
    }

    public function edit(Post $post){
        if(auth()->user()->id !== $post->user->id){
            abort(403);
        }
        return view('blogposts.edit_blog_post', compact('post'));
    }

    public function update(Request $request,Post $post){
        if(auth()->user()->id !== $post->user->id){
            abort(403);
        }
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required'
        ]);
        $postId = $post->id;
        $title = $request->input('title');
        $slug = Str::slug($title, '-').'-' . $postId;


        $body = $request->input('body');

        $imagePath = 'storage/' . $request->file('image')->store('postImages', 'public');

        $post->title = $title;
        $post->slug = $slug;



        $post->body = $body;
        $post->imagePath = $imagePath;
        $post->save();

        return redirect()->back()->with('status', 'Post edited successfully ! ');
    }



    public function create()
    {
        return view('blogposts.create_blog_post');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required'
        ]);
        $postId = Post::latest()->take(1)->first()-> id +1;
        $title = $request->input('title');
        $slug = Str::slug($title, '-').'-' . $postId;
        // $user_id = optional(Auth::user())->id;
        $user_id = Auth::user()->id;

        $body = $request->input('body');

        $imagePath = 'storage/' . $request->file('image')->store('postImages', 'public');

        $post = new Post();
        $post->title = $title;
        $post->slug = $slug;
        $post->user_id = $user_id;
        // $post->user_id = request()->$user_id;

        $post->body = $body;
        $post->imagePath = $imagePath;
        $post->save();

        return redirect()->back()->with('status', 'Post create successfully ! ');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('blogposts.blog', compact('posts'));
    }
    public function show($slug){
        $post = Post::where('slug', $slug)->first();
        return view('blogposts.single_blog_post', compact('post') );
    }
    public function create(){
        return view('blogposts.create_blog_post');
    }
    public function store(Request $request)
    {
        $request->validate([
          'title'=>'required',
          'image'=>'required | image',
          'body'=>'required'
        ]);
        $title = $request->input('title');
        $slug = Str::slug($title,'-');
        // $user_id = optional(Auth::user())->id;
        $user_id = Auth::user()->id;

        $body = $request->input('body');

        $imagePath= 'storage/'. $request->file('image')->store('postImages', 'public');

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

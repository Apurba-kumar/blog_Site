<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(){
        return view('blogposts.blog');
    }
    public function show(){
        return view('blogposts.single_blog_post');
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

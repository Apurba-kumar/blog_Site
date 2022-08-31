<?php

namespace App\Http\Controllers;

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
        $user_id = optional(Auth::user())->id;

        $body = $request->input('body');

        $imagePath= 'storage/'. $request->file('image')->store('postImages', 'public');
        dd('passed');
    }
}

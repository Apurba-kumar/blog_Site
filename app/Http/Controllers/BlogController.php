<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        dd('passed');
    }
}

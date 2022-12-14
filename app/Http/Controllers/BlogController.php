<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Category;

class BlogController extends Controller
{

    //to create a middleware
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    public function index(Request $request)
    {
        if($request->search){
            $posts = Post::where('title','like', '%'.$request->search .'%')
            ->orWhere('body','like', '%'.$request->search .'%')->latest()->paginate(4);
        }elseif($request->category){
            $posts = Category::where('name', $request->category)->firstOrFail()->posts()->paginate(2)->withQueryString();
        }else{
            $posts = Post::latest()->paginate(4);
        }
        $categories = Category::all();
        return view('blogposts.blog', compact('posts','categories'));
    }
    // public function show($slug)
    // {
    //     $post = Post::where('slug', $slug)->first();
    //     return view('blogposts.single_blog_post', compact('post'));
    // }

    //using route model binding
    public function show(Post $post){
        $category = $post->category;

        $relatedPosts = $category->posts()->where('id', '!=', $post->id)->latest()->take(3)->get();
        return view('blogposts.single_blog_post', compact('post', 'relatedPosts'));
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
        $categories = Category::all();
        return view('blogposts.create_blog_post', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required',
           'category_id' => 'required'
        ]);

        $title = $request->input('title');
        $category_id = $request->input('category_id');

       if(Post::latest()->first() !== null){
        $postId = Post::latest()->first()->id + 1;
       } else{
           $postId = 1;
       }
        $slug = Str::slug($title, '-').'-' . $postId;
        // $user_id = optional(Auth::user())->id;
        $user_id = Auth::user()->id;

        $body = $request->input('body');

        $imagePath = 'storage/' . $request->file('image')->store('postImages', 'public');

        $post = new Post();
        $post->title = $title;
        $post->category_id = $category_id;
        $post->slug = $slug;
        $post->user_id = $user_id;
        // $post->user_id = request()->$user_id;

        $post->body = $body;
        $post->imagePath = $imagePath;
        $post->save();

        return redirect()->back()->with('status', 'Post create successfully ! ');
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->back()->with('status','Post Delete sucessfully');
    }

}

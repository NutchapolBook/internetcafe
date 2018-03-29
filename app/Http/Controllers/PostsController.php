<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostsController extends Controller
{
    public function __construct(){
      $this->middleware('auth')->except(['index','show']);
    }
    public function index(){
      // $posts = Post::all();
      $posts = Post::latest()->get();
      return view('posts.index',compact('posts'));
    }

    public function create(){
      return view('posts.create');
    }

    public function store(){
      $this->validate(request(),[
        'title' => 'required',
        'body' => 'required'
      ]);
    // dd(request(['title','body']));
    #create post from request and save to DB
    // $post = new Post;
    // $post->title = request('title');
    // $post->body = request('body');

    //or

    $id = Auth::id();

    Post::create([
      'title'=>request('title'),
      'body' => request('body'),
      'user_id' => $id
    ]);

    //or
    //Post::create(request(['title','body','user_id']));


    //post::create(request()->all());

    // save to DB
    // $post->save();

    //
    // #And to homepage
    return redirect('/');
    }

    public function show(Post $post){
      return view('posts.show',compact('post'));
    }


}

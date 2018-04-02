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
      $cafename = Auth::user()->cafename;
      $posts = Post::latest()
                ->where('cafename','=',$cafename)
                ->get();
      return view('posts.index',compact('cafename','posts'));
    }

    public function create(){
        $cafename = Auth::user()->cafename;
        return view('posts.create',compact('cafename'));
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
    $cafename = Auth::user()->cafename;

    Post::create([
      'title'=>request('title'),
      'body' => request('body'),
      'user_id' => $id,
      'cafename' => $cafename,
    ]);

    //or
    //Post::create(request(['title','body','user_id']));


    //post::create(request()->all());

    // save to DB
    // $post->save();

    //
    // #And to homepage
    return redirect()->route('cafe.promotions.index',compact('cafename'));
    }

    public function show( $cafename  , Post $post){
        $cafename = Auth::user()->cafename;
        return view('posts.show',compact('post','cafename'));
    }


}

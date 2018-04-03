<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function store($cafename ,Post $post){
        $cafename = Auth::user()->cafename;
        // $user_id =  Auth::user()->id;
        $post->addComment(request('body'));

      return back();

    }
}

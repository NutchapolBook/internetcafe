<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $table = 'posts'; //ระบุ talble
    protected $fillable = ['title','body','user_id','cafename']; //สามารถแสดง ใส่ได้แค่นี้

    public function comments(){
      return $this->hasMany(Comment::class);
    }

    public function addComment($body){
      // Comment::create([
      //     'body'=> $body,
      //     'post_id'=>   $this->id
      // ]);
      //or
      $this->comments()->create(compact('body'));
    }

    public function user(){ //การเรียกใช้ $comment->post->name
      return $this->belongsTo(User::class);
    }
}

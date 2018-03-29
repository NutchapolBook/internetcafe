<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments'; //ระบุ talble
    protected $fillable = ['body','post_id'];

    public function post(){
      return $this->belongsTo(Post::class);
    }

    public function user(){ //การเรียกใช้ $comment->user->name
      return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password','role','cafename','status','tojson','tojson2','tojson3','tojson4','tojson5','tojson6','tojson7'
        ,'tojson8','tojson9','tojson10','tojson11','tojson12','tojson13','tojson14','tojson15','tojson16','tojson17','tojson18'
        ,'tojson19','tojson20','tojson21','tojson22','tojson23','tojson24'
    ];

    // protected $table = 'seat';
    // protected $fillable = [
    //     'name', 'email', 'cafename','seatname','amount','time','status'
    // ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function posts(){
      return $this->hasMany(Post::class);
    }
}

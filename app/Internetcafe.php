<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internetcafe extends Model
{
    protected $table = 'internetcafes';
    protected $fillable = [
        'name', 'colour', 'price', 'location','tel','facebook' , 'line' ,'picture' ,'picture2','picture3' , 'icon'
    ];
}

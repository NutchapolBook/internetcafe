<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internetcafe extends Model
{
    protected $table = 'internetcafes';
    protected $fillable = [
        'name', 'colour', 'location','tel','facebook' , 'line' ,'picture' , 'icon'
    ];
}

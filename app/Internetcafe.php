<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internetcafe extends Model
{
    protected $table = 'Internetcafe';
    protected $fillable = [
        'cafename', 'colour', 'location','tel','facebook' , 'line'
    ];
}

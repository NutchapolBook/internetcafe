<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addcredit extends Model
{
    protected $table = 'addcredits';
    protected $fillable = [
        'user_id', 'admin_id', 'amount','code','cafename','status'
    ];
}

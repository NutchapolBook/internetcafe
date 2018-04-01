<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class EditseatController extends Controller
{
    public function index(){
        return view('editseat.index');

    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AddcreditController extends Controller
{
    public function index($cafename){
        $cafename = Auth::user()->cafename;
        return view('addcredit.index',compact('cafename'));

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class BookingController extends Controller
{
    public function index(){
        $cafename = Auth::user()->cafename;
        return view('booking.index',compact('cafename'));

    }

    public function cancle(){
        $cafename = Auth::user()->cafename;
        return view('booking.cancle',compact('cafename'));

    }

}

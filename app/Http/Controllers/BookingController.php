<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class BookingController extends Controller
{
    public function index(){
        return view('Booking.index');

    }

    public function cancle(){
        return view('Booking.cancle');

    }

}

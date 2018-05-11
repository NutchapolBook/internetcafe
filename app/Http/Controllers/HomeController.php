<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function indexCafe($cafename)
    {
        $cafe = DB::table('internetcafes')
           ->where('name','=',$cafename)
           ->get();
        //dd($cafe);
        return view('homeCafe',compact('cafe','cafename'));
    }

    public function about()
    {
        return view('about');
    }

    public function aboutCafe($cafename)
    {
        $cafe = DB::table('internetcafes')
           ->where('name','=',$cafename)
           ->get();
        //dd($cafe);
        return view('aboutCafe',compact('cafe','cafename'));
    }
}

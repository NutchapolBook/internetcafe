<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class SessionsController extends Controller
{
  public function __construct(){
    $this->middleware('guest',['except'=>'destroy']);
  }

  public function create(){
      $cafenames = DB::table('internetcafes')
              ->select('name')
              ->get();
      //dd($cafenames);
    return view('sessions.create',compact('cafenames'));
  }

  public function destroy(){
    auth()->logout();
    return redirect()->home();
  }

  public function store(Request $request){
    if (!auth()->attempt(request(['email','password','role']))) {
      return back()->withErrors([
        'message' => 'Role , Email or Password does not match.'
      ]);
    }
    if(Auth::user()->status === "disable"){
        auth()->logout();
        return redirect()->back()->withErrors([
          'message' => 'This account has been banned.'
        ]);
    }
    //dd($request);
    if (Auth::user()->role === "admin")
        {
            $cafename = Auth::user()->cafename;
        }
    else
        {
            $cafename = request('cafename');
            $data = DB::table('users')
                        ->where([
                          ['name',Auth::user()->name],
                          ['email',Auth::user()->email]
                        ])
                        ->update([
                          'cafename'=> $cafename,
                        ]);
        }
    //dd($cafename);
    //if so sign them in
    //redired to home
    //return redirect()->route('home',compact('cafename'));
    return redirect()->route('cafe.indexCafe',compact('cafename'));
  }


}

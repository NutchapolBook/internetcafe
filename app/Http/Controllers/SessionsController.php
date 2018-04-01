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
    $cafenames = DB::table('users')
            ->whereNotNull('cafename')
            ->get();
    //dd($cafenames);
    return view('sessions.create',compact('cafenames'));
  }

  public function destroy(){
    auth()->logout();
    return redirect()->home();
  }

  public function store(Request $request){
    if (!auth()->attempt(request(['email','password']))) {
      return back()->withErrors([
        'message' => 'email or password does not match.'
      ]);
    }

    //dd($request);

    $cafename = request('cafename');
    //
    //dd($cafename);

    //if so sign them in
    //redired to home
    return redirect()->route('homeCafe',compact('cafename'));
  }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{

  public function __construct(){
    $this->middleware('guest',['except'=>'destroy']);
  }

  public function create(){
    return view('sessions.create');
  }

  public function destroy(){
    auth()->logout();
    return redirect()->home();
  }

  public function store(){
    if (!auth()->attempt(request(['email','password']))) {
      return back()->withErrors([
        'message' => 'email or password does not match.'
      ]);
    }

    //if so sign them in
    //redired to home
    return redirect()->home();
  }


}

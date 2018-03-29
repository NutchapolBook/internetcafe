<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function create(){
        return view('registration.create');

    }

    public function store(Request $request) {
      //validate form
      $this->validate($request, [
        'name'=>'required',
        'email'=>'required|email',
        'password'=>'required|confirmed'
      ]);

      $input = $request->only(['name','email','password']);
      //เข้ารหัส
      $input['password'] = bcrypt($input['password']);

      //create and save the user
      $user = User::create($input);

      //sign them in
      auth()->login($user);

      //redirect to the home
      return redirect()->home();

    }
}

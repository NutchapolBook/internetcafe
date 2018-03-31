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
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:4|confirmed',
        'role'=>'required',
      ]);

      $input = $request->only(['name','email','password','role']);
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

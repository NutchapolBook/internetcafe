<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\InternetCafe;

class RegistrationController extends Controller
{
    public function create(){
        return view('registration.create');

    }

    public function store(Request $request) {
      //dd($request);
      $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:4|confirmed',
        'role'=>'required',
        'g-recaptcha-response'=>'required|recaptcha',
      ]);

     #ถ้าเป็น admin จะสร้างตาราง intercafes เพิ่มลง DB
      if ($request->role === "admin")
          {
              $inputcafe = array(
                  'name' => $request->cafename,
              );
              //dd($inputcafe);
              $internetcafe = InternetCafe::create($inputcafe);
          }

      $input = $request->only(['name','email','password','role','cafename']);
      //เข้ารหัส
      $input['password'] = bcrypt($input['password']);
      //dd($input);

      //create and save the user
      $user = User::create($input);

      //sign them in
      //auth()->login($user);

      //redirect to the home
      return redirect()->home();

    }
}

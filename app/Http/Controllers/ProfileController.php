<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index()
    {
        return view('profile.index',[
          'name' => Auth::user()->name,
          'email' => Auth::user()->email,
          'pass' => Auth::user()->password
        ]);
    }

    public function updated(Request $request) {
      //validate form
      $this->validate($request, [
        'name'=>'required',
        'email'=>'required|email',
        'password'=>'required|confirmed',
      ]);

      $input = $request->only(['name','email','password']);
      //เข้ารหัส
      $input['password'] = bcrypt($input['password']);

      //create and save the user
      $user = User::index($input);

      //sign them in
      auth()->login($user);

      //redirect to the home
      return redirect()->home();

    }
}

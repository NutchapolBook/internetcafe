<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        //dd($user);
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index()
    {
        $username = Auth::user()->email;
        $user = DB::table('users')
           ->where('email','=',$username)
           ->get();
        //dd($user[0]);
        return view('profile.index',compact('user'));
    }

    public function update(Request $request) {
    dd($request);
      $input = $request->only(['name','email','password']);
      //เข้ารหัส
      $input['password'] = bcrypt($input['password']);
      //dd($input);

      //create and save the user
      $user = User::index($input);

      //sign them in
      auth()->login($user);

      //redirect to the home
      return redirect()->home();

    }
}

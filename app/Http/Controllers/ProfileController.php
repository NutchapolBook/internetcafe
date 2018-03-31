<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|',
        'password' => 'required|string|min:4|confirmed'
      ]);

      $input = $request->only(['name','email','password']);

      //update
      $data = DB::table('users')
                  ->where([
                    ['name',Auth::user()->name],
                    ['email',Auth::user()->email]
                  ])
                  ->update([
                    'name'=> $input['name'],
                    'email'=> $input['email'],
                    'password' => bcrypt($input['password']),
                  ]);



      //redirect to the home
      return redirect()->home();

    }

}

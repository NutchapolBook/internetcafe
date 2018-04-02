<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;


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
        $cafename = Auth::user()->cafename;
        $email = Auth::user()->email;
        $user = DB::table('users')
           ->where('email','=',$email)
           ->get();
        //dd($user[0]);
        //dd($cafename);
        return view('profile.index',compact('user','cafename'));
    }

    public function update(Request $request) {
    //dd($request);
      $input = $request->only(['name','email','password']);
      //dd($input);
      $cafename = Auth::user()->cafename;
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
      return redirect()->back();

    }

}

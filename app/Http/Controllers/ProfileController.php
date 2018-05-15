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
        $cafe = DB::table('internetcafes')
           ->where('name','=',$cafename)
           ->get();
        return view('profile.index',compact('user','cafename','cafe'));
    }

    public function update(Request $request) {
        $userid = Auth::user()->id;
        $this->validate($request, [
          'name' => 'required|string|max:255',
          'email' => 'unique:users,email,'.$userid.',id',
          'password' => 'required|string|min:4|confirmed',
        ]);
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
      return redirect()->back()->with('status', 'Profile updated!');

    }

}

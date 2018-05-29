<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;


class UsersmanagementController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        // dd($user);
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index()
    {
        if(Auth::user()->role != "provider"){
            return redirect()->back()->withErrors([
            'message' => 'Your role have no permission to use this funtion. Please contact to us.
            ']);
        }
        //dd(Auth::user()->role);
        // $users = User::where('role', '!=' ,'provider')->get();
        $users = User::get();
        //dd($users);
        return view('usersmanagement.index',compact('users'));
    }

    public function update(Request $request) {
        if(Auth::user()->role != "provider"){
            return redirect()->back()->withErrors([
            'message' => 'Your role have no permission to use this funtion. Please contact to us.
            ']);
        }
      //dd($request);
      $input = $request->only(['id','status']);
      //dd($input);
      //update
      //dd($input['status']);
      if ($input['status'] === 'disable')
      {
        $data = DB::table('users')
                        ->where([
                          ['id',$input['id']],
                          ])
                        ->update([
                        'status'=> 'useable',
                          ]);
      }
      else
      {
        $data = DB::table('users')
                          ->where([
                            ['id',$input['id']],
                            ])
                          ->update([
                          'status'=> 'disable',
                          ]);
        }
      //dd($incomes);
      //redirect to the home
      return redirect()->back()->with('status', 'Status updated!');

    }

}

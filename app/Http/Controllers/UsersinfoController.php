<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Addcredit;


class UsersinfoController extends Controller
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
        $users = User::where('role', '=' ,'user')
           ->get();
        // dd($users);
        $cafe = DB::table('internetcafes')
           ->where('name','=',$cafename)
           ->get();
        return view('usersinfo.index',compact('users','cafename','cafe'));
    }

    public function update(Request $request) {
      //dd($request);
      $input = $request->only(['id','status']);
      //dd($input);
      $cafename = Auth::user()->cafename;
      //update
      //dd($input['status']);
      if ($input['status'] === 'disable') {
        $data = DB::table('users')
                        ->where([
                          ['id',$input['id']],
                          ])
                        ->update([
                        'status'=> 'useable',
                          ]);
      }
      else {
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

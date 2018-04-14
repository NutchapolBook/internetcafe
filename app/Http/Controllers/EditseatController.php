<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class EditseatController extends Controller
{
  public function index(){
      $cafename = Auth::user()->cafename;
      $email = Auth::user()->email;

      $user = DB::table('users')
          ->where('email','=',$email)
         ->get();
      return view('editseat.index',compact('user','tojson','cafename'));

  }

  public function update(Request $request) {
    //d($request);
    $input = $request->only(['tjs']);
    //dd($input);

    $cafename = Auth::user()->cafename;
    //update

    $data = DB::table('users')
                ->where([
                  ['name',Auth::user()->name],
                  ['email',Auth::user()->email]
                ])
                ->update([
                  'tojson'=> $input['tjs'],
                ]);
    //redirect to the home
    return redirect()->back();

  }
}

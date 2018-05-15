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

      $cafe = DB::table('internetcafes')
            ->where('name','=',$cafename)
            ->get();
      return view('editseat.index',compact('user','tojson','cafename','cafe'));

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
                  'tojson2'=> $input['tjs'],
                  'tojson3'=> $input['tjs'],
                  'tojson4'=> $input['tjs'],
                  'tojson5'=> $input['tjs'],
                  'tojson6'=> $input['tjs'],
                  'tojson7'=> $input['tjs'],
                  'tojson8'=> $input['tjs'],
                  'tojson9'=> $input['tjs'],
                  'tojson10'=> $input['tjs'],
                  'tojson11'=> $input['tjs'],
                  'tojson12'=> $input['tjs'],
                  'tojson13'=> $input['tjs'],
                  'tojson14'=> $input['tjs'],
                  'tojson15'=> $input['tjs'],
                  'tojson16'=> $input['tjs'],
                  'tojson17'=> $input['tjs'],
                  'tojson18'=> $input['tjs'],
                  'tojson19'=> $input['tjs'],
                  'tojson20'=> $input['tjs'],
                  'tojson21'=> $input['tjs'],
                  'tojson22'=> $input['tjs'],
                  'tojson23'=> $input['tjs'],
                  'tojson24'=> $input['tjs'],

                ]);
    //redirect to the home
    return redirect()->back();

  }
}

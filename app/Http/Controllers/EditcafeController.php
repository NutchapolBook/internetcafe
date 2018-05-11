<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;


class EditcafeController extends Controller
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
        $cafe = DB::table('internetcafes')
           ->where('name','=',$cafename)
           ->get();
        //dd($cafe);
        return view('editcafe.index',compact('cafe','cafename'));
    }

    public function update(Request $request) {
      //dd($request);
      $input = $request->only(['id','price','name','colour','location','tel','facebook','line','picture1','picture2','picture3','icon']);
      //dd($input);
      //$colour = $input['color'].value(0);
      //dd($colour);
      //update
      $data = DB::table('internetcafes')
                    ->where('id',$input['id'])
                    ->update([
                        'name'=> $input['name'],
                        'colour'=> $input['colour'],
                        'location'=> $input['location'],
                        'tel'=> $input['tel'],
                        'facebook'=> $input['facebook'],
                        'line'=> $input['line'],
                        ]);

      if ($input['picture1'] != null) {
          $data = DB::table('internetcafes')
                        ->where('id',$input['id'])
                        ->update([
                            'picture1'=> $input['picture1'],
                            ]);
      }

      if ($input['picture2'] != null) {
          $data = DB::table('internetcafes')
                        ->where('id',$input['id'])
                        ->update([
                            'picture2'=> $input['picture2'],
                            ]);
      }

      if ($input['picture3'] != null) {
          $data = DB::table('internetcafes')
                        ->where('id',$input['id'])
                        ->update([
                            'picture3'=> $input['picture3'],
                            ]);
      }

      if ($input['icon'] != null) {
          $data = DB::table('internetcafes')
                        ->where('id',$input['id'])
                        ->update([
                            'icon'=> $input['icon'],
                            ]);
      }
      //redirect to the home
      return redirect()->back()->with('status', 'Internetcafe data updated!');

    }

}

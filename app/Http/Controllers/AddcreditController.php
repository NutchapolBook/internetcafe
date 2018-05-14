<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Addcredit;

class AddcreditController extends Controller
{
    public function index($cafename){
        $cafename = Auth::user()->cafename;
        $cafe = DB::table('internetcafes')
           ->where('name','=',$cafename)
           ->get();
        return view('addcredit.index',compact('cafename','cafe'));

    }

    public function indexAdmin($cafename){
        $cafename = Auth::user()->cafename;
        $cafe = DB::table('internetcafes')
           ->where('name','=',$cafename)
           ->get();
        return view('addcredit.indexAdmin',compact('cafename','cafe'));
    }

    public function store(){
      $this->validate(request(),[
        'amount' => 'required',
        'code' => 'required'
      ]);
    // dd(request(['title','body']));
    $id = Auth::id();
    $cafename = Auth::user()->cafename;
    $code = request('code');

    Addcredit::create([
      'admin_id' => $id,
      'amount'=>request('amount'),
      'code' => request('code'),
      'cafename' => $cafename,
    ]);

    return redirect()->back()->with('status', 'Add credit code to database complete!');
    }

    public function update(Request $request) {
      //dd($request);
      $input = $request->only(['code']);
      //dd($input);
      $cafename = Auth::user()->cafename;
      //dd($cafename);
      //update
      $balance = Auth::user()->balance;
      $addcredits = DB::table('addcredits')
                      ->where('code','=',$input['code'])
                      ->get();
        //dd($addcredits[0]);
      if(empty($addcredits[0])){
            return back()->withErrors([
              'message' => 'This code does not match.'
            ]);
        }
      //dd($addcredits[0]->amount);
      else if($addcredits[0]->status == 'useable'){
          $data = DB::table('addcredits')
                      ->where([
                        ['code',$input['code']],
                        ['status','useable'],
                        ['cafename',$cafename],
                      ])
                      ->update([
                        'user_id'=> Auth::user()->id,
                        'status'=> 'disable',
                      ]);
            $userdata = DB::table('users')
                        ->where([
                          ['name',Auth::user()->name],
                          ['email',Auth::user()->email]
                        ])
                        ->update([
                          'balance'=> $balance+$addcredits[0]->amount,
                        ]);
      }

      else if ($addcredits[0]->status == 'disable') {
        return back()->withErrors([
          'message' => 'This code is used.'
        ]);
      }



      //redirect to the home
      return redirect()->back()->with('status', 'Add credit complted. Your balance is updated!');
  }

}

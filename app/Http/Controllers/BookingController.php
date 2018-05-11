<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\seat;

class BookingController extends Controller
{
    public function index(){
      $cafename = Auth::user()->cafename;
      $email = Auth::user()->email;

      $user = DB::table('users')
          ->where('cafename','=',$cafename)
          ->where('role','=',"admin")
         ->get();

      $user1 = DB::table('users')
          ->where('cafename','=',$cafename)
          ->where('email','=',$email)
            ->get();

      $seat = DB::table('seats')
          ->where('cafename','=',$cafename)
          ->get();

      $cafe = DB::table('internetcafes')
          ->where('name','=',$cafename)
          ->get();

      return view('booking.index',compact('user','tojson','cafename','user1','balance','seat','seatname','status','time','cafe','price'));

    }


    public function cancle(){
        $cafename = Auth::user()->cafename;
        $email = Auth::user()->email;

        $seat = DB::table('seats')
            ->where('cafename','=',$cafename)
            ->where('email','=',$email)
            ->get();
        // $user = $user->toArray();
        // dd($user);
        // compact('user','name','email','cafename','seatname','amount','time','starttime','endtime','date')
        return view('booking.cancle',compact( 'seat',['seats' => $seat],'cafename'));

    }

    public function update(Request $request) {
      // dd($request);
      $input = $request->only(['name','email','cafename','seatname','time','amount','tjs','starttime','endtime','date','status']);
      // dd($input);
      $name = Auth::user()->name;
      $cafename = Auth::user()->cafename;
      $email = Auth::user()->email;
      //update

      $input['name'] = $name;
      $input['email'] = $email;
      $input['cafename'] = $cafename;
      $balance = Auth::user()->balance;
      $amount = $input['amount'];

      if ($balance >= $amount && $input['status'] == 'Available') {
      $data = DB::table('users')
                  ->where([
                    ['cafename',Auth::user()->cafename],
                    ['role','admin'],
                  ])
                  ->update([
                    'tojson'=> $input['tjs'],
                  ]);

      $data1 = DB::table('users')
                  ->where([
                      ['cafename',Auth::user()->cafename],
                      ['email',Auth::user()->email],
                  ])
                  ->update([
                      'balance'=> $balance-$amount,
                  ]);
      }


      $seat = seat::create($input);




      //
      // $data = DB::table('seat')
      //             ->insert([
      //               'name'=> $name,
      //               'email'=> $email,
      //               'cafename' => $cafename,
      //               'seatname'=> $input['key'],
      //               'amount'=> $input['amount'],
      //               'time'=> $input['timeplay'],
      //             ]);
      //redirect to the home

      return redirect()->back();

    }


}

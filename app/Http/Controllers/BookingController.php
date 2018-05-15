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
            ->where('status','=','Available')
            ->get();
        // $user = $user->toArray();
        // dd($user);
        // compact('user','name','email','cafename','seatname','amount','time','starttime','endtime','date')
        return view('booking.cancle',compact( 'seat',['seats' => $seat],'cafename'));

    }

    public function update(Request $request) {
      // dd($request);
      $input = $request->only(['name','email','cafename','seatname','time','amount','tjs','starttime','endtime','date','status','showtime2']);
      // dd($input);

      $name = Auth::user()->name;
      $cafename = Auth::user()->cafename;
      $email = Auth::user()->email;
      //update
      // $checktime = $input['time']+1;
      // dd($checktime);
      $showtime = $input['showtime2'];
      $input['name'] = $name;
      $input['email'] = $email;
      $input['cafename'] = $cafename;
      $balance = Auth::user()->balance;
      $amount = $input['amount'];

      if ($balance >= $amount && $input['status'] == 'Available') {
        if ($showtime == "00.00 - 01.00") {

          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson'=> $input['tjs'],

                      ]);

        }
        else if ($showtime == "01.00 - 02.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson2'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "02.00 - 03.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson3'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "03.00 - 04.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson4'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "04.00 - 05.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson5'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "05.00 - 06.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson6'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "06.00 - 07.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson7'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "07.00 - 08.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson8'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "08.00 - 09.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson9'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "09.00 - 10.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson10'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "10.00 - 11.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson11'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "11.00 - 12.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson12'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "12.00 - 13.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson13'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "13.00 - 14.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson14'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "14.00 - 15.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson15'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "15.00 - 16.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson16'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "16.00 - 17.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson17'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "17.00 - 18.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson18'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "18.00 - 19.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson19'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "19.00 - 20.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson20'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "20.00 - 21.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson21'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "21.00 - 22.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson22'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "22.00 - 23.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson23'=> $input['tjs'],
                      ]);
        }
        else if ($showtime == "23.00 - 00.00") {
          $data = DB::table('users')
                      ->where([
                        ['cafename',Auth::user()->cafename],
                        ['role','admin'],
                      ])
                      ->update([
                        'tojson24'=> $input['tjs'],
                      ]);
        }



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

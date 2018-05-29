<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Addcredit;
use Carbon\Carbon;


class IncomeProviderController extends Controller
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
        if(Auth::user()->role != "provider"){
            return redirect()->back()->withErrors([
            'message' => 'Your role have no permission to use this funtion. Please contact to us.
            ']);
        }

        $cafes = DB::table('internetcafes')->get();
        return view('incomeProvider.index',compact('cafes'));
    }

    public function income($cafename)
    {
        if(Auth::user()->role != "provider"){
            return redirect()->back()->withErrors([
            'message' => 'Your role have no permission to use this funtion. Please contact to us.
            ']);
        }
        //dd($input);
        $cafes = DB::table('internetcafes')
           ->where('name','=', $cafename )
           ->get();
        //$income = income;
        //dd($income);
        return view('incomeProvider.income',compact('income','cafes'));
    }

    public function create(Request $request) {
      //dd($request);
      if(Auth::user()->role != "provider"){
          return redirect()->back()->withErrors([
          'message' => 'Your role have no permission to use this funtion. Please contact to us.
          ']);
      }

      $input = $request->only(['startdate','enddate','cafename']);
      //dd($input);
      $input['startdate'] = Carbon::parse($input['startdate']);
      $input['enddate'] = Carbon::parse($input['enddate']);
       //dd($input);
      $diff = $input['enddate']->diffInDays($input['startdate']);
      //dd($diff);
      $cafe = DB::table('internetcafes')
         ->where('name','=', $input['cafename'] )
         ->get();
    //dd($cafe);
      $price = $cafe[0]->price;
      #จำนวนวันที่ใช้ * price * 0.1 * 20
      $income = $diff*$price*0.1*20;
      //dd($income);
      $cafename = $input['cafename'];

      $input['income'] = $income;
      //dd($input);
      //dd($cafename);
      //redirect
      return redirect()->route('incomeProvider.income',compact('cafename','income') );

    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Addcredit;


class IncomeController extends Controller
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
        $incomes = DB::table('addcredits')
           ->where('cafename','=',$cafename)
           ->get();
        //dd($income);
        $cafe = DB::table('internetcafes')
           ->where('name','=',$cafename)
           ->get();
        return view('income.index',compact('incomes','cafename','cafe'));
    }

    public function create(Request $request) {
      //dd($request);
      $input = $request->only(['startdate','enddate']);
      //dd($input);
      $cafename = Auth::user()->cafename;
      $cafe = DB::table('internetcafes')
         ->where('name','=',$cafename)
         ->get();
      //update
      if ($input['startdate'] === $input['enddate']) {
          $incomes = Addcredit::whereDate('created_at', '=' ,$input['startdate'])
                   ->get();
            //dd($incomes);
      }
      else {
          $incomes = Addcredit::whereDate('created_at', '>=' ,$input['startdate'])
                                ->whereDate('created_at', '<=' ,$input['enddate'])
                                ->get();
      }

      //dd($incomes);
      //redirect
      return view('income.index',compact('incomes','cafename','cafe'));

    }

}

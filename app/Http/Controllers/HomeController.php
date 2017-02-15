<?php

namespace App\Http\Controllers;

use App\Lottery;
use App\Seats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lotto = Lottery::all()->groupBy('grade');
        $seats = Seats::all()->groupBy('grade');
        return view('home',['lotto' => $lotto,'seats'=>$seats]);
    }
    public function configure(Request $request){
      $seats = $request->input('seats');
      foreach($seats as $key=>$seat){
        $threshold = Seats::firstOrNew(['grade' => $key]);
        $threshold->grade = $key;
        $threshold->seats = $seat;
        $threshold->save();
      }
      Session::flash('message', "Seat Thresholds Saved");
      return Redirect::back();
    }
}

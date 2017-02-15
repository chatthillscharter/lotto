<?php

use App\Lottery;
use App\Seats;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $lotto = Lottery::all()->groupBy('grade');
    $seats = Seats::all()->groupBy('grade');
    if($lotto->count() > 0){
      return view('welcome',['lotto' => $lotto, 'thresholds' =>$seats]);
    } else {
      return view ('wait');
    }
});
Route::get('/lookup', function(Request $request) {

  if($lotto = Lottery::where('lotto_id',$request->input('lotto_id'))->first()){
    $threshold = Seats::where('grade', $lotto->grade)->first();
    return view('lookup',['lotto' => $lotto,'threshold'=>$threshold]);
  } else {
    Session::flash('message', "That's an invalid lottery number. Please try again.");
    return Redirect::back();
  }
});
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/configure', 'HomeController@configure');
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Place;
use App\Models\Type;
use App\Models\Performance;
use App\Models\Reservation;

use DB;



class ReservationController extends Controller
{
    
    public function index($id){
        $performances = DB::table('performances')
        ->where('performances.per_id', $id)
        ->get();
        
        //dd($performaces);

        return view('reservation' , compact('performances'));
    }

    public function reserve(Request $request){
        $request->validate([
            'firstname'=>'required',
            'lastname' => 'required',
            'phone'=> 'required|regex: /^\+[0-9]{9,15}$/',
            'rid' => 'required'
        ]);


        $reservation = new Reservation();
        $reservation->first_name = $request->firstname;
        $reservation->last_name = $request->lastname;
        $reservation->user_phone = $request->phone;
        $reservation->performance_id = $request->rid;



        $res = $reservation->save();

        if($res){
            return back()->with('success','You have made a reservation successfuly, we will inform you when the status of your reservation has been updated');
        }else {
            return back()->with('fail', 'Something went wrong when making a reservation');
        }
    }
}

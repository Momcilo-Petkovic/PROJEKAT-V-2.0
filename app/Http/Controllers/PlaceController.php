<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Performance;


use DB;

class PlaceController extends Controller
{
    public function index($id){
        $performances = DB::table('performances')
        ->join('places','place_id', '=', 'places.id')
        ->join('types','type_id', '=', 'types.id')
        ->where('places.id', $id)
        ->get();

        //dd($performances);
        return view('place', compact('performances'));
    }
}

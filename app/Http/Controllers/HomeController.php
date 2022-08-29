<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Performance;

use Illuminate\Support\Facades\Auth;

use DB;

class HomeController extends Controller
{
    public function filter($id){

        $performances = DB::table('performances')
        ->join('places','place_id', '=', 'places.id')
        ->where('places.type_id',$id)
        ->get();

        $performances = $performances->sortBy('date');
        //dd($performances);
        return view('test', compact('performances'));
    }
    
    public function index(){
        $performances = DB::table('performances')
        ->join('places','place_id', '=', 'places.id')
        ->get();

        $performances = $performances->sortBy('date');

        return view('test', compact('performances'));
    }

    // public function category(){
    //     $types = DB::table('types')->get();
    //     return view('welcome' , ['types' => $types]);
    // }


    // public function get_causes_against_category($id){
    //     $data = DB::table('types as type')->selectRaw('(Select image from places where places.type_id = type.id) as place_image,
    //         (Select name from places where places.type_id = type.id) as place_name')->whereRaw('id IN ('.$id.')')->get();

    //         echo json_encode($data);
    // }
}

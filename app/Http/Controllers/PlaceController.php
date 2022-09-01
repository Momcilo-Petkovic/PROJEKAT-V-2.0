<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Type;
use App\Models\Performance;
use Illuminate\Support\Facades\Auth;


use DB;

class PlaceController extends Controller
{
    public function index($id){
        $performances = DB::table('performances')
        ->join('genres', 'genre_id', '=', 'genres.id')
        ->join('places','place_id', '=', 'places.id')
        ->join('types','type_id', '=', 'types.id')
        ->where('places.id', $id)
        ->get();

        $about = DB::table('places')->where('places.id', $id)->get();


        $is_admin = null;
        $admin_id = null;
        if(Auth::guard('admin')->check()){
            $is_admin = \Auth::guard('admin')->user()->is_admin;
            $admin_id = \Auth::guard('admin')->user()->id;
        }
            


        $comments = DB::table('comments')
        ->join('places', 'c_place_id', '=', 'places.id')
        ->join('users', 'c_user_id', '=', 'users.id')
        ->where('places.id', $id)
        ->get();



        //dd($comments);
        return view('place', compact('performances', 'about', 'comments', 'is_admin','admin_id'));
    }

  
}

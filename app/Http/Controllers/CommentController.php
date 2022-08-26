<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Place;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use DB;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::check())
        {
            $validator = Validator::make($request->all(), [
                'comment_body' => 'required|string'
            ]);

            if($validator->fails()){
                return redirect()->back()->with('message', 'Comment area is mandatory');
            }
            $place = DB::table('places')->where('places.id', $request->post_slug);
           // $place = Place::where('id', $request->post_slug);

            if($place)
            {
                $comment = new Comment();
                $comment->c_place_id = $request->post_slug;
                $comment->c_user_id = Auth::user()->id;
                $comment->comment_body = $request->comment_body;
                $comment->save();
                return redirect()->back()->with('message', 'Comment posted!');
            }
            else 
            {
                return redirect()->back()->with('message', 'No such place found');
            }
        }
        else 
        {
            return redirect('login')->with('message', 'You have to log in if you want to leave a comment');
        }
    }


    public function delete($id)
    {
        DB::delete('delete from comments where c_id = ?', [$id]);
        return redirect()->back()->with('message', 'why tf it not work');
    }
}

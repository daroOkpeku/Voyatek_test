<?php

namespace App\Http\Controllers;

use App\Http\Resources\blogresouce;
use App\Models\blog;
use App\Models\comment;
use Illuminate\Http\Request;

class GetController extends Controller
{

    public function blogsstories(){
      try {
        $blogs = blog::paginate(10);
        $blogresouce = blogresouce::collection($blogs->data);
        return response()->json(['success' => $blogresouce],200);
      } catch (\Throwable $th) {
        return response()->json(['error'=>'something went wrong'],500);
      }
    }

    public function blogsingle($id){
        try {
            $blog = blog::findOrFail($id);
            return response()->json(['success' => $blog],200);
        } catch (\Throwable $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
    }


    public function commentview(){
        try {
            $comment =  comment::all();
            return response()->json(['success'=>$comment]);
        } catch (\Throwable $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }

    }



}

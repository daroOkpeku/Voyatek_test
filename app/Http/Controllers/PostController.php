<?php

namespace App\Http\Controllers;

use App\Http\Requests\blogpost;
use App\Models\blog;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class PostController extends Controller
{

    public function createblog(blogpost $request){
        if(Gate::allows("check-user", auth()->user())){
        blog::create([
            'heading'=>$request->heading,
            'body'=>$request->body,
            'author'=>$request->author,
        ]);
        return response()->json(['success'=>'you story has been created'],200);
    }else{
        return response()->json('you do not have authorization');
    }
    }


    public function updateblog(Request $request){
        if(Gate::allows("check-user", auth()->user())){
        try {
            $blog = blog::findOrFail($request->id);
            $blog->update([
                'heading'=>$request->heading,
                'body'=>$request->body,
                'author'=>$request->author,
            ]);
            return response()->json(['success'=>'you story has been updated'],200);
        } catch (\Throwable $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
    }else{
        return response()->json('you do not have authorization');
    }

    }


            public function deleteblog(Request $request){
                if(Gate::allows("check-user", auth()->user())){
            try {
                $blog = blog::findOrFail($request->id);
                $blog->delete();
                return response()->json(['success'=>'this story has been deleted successfully'],200);
            } catch (\Throwable $th) {
                return response()->json(['error'=>'something went wrong'],500);
            }
            }else{
                return response()->json('you do not have authorization');
            }
            }

            public function createcomment(Request $request){
                if(Gate::allows("check-viewer", auth()->user())){
                     comment::create([
                        'comment'=>$request->id,
                        'user_id'=>$request->user_id,
                        'blog_id'=>$request->blog_id,
                     ]);
                }else{
                    return response()->json('you do not have authorization');
                }
            }

            public function deletecomment(Request $request){
                if(Gate::allows("check-viewer", auth()->user())){
                $deletecomment = comment::findOrFail($request->id);
                $deletecomment->delete();
                return response()->json(['success'=>'you has been deleted your comment']);
                }else{
                    return response()->json('you do not have authorization');
                }
             }


             public function updatecomment(Request $request){
                if(Gate::allows("check-viewer", auth()->user())){
                  $comment =  comment::findOrFail($request->id);
                  $comment->update([
                    'comment'=>$request->id,
                  ]);
                  return response()->json(['success'=>'you has been updated your comment']);
                }else{
                    return response()->json('you do not have authorization');
                }
             }

}

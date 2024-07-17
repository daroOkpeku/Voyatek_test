<?php

namespace App\Http\Controllers;

use App\Events\regevent;
use App\Http\Requests\login_req;
use App\Http\Requests\registerrq;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function adminregister(registerrq $request){
        $user = User::create([
             'name'=>$request->name,
             'email'=>$request->email,
             "verification_code"=>sha1(time()),
             "status"=>1,
             "user_type"=>'admin',
             'password'=>Hash::make($request->password),
            ]);
            return response()->json(['success'=>'you have registered']);
     }

    public function register(registerrq $request){
       $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            "verification_code"=>sha1(time()),
            "status"=>0,
            "user_type"=>'viewer',
            'password'=>Hash::make($request->password),
           ]);
          regevent::dispatch($request->name,  $request->email, $user->verification_code);
           return response()->json(['success'=>'you have registered']);
    }



    public function email_confirm ($email, $verification_code){

        $user = User::where(['email'=>$email, "verification_code"=>$verification_code, ])->first();
        if($user){
          $user->update([
              'status'=>1,
          ]);
          return response()->json(["success"=>200, "message"=>"your account has been verifield"]);
        }else{
          return response()->json(['status'=>500, 'error'=>'are you sure you are passing the correct values']);
        }
  }


     public function login(login_req $request){
        $user = User::where(['email'=>$request->email])->first();
        if($user && $user->status == 1 && $user->user_type == 'viewer' && Hash::check($request->password, $user->password)){
          $token =  $user->createToken('my-app-token')->plainTextToken;
          $user->api_token = $token;
          $user->save();
          $data =['token'=>$token, 'name'=>$user->name, 'email'=>$user->email, 'id'=>$user->id ];
          return response()->json(['success'=>200, 'message'=>'you logged in successfully', 'data'=>$data]);
        }else{
            return response()->json(['error'=>'please enter correct details']);
        }
     }


     public function admin_login(login_req $request){
        $user = User::where(['email'=>$request->email])->first();
        if($user && $user->status == 1 && $user->user_type == 'admin' && Hash::check($request->password, $user->password)){
          $token =  $user->createToken('my-app-token')->plainTextToken;
          $user->api_token = $token;
          $user->save();
          $data =['token'=>$token, 'name'=>$user->name, 'email'=>$user->email, 'id'=>$user->id ];
          return response()->json(['success'=>200, 'message'=>'you logged in successfully', 'data'=>$data]);
        }else{
            return response()->json(['error'=>'please enter correct details']);
        }
     }
}

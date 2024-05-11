<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class Authcontroller extends Controller
{
    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $data=$request->all();
        $data['password']=Hash::make($data['password']);
        $user=User::create($data);
        $response['token']=$user->createToken('token')->plainTextToken;
        $response['name']=$user->name;
        return response()->json($response,200);

    }
    public function login(Request $request){
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user=Auth::user();
            $response['token']=$user->createToken('token')->plainTextToken;
            $response['name']=$user->name;
            return response()->json($response,200);
        }
        else{
            return response()->json(['error'=>'Unauthenticated'],401);
        }


    }
    public function logout(){
        Auth::user()->tokens()->delete();
        return response()->json(['message'=>'Logged out'],200);

    }
    public function detail(){
        $user=Auth::user();
        
        return response()->json($user,200);
    }
}

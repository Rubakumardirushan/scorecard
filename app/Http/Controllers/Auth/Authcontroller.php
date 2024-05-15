<?php

namespace App\Http\Controllers\Auth;
use App\Mail\otpmail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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
        $response['email']=$user->email;
        $otp=rand(100000,999999);
        $user->otp=$otp;
       $name=$request->name;
        Mail::to($request->email)->send(new otpmail($otp,$name));
        $user->save();
       $response['message']='OTP sent to your email';
        return response()->json($response,200);

    }



    public function verifyotp(Request $request){

        $validator=Validator::make($request->all(),[
            'otp'=>'required',
            'email'=>'required|email'
            
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $user=User::where('email',$request->email)->first();
        if($user->otp==$request->otp){
            $user->email_verified_at=date('Y-m-d H:i:s');
            $user->otp=null;
            $response['token']=$user->createToken('token')->plainTextToken;
            $response['name']=$user->name;
            Auth::login($user);
            $user->save();
            $response['message']='Email verified and logged in successfully';
            return response()->json($response,200);
        }
        else{
            return response()->json(['error'=>'Invalid OTP'],400);
        }

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
            Auth::login($user);
            $response['token']=$user->createToken('token')->plainTextToken;
            $response['name']=$user->name;
            return response()->json($response,200);
        }
        else{
            return response()->json(['error'=>'Invaild username or password'],401);
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

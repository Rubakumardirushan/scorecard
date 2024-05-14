<?php

namespace App\Http\Controllers\Tournament;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tournament;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class tournamentcontroller extends Controller
{
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            'tournament_name'=>'required|unique:tournaments,tournament_name',
            'tournament_type'=>'required',
            'tournament_venue'=>'required',
            
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $data=$request->all();
        $data['user_id']=Auth::id();
        $tournament=tournament::create($data);
        $response['user_id']=Auth::id();
        $response['id']=$data['user_id'];
        $response['message']='Tournament created successfully';
        return response()->json($response,200);

    }
}

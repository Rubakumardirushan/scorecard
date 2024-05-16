<?php

namespace App\Http\Controllers\Match;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matches;
use Illuminate\Support\Facades\Validator;
class matchcontroller extends Controller
{

    public function matchcreate(Request $request){
        $validator=Validator::make($request->all(),[
            'team1_id'=>'required',
            'team2_id'=>'required',
            'tournament_id'=>'required',
            'match_date'=>'required',
           
            
            
        ]);
        if($request->team1_id==$request->team2_id){
            $response['error']='Both teams cannot be same';
            return response()->json($response,200);
        }
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $data=$request->all();
        $match=Matches::create($data);
        $response['message']='Match created successfully';
        return response()->json($response,200);
    }
}

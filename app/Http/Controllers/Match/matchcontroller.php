<?php

namespace App\Http\Controllers\Match;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matches;
use Illuminate\Support\Facades\Auth;
use App\Models\tournament;
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
        $tournament_name=tournament::where('id',$request->tournament_id)->pluck('tournament_name');

        if($request->team1_id==$request->team2_id){
            $response['error']='Both teams cannot be same';
            return response()->json($response,200);
        }
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $data=$request->all();
        $data['tournament_name']=$tournament_name[0];
        $match=Matches::create($data);
        $response['message']='Match created successfully';
        return response()->json($response,200);
    }

    public function getmatches(){
        $id=Auth::id();
        $tournament=tournament::where('user_id',$id)->pluck('id');
        $matches = Matches::where('tournament_id',$tournament)->get();
        return response()->json($matches,200);
    }
    
}

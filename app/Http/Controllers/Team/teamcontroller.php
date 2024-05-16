<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\team;
use Illuminate\Support\Facades\Validator;
class teamcontroller extends Controller
{
    public function teamcreate(Request $request){
        $validator=Validator::make($request->all(),[
            'team_name'=>'required',
            'tournament_id'=>'required',
            
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $name=team::where('team_name',$request->team_name)->where('tournament_id',$request->tournament_id)->exists();
        if($name){
            $response['error']='Team name already exists';
            return response()->json($response,200);
        }
        $data=$request->all();
        $team=team::create($data);
        $response['message']='Team created successfully';
        return response()->json($response,200);
    }

    public function getteamname(){
        $team = team::where('user_id', Auth::id())->get();
        
        return response()->json($team, 200);
    }

    public function findteam(Request $request){
        $team=team::where('tournament_id',$request->tournament_id)->get();
        return response()->json($team,200);
    }
}

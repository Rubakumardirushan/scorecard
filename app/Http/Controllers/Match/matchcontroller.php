<?php

namespace App\Http\Controllers\Match;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matches;
use App\Models\User;
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
     public function storematchid(Request $request){
       
$user=User::find(Auth::id());

$user->match_id=$request->match_id;
$user->match_id = $request->match_id;
$user->tournament_id=$request->tournament_id;
$user->save(); // Use save() to update the instance
$response['message']='Match id stored successfully';
return response()->json($response,200);
        
    
}

public function getmatchid(){
    $user = Auth::user();
    $match_id=$user->match_id;
    $response['match_id']=$match_id;
    return response()->json($response,200);
}
public function teamname(Request $request){
    $match_id=$request->match_id;
   $tournament_id=Matches::where('id',$match_id)->pluck('tournament_id');
  
   $vaild_id=tournament::where('id',$tournament_id)->pluck('user_id');
    $id=Auth::id();
    if($vaild_id[0]!=$id){
        $response['error']='You are not authorized to view this match';
        return response()->json($response,200);
    }
    
    $team1_id=Matches::where('id',$match_id)->pluck('team1_id');
    $team2_id=Matches::where('id',$match_id)->pluck('team2_id');

    $response['team1_name']=$team1_id;
    $response['team2_name']=$team2_id;
    return response()->json($response,200);

}
public function storetoss(Request $request){
    $matchid=User::where('id',Auth::id())->pluck('match_id');
    $user=Matches::find($matchid[0]);
    $user->toss_winner=$request->toss_winner;
    $user->toss_decision=$request->toss_decision;
    $user->save();
    $response['message']='Toss details stored successfully';
    return response()->json($response,200);

}




}

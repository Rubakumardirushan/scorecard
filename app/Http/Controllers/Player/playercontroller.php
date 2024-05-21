<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\player;
use App\Models\team;
use App\Models\tournament;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class playercontroller extends Controller
{
   public function playercreate(Request $request){
       $validator=Validator::make($request->all(),[
           'player_name'=>'required',
           'team_id'=>'required',
           'tournament_id'=>'required',
           'player_role'=>'required',
            'player_jersey_number'=>'required',
           
       ]);
       //$jersey=player::where('player_jersey_number',$request->player_jersey_number)->where('tournament_id',$request->tournament_id)->where('team_id',$request->team_id)->exists();
       $jersey = Player::where('player_jersey_number', $request->player_jersey_number)
       ->where('tournament_id', $request->tournament_id)
       ->where('team_id', $request->team_id)
       ->exists();

       if($jersey){
              $response['error']='Jersey number already exists';
              return response()->json($response,200);
         }
       if($validator->fails()){
           return response()->json($validator->errors(),400);
       }
       $data=$request->all();
       $player=player::create($data);
       $response['message']='Player created successfully';
       return response()->json($response,200);
   }

public function getplayers(Request $request){
    $user=User::where('id',Auth::id())->pluck('tournament_id');
    $teamname=$request->team_name;
    $team_id=team::where('team_name',$teamname)->where('tournament_id',$user[0])->pluck('id');
    $player=player::where('team_id',$team_id[0])->pluck('player_name');
    return response()->json($player,200);


}

}

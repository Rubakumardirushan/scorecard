<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\player;
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
}

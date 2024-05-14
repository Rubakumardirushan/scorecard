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
            'player_jersey_number'=>'required|numeric|unique:players,player_jersey_number'
           
       ]);
       if($validator->fails()){
           return response()->json($validator->errors(),400);
       }
       $data=$request->all();
       $player=player::create($data);
       $response['message']='Player created successfully';
       return response()->json($response,200);
   }
}

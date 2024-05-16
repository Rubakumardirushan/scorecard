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
            'tournament_name'=>'required',
            'tournament_type'=>'required',
            'tournament_venue'=>'required',
            
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $name=tournament::where('tournament_name',$request->tournament_name)->exists();
        if($name){
            $response['error']='Tournament name already exists';
            return response()->json($response,200);
        }
        $data=$request->all();
        $data['user_id']=Auth::id();
        $tournament=tournament::create($data);
        $response['user_id']=Auth::id();
        $response['id']=$data['user_id'];
        $response['message'] = 'Tournament ' . $request->tournament_name . ' created successfully';

        return response()->json($response,200);

    }

    public function gettournamentid(){
        $tournament = tournament::where('user_id', Auth::id())->get();
        
        return response()->json($tournament, 200);
    }
}

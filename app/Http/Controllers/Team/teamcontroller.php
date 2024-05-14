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
            'team_name'=>'required|unique:teams,team_name',
            'tournament_id'=>'required',
            
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $data=$request->all();
        $team=team::create($data);
        $response['message']='Team created successfully';
        return response()->json($response,200);
    }
}

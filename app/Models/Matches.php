<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;
    protected $fillable=['team1_id','team2_id','tournament_id','match_date','tournament_name','toss_winner','toss_decision','Fb_score','Se_score','Fb_over','Se_over','Fb_wickets','Se_wickets','Match_winner'];
}

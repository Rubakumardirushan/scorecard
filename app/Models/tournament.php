<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tournament extends Model
{
    use HasFactory;
    protected $fillable=['tournament_name','tournament_type','tournament_venue','user_id'];
}

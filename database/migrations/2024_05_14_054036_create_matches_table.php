<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->string('team1_id');
            $table->string('team2_id');
            $table->string('tournament_id');
            $table->string('tournament_name')->nullable();
            $table->string('match_date');
            $table->string('toss_winner')->nullable();
            $table->string('toss_decision')->nullable();
            $table->string('Fb_score')->nullable();
            $table->string('Se_score')->nullable();
            $table->string('Fb_over')->nullable();
            $table->string('Se_over')->nullable();
            $table->string('Fb_wickets')->nullable();
            $table->string('Se_wickets')->nullable();
            $table->string('Match_winner')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};

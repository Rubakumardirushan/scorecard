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
        Schema::create('battings', function (Blueprint $table) {
            $table->id();
            $table->string('player_jersey_number');
            $table->string('tournament_id');
            $table->string('player_name');
            $table->string('team_id');
            $table->string('match_id');
            $table->string('batting_position');

            $table->string('runs')->nullable();
            $table->string('balls')->nullable();
            $table->string('fours')->nullable();
            $table->string('sixes')->nullable();
            $table->string('two')->nullable();
            $table->string('three')->nullable();
            $table->string('one')->nullable();
            $table->string('dot_ball')->nullable();
            $table->string('strike_rate')->nullable();
            $table->string('out_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battings');
    }
};

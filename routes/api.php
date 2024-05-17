<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Tournament\TournamentController;
use App\Http\Controllers\Team\TeamController;
use App\Http\Controllers\Player\PlayerController;
use App\Http\Controllers\Match\MatchController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('details', [AuthController::class, 'detail'])->middleware('auth:sanctum');
Route::post('verifyotp', [AuthController::class, 'verifyotp']);
Route::post('create', [TournamentController::class, 'create'])->middleware('auth:sanctum');
Route::post('teamcreate', [TeamController::class, 'teamcreate'])->middleware('auth:sanctum');
Route::post('playercreate', [PlayerController::class, 'playercreate'])->middleware('auth:sanctum');
Route::get('gettournamentid', [TournamentController::class, 'gettournamentid'])->middleware('auth:sanctum');
Route::get('getteamname', [TeamController::class, 'getteamname'])->middleware('auth:sanctum');
Route::post('findteam', [TeamController::class, 'findteam'])->middleware('auth:sanctum');
Route::post('matchcreate', [MatchController::class, 'matchcreate'])->middleware('auth:sanctum');
Route::get('getmatches', [MatchController::class, 'getmatches'])->middleware('auth:sanctum');
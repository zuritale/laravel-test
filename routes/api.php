<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\ShowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => ['auth.jwt']], function() {
    Route::resource('actors', ActorController::class);
    Route::resource('directors', DirectorController::class);
    Route::resource('episodes', EpisodeController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('movies', MovieController::class);
    Route::resource('seasons', SeasonController::class);
    Route::resource('shows', ShowController::class);
});

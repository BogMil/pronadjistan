<?php

use App\Http\Controllers\GradController;
use App\Http\Controllers\UniverzalnaPretragaController;
use App\Http\Controllers\ViberController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/handlecallback', [ViberController::class, 'handleCallback']);


Route::get('/gradovi', [GradController::class, 'gradovi']);
Route::get('grad/{idGrada}/opstine/', [GradController::class, 'opstine']);

Route::post('/univerzalnaPretraga', [UniverzalnaPretragaController::class, 'create']);


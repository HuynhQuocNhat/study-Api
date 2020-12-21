<?php

use App\Http\Controllers\Api\AuthController;
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

Route::prefix('auth')->post('/login', [AuthController::class, 'login']);
Route::prefix('auth')->get('/me', [AuthController::class, 'checkMe'])->middleware('auth:api');
Route::prefix('auth')->get('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

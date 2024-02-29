<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageCapsuleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/message-capsules', [MessageCapsuleController::class, 'index']);
Route::post('/message-capsules', [MessageCapsuleController::class, 'store']);
Route::put('/message-capsules/{messageCapsule}', [MessageCapsuleController::class, 'update']);
Route::put('/message-capsules/{messageCapsule}', [MessageCapsuleController::class, 'open']);
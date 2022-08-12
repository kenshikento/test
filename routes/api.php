<?php

use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\CertificateNoteController;
use App\Http\Controllers\Api\PropertyCertificateController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\PropertyNoteController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('/certificate', [CertificateController::class, 'index']);
Route::get('/certificate/{id}', [CertificateController::class, 'show']);
Route::post('/certificate', [CertificateController::class, 'store']);

Route::get('/property', [PropertyController::class, 'index']);
Route::get('/property/{id}', [PropertyController::class, 'show']);
Route::post('/property', [PropertyController::class, 'store']);
Route::patch('/property/{model}', [PropertyController::class, 'update']);
Route::delete('/property/{model}', [PropertyController::class, 'delete']);

Route::resource('property.note', PropertyNoteController::class);
Route::resource('property.certificate', PropertyCertificateController::class);
Route::resource('certificate.note', CertificateNoteController::class);
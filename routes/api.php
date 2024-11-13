<?php

use App\Http\Controllers\ResumeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/upload-resume', [ResumeController::class, 'upload']);
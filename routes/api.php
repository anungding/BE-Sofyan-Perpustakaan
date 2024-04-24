<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnggotaController;

Route::get('anggota', [AnggotaController::class, 'index']);
Route::post('anggota', [AnggotaController::class, 'store']);
Route::get('anggota/{id}', [AnggotaController::class, 'show']);
Route::put('anggota/{id}', [AnggotaController::class, 'update']);
Route::delete('anggota/{id}/delete', [AnggotaController::class, 'delete']);

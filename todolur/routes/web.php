<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('activities.index');
});
Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
Route::patch('/activities/{activity}/status', [ActivityController::class, 'updateStatus'])->name('activities.updateStatus');
Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
Route::resource('activities', ActivityController::class);

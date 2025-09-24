<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard_plans;
use App\Http\Controllers\ExercisePlanController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [dashboard_plans::class, 'show'])->name('dashboard');
    Route::get('/lift', [ExercisePlanController::class, 'gym_form'])->name('lift');
    Route::post('/gym', [ExercisePlanController::class, 'store_gym'])->name('gym');
    Route::get('/calorie', [dashboard_plans::class, 'calorie'])->name('calorie');
    Route::get('/meal', [dashboard_plans::class, 'meal'])->name('meal');
    Route::get('/routine', [ExercisePlanController::class, 'gym'])->name('routine');

});




require __DIR__.'/auth.php';

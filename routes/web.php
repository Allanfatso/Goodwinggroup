<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard_plans;
use App\Http\Controllers\ExercisePlanController;
use App\Http\Controllers\NutritionPlanController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/lift', [ExercisePlanController::class, 'gym_form'])->name('lift');
    Route::post('/gym', [ExercisePlanController::class, 'store_gym'])->name('gym');
    Route::get('/calorie', [NutritionPlanController::class, 'calorie_form'])->name('calorie');
    Route::get('/routine', [ExercisePlanController::class, 'gym'])->name('routine');
    Route::get('/recipes', [NutritionPlanController::class, 'meal'])->name('recipe');
    Route::post('/meal_plan', [NutritionPlanController::class, 'meal_store'])->name('meal');
    Route::resource('dashboard', dashboard_plans::class);
    // Catch /dashboard/{any

});






require __DIR__.'/auth.php';

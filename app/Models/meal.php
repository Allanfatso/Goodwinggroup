<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class meal extends Model
{
    //
     protected $table = 'meals';

    // Fillable fields (exclude id and user_id)
    protected $fillable = [
        'exercise_name',
        'description',
        'goal',
        'calories_per_day',
        'macronutrients',
        'meal_suggestions',
    ];

    // Each meal belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

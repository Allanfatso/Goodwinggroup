<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class exercise_plan extends Model
{
    //

     protected $fillable = [
        'fitness_level',
        'user_id',
        'preferences',
        //ensure preferences is handled
        // like an array. Also health conditions
        'health_conditions',
        'plan_duration_weeks',
        'days_per_week',
        'session_duration',
    ];

    protected $casts = [
        'preferences' => 'array',
        'health_conditions' => 'array',
    ];


    public function fitness_user(): BelongsTo{
        return $this->belongsTo(user::class);
    }
}

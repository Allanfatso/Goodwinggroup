<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class nutrition_plan extends Model
{
    //dietary_restrictions(array) (multiple options)
    protected $fillable = ['dietary_restrictions', 'daily_activity',];


    public function nutrition_user(): BelongsTo{
        return $this->belongsTo(user::class);
    }
}

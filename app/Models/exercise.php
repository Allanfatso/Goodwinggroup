<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class exercise extends Model
{
    //
    protected $table = 'exercises';
    protected $fillable = [
        'day',
        'name',
        'duration',
        'repetitions',
        'sets',
        'equipment',
        'description',
        'additional_info',
    ];

    // Each exercise belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_at',
        'end_at',
        'user_id',
        'day',
        'station',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'time',
        'price',
    ];
    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

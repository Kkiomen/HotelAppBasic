<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'name', 'nip', 'regon', 'krs',
        'address', 'postal_code', 'city', 'country', 'phone', 'email'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

}

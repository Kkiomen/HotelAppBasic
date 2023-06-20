<?php

namespace App\Models;

use App\Models\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

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

    protected static function booted()
    {
        static::addGlobalScope(new ClientScope());
    }

}

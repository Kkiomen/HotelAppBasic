<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id', 'firstname',
      'lastname', 'nip', 'regon', 'nip', 'krs', 'address',
      'postal_code', 'city', 'country', 'phone'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hotel(): HasOne
    {
        return $this->hasOne(Hotel::class);
    }
}

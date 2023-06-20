<?php

namespace App\Models;

use App\Models\Scopes\ClientScope;
use App\Models\Scopes\RoomScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'hotel_id', 'name', 'number_place', 'max_person', 'number_bed',
        'is_active', 'accomodation_type', 'accomodation_type_price',
        'description', 'available_date_from', 'available_date_to'
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new RoomScope());
    }
}

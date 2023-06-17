<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
      'hotel_id', 'name', 'number_place', 'max_person', 'number_bed',
        'is_active', 'accomodation_type', 'accomodation_type_price',
        'description', 'available_date_from', 'available_date_to'
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}

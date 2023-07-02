<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationRoom extends Model
{
    use HasFactory;

    protected $table = 'reservation_room';

    protected $fillable = [
      'reservation_id', 'room_id', 'room_number_place', 'hotel_id'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}

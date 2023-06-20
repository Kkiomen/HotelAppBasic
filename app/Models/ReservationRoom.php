<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reservation_room';

    protected $fillable = [
      'reservation_id', 'room_id'
    ];
}

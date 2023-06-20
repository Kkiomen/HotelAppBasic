<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hotel_user';

    protected $fillable = [
      'hotel_id', 'user_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationUser extends Model
{
    use HasFactory;
    protected $table = 'reservation_user';

    protected $fillable = [
        'reservation_id', 'user_id', 'balance_wallet', 'wallet_limit', 'wallet_hard_limit'
    ];
}

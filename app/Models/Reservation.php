<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =  [
        'hotel_id', 'check_in', 'check_out', 'description', 'total_basic_price', 'number_adult', 'number_child',
        'room_preference', 'paid_reservation', 'can_use_wallet', 'wallet_balance', 'cost_breakdown', 'purchase_by_other_guests',
        'wallet_limit', 'wallet_hard_limit', 'status', 'name_reservation_person', 'nip', 'regon', 'krs', 'address',
        'postal_code', 'city', 'country', 'phone', 'email'
    ];
}

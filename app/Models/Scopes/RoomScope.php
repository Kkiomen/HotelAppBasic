<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class RoomScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('rooms.hotel_id', Auth::user()->active_hotel)
            ->leftJoin('hotel_user', 'hotel_user.hotel_id', 'rooms.hotel_id')
            ->where('hotel_user.user_id', '=', Auth::user()->id);
    }
}

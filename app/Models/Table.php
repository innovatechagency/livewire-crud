<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Table extends Model
{
    protected $fillable = ['name','status','capacity','zone'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    // Réservations actives du jour
    public function todayReservations(): HasMany
    {
        return $this->hasMany(Reservation::class)
                    ->whereDate('reservation_date', today())
                    ->where('status', 'confirmed');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function activeOrder(): HasOne
    {
        return $this->hasOne(Order::class)
                    ->whereIn('status', ['pending', 'in_progress'])
                    ->latest();
    }
}

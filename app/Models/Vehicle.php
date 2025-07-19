<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'vehicle';
    protected $primaryKey = 'id';
    protected $fillable = [
            'vehicle_name',
            'vehicle_num',
            'price_per_km',
            'fuel_type',
            'model_year',
            'seating_capacity',
            'air_conditioner',
            'air_bags',
            'antilock_braking_system',
            'power_windows',
            'cd_player',
            'car_availability',
            'status',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at'
    ];
}

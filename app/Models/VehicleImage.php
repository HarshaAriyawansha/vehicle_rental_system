<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;
    protected $table = 'vehicle_images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'vehicle_id',
        'image_path',
        'remark',
        'status',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by'
    ];
}

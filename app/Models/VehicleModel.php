<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;
    protected $table = 'models';
    protected $primaryKey = 'id';
    protected $fillable = [
        'model_name',
        'brand_id',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by'
    ];
}

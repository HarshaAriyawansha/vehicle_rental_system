<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;    
    protected $table = 'booking';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_name',
        'customer_lno', 
        'vehicle_num',
        'mileage ',                                        
        'book_date',
        'message',
        'created_by',
        'created_at',      
        'return_date',
        'new_mileage',                                    
        'updated_at',
        'updated_by'
    ];
}

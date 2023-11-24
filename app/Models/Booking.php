<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    protected $fillable = [
        'bike_id',
        'customer_name',
        'customer_email',
        'dob',
        'age',
        'brand_name',
        'bike_name',
        'duration',
        'wanted_period',
        'per_hour_rent',
        'total_amount',
        'mobile',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'type', 'category', 'description', 'venue',
        'date_time', 'regular_price', 'vip_price', 'vvip_price', 'capacity', 'image'
    ];

    // Add this line to cast deleted_at and date_time to Carbon instances
    protected $dates = ['date_time', 'deleted_at'];
}

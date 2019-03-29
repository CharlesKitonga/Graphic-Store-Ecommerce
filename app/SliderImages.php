<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderImages extends Model
{
     protected $fillable = [
        'service_name', 'service_code', 'description', 'price','image',
    ];
}

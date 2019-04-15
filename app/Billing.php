<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
      protected $fillable = [
        'name', 'email', 'address','country','mobile',
    ];
}

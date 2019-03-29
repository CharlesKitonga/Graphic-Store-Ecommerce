<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'designs', 'designers', 'revisions', 'gurantee', 'price', 'image',
    ];
}

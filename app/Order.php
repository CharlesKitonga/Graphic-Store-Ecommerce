<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
 	  protected $fillable = ['user_id','name','email','address','country','mobile','delivered','total','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function orderItems(){
    	return $this->belongsToMany(Product::class)->withPivot('designs');
    }

    public function products(){
    	return $this->belongsToMany('App\Products_Attributes')->withPivot('designs');
    }
}

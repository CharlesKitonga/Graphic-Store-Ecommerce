<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','fname','lname','place','street','number','email','total','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function orderItems(){
    	return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function products(){
    	return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}

<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
     
     /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
        	'products.category_id' => 1,
            'products.product_name' => 10,
            'products.description' => 5,
        ],
    ];

     public function attributes(){
    	return $this->hasMany('App\Products_Attributes','product_id');
    }
     public function presentPrice()
    {
        return money_format('$%i', $this->price / 100);
    }
}

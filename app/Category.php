<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{		
	protected $table = 'category';
     protected $fillable = [
        'category_name', 'parent_id', 'description', 'url','image','status',
    ];

    public function categories(){
    	return $this->hasMany('App\Category','parent_id');

    }

     public function jobs(){
    	return $this->hasMany('App\Job','category_id');
    }
    public function attributes(){
    	return $this->hasMany('App\Products_Attributes','product_id');
    }
            public $cat_ids;        

}

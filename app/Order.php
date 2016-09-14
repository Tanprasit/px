<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
      protected $fillable = [
            'name',
            'price',
            'description',
      ];

      protected $hidden = [
      ];

      public function customer() {
            return $this->belongsToMany('App\Customer');
      }
}

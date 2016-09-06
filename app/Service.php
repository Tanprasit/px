<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
      protected $fillable = [
            'name',
            'cost'
      ];

      protected $hidden = [

      ];

      public function order() {
            return $this->hasMany('App\Order');
      }
}

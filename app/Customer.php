<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
      protected $fillable = [
            'title',
            'first_name',
            'last_name',
            'email',
            'home_number',
            'mobile_number'
      ];

      protected $hidden = [
            'password',
            'remember_token'
      ];

      // Customer have many orders. 

      public function orders() {
            return $this->hasMany('App\Orders');
      }
}

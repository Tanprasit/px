<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    //
      protected $fillable = [
            'full_name',
            'email',
            'contact_number',
            'password'
      ];

      protected $hidden = [
            'password',
            'remember_token'
      ];

      // Customer has many orders. 
      public function orders() {
            return $this->belongsToMany('App\Order');
      }

      // Customer has many cards.
      public function cards() {
            return $this->hasMany('App\Card');
      }
}

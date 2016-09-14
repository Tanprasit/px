<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Address;

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
            return $this->belongsToMany('App\Order')
                  ->withPivot('quantity', 'discount_amount', 'order_date', 'delivery_date', 'completed')
                  ->withTimestamps();
      }

      // Customer has many cards.
      public function cards() {
            return $this->hasMany('App\Card');
      }

      // A customer can have many addresses.
      public function addresses() {
            return $this->hasMany('App\Address');
      }
}

<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

use App\Address;
use App\Card;

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

      // Get all order lated to this user
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

      // Get primary addressess.
      public function getPrimaryAddress() {
            return Address::where('customer_id', $this->id)
                  ->where('primary', true)
                  ->first();
      }

      // Get primary card.
      public function getPrimaryCard() {
            return Card::where('customer_id', $this->id)
                  ->where('primary', true)
                  ->first();
      }

      public function makeOrder(Request $request) {

      }
}

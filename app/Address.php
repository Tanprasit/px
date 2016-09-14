<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;

class Address extends Model
{
    //
      protected $fillable = [
            'address_line_1',
            'address_line_2',
            'town_city',
            'county',
            'postcode',
            'primary',
      ];

      // An address belongs to one customer.
      public function customer() {
            return $this->belongsTo('App\Customer');
      }
}

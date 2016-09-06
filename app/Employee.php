<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
      protected $fillable = [
            'title',
            'first_name',
            'last_name',
            'email',
            'mobile_number'
      ];

      protected $hidden = [
            'password',
            'remember_token'
      ];

      // Employees fulfills many orders
      public function orders() {
            return $this->hasMany('App\Order');
      }
}

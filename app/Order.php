<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
      protected $fillable = [
            'placed_at',
            'deadline_at',
      ];

      protected $hidden = [
      ];

      public function customer() {
            return $this->belongsTo('App\Customer');
      }

      public function service() {
            return $this->belongsTo('App\Service');
      }

      public function Employee() {
            return $this->belongsTo('App\Employee');
      }
}

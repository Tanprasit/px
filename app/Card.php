<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
      protected $fillable = [
            'number',
            'name_on_card',
            'type',
            'expires',
            'primary',
      ];

      // Hide the card number from all arrays and jsons.
      protected $hidden = [
            'number'
      ];

      // Relationship between customer and card
      public function customer() {
            return $this->belongsTo('App\Customer');
      }

      // Get card number that had been masked with the character 'X'.
      public function getMaskedCardNumber() {
            // Mask the number on card.
            return str_repeat('X', strlen($this->number) - 4) . substr($this->number, -4);
      }

      // Get an easy to read expire date.
      public function getExpireDate() {
            $dt = Carbon::parse($this->expires);
            return ($dt->month < 10) 
                  ? '0'. $dt->month . ' / ' . $dt->year
                  : $dt->month . ' / ' . $dt->year;
      }
}

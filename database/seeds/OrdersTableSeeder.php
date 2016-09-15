<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
      /**
      * Run the database seeds.
      *
      * @return void
      */
      public function run()
      {
            //
            DB::table('orders')->insert([
                  'name' => 'Adult',
                  'description' => 'N/a',
                  'price' => 0.80,
            ]);

            DB::table('orders')->insert([
                  'name' => 'Children',
                  'description' => '0 - 4 yrs',
                  'price' => 0.50,
            ]);

            DB::table('orders')->insert([
                  'name' => 'Children',
                  'description' => '5 - 14 yrs',
                  'price' => 0.40,
            ]);

            DB::table('orders')->insert([
                  'name' => 'Bedding',
                  'description' => 'N/a',
                  'price' => 2.00,
            ]);
      }
}

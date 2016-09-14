<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('town_city');
            $table->string('county');
            $table->string('postcode'); 
            $table->boolean('primary')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('addresses');
    }
}

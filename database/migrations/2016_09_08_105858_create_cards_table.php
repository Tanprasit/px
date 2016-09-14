<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('number');
            $table->integer('customer_id');
            $table->string('name_on_card');
            $table->string('type');
            $table->timestamp('expires');
            $table->boolean('primary');
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
        Schema::drop('cards');
    }
}

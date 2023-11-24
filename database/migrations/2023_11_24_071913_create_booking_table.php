<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id('booking_id');
            $table->string('bike_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->date('dob');
            $table->integer('age');
            $table->string('brand_name');
            $table->string('bike_name');
            $table->string('duration');
            $table->integer('wanted_period');
            $table->double('per_hour_rent');
            $table->double('total_amount');
            $table->string('mobile');
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
        Schema::dropIfExists('booking');
    }
}

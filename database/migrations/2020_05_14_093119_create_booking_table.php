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
            $table->bigIncrements('id');
            $table->string('booking_code', 11);
            $table->string('customer_name', 255);
            $table->string('customer_email', 255)->nullable();
            $table->string('customer_phone', 20);
            $table->text('customer_address');
            $table->text('note')->nullable();
            $table->float('total_price',20,2);
            $table->integer('total_item');
            $table->unsignedBigInteger('payment_method_id');
            $table->string('booking_status', 20);
            $table->unsignedBigInteger('uid')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->string('discount_code', 11)->nullable();
            $table->float('discount_price',20,2)->nullable();
            $table->text('images')->nullable();
            $table->dateTime('time_from', 0);
            $table->dateTime('time_to', 0)->nullable();
            $table->unsignedBigInteger('service_id');
            $table->tinyInteger('is_rated')->default(0);
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

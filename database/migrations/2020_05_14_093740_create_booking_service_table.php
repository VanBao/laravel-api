<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_service', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('service_price_id');
            $table->unsignedBigInteger('booking_id');
            $table->string('type', 50);
            $table->integer('quantity');
            $table->float('price', 20, 2)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_service');
    }
}

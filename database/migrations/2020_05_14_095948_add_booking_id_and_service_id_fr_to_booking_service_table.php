<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookingIdAndServiceIdFrToBookingServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_service', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('booking');
//            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('service_price_id')->references('id')->on('service_prices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_service', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
//            $table->dropForeign(['service_id']);
            $table->dropForeign(['service_price_id']);
        });
    }
}

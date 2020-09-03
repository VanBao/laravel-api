<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookingIdFrToBookingRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_rating', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('booking');
            $table->foreign('uid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_rating', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
            $table->dropForeign(['uid']);
        });
    }
}

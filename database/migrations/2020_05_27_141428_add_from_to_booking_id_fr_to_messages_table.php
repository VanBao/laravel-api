<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFromToBookingIdFrToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('from')->references('id')->on('users');
            $table->foreign('to')->references('id')->on('users');
            $table->foreign('booking_id')->references('id')->on('booking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['from']);
            $table->dropForeign(['to']);
            $table->dropForeign(['booking_id']);
        });
    }
}

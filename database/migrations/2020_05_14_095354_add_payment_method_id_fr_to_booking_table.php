<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentMethodIdFrToBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('uid')->references('id')->on('users');
            $table->foreign('staff_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropForeign(['payment_method_id']);
            $table->dropForeign(['uid']);
            $table->dropForeign(['staff_id']);
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_activity', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('booking_id');
            $table->string('column', 255);
            $table->text('old_value');
            $table->text('new_value');
            $table->text('reason');
            $table->unsignedBigInteger('created_id');
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
        Schema::dropIfExists('booking_activity');
    }
}

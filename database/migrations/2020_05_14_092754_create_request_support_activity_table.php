<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestSupportActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_support_activity', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('uid');
            $table->tinyInteger('is_read');
            $table->text('note');
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
        Schema::dropIfExists('request_support_activity');
    }
}

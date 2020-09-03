<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationUidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_uid', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('uid');
            $table->unsignedBigInteger('notification_id');
            $table->tinyInteger('is_read')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_uid');
    }
}

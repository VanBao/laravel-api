<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUidAndNotificationIdToNotificationUidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notification_uid', function (Blueprint $table) {
            $table->foreign('uid')->references('id')->on('users');
            $table->foreign('notification_id')->references('id')->on('notifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification_uid', function (Blueprint $table) {
            $table->dropForeign(['uid']);
            $table->dropForeign(['notification_id']);
        });
    }
}

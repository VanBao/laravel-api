<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequestIdFrToRequestSupportActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_support_activity', function (Blueprint $table) {
            $table->foreign('request_id')->references('id')->on('request_supports');
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
        Schema::table('request_support_activity', function (Blueprint $table) {
            $table->dropForeign(['request_id']);
            $table->dropForeign(['uid']);
        });
    }
}

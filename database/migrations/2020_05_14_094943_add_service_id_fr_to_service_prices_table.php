<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceIdFrToServicePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_prices', function (Blueprint $table) {
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('created_id')->references('id')->on('users');
            $table->foreign('updated_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_prices', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropForeign(['created_id']);
            $table->dropForeign(['updated_id']);
        });
    }
}

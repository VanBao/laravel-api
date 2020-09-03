<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_id');
            $table->string('name', 255);
            $table->text('avatar')->nullable();
            $table->text('content')->nullable();
            $table->float('price_online',20,2)->nullable();
            $table->string('price_online_type',50)->nullable();
            $table->float('price_offline',20,2)->nullable();
            $table->string('price_offline_type',50)->nullable();
            $table->unsignedBigInteger('created_id');
            $table->unsignedBigInteger('updated_id')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('service_prices');
    }
}

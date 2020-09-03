<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->text('summary');
            $table->text('content');
            $table->text('avatar');
            $table->text('background');
            $table->text('images');
            $table->tinyInteger('status');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('created_id');
            $table->unsignedBigInteger('updated_id')->nullable();
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
        Schema::dropIfExists('services');
    }
}

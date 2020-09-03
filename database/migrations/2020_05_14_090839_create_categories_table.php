<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->tinyInteger('status');
            $table->text('description')->nullable();
            $table->text('summary')->nullable();
            $table->text('avatar');
            $table->text('icon');
            $table->text('background');
            $table->text('images');
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
        Schema::dropIfExists('categories');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets_code', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->index();
            $table->string('code',6);
            $table->tinyInteger('times')->default(0);
            $table->tinyInteger('is_used')->default(0);
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
        Schema::dropIfExists('password_resets_code');
    }
}

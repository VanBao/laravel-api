<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_supports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 255);
            $table->string('phone', 20);
            $table->text('address');
            $table->text('content')->nullable();
            $table->unsignedBigInteger('uid');
            $table->text('attached_files')->nullable();
            $table->string('status', 50);
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
        Schema::dropIfExists('request_supports');
    }
}

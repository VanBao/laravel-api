<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupIdAndRoleIdFrToGroupRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_role', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_role', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropForeign(['role_id']);
        });
    }
}

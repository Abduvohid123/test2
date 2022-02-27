<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkersTable extends Migration
{
    public function up()
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->unsignedBigInteger('position_id')->nullable();
            $table->foreign('position_id', 'position_fk_5508817')->references('id')->on('positions');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6098135')->references('id')->on('users');
        });
    }
}

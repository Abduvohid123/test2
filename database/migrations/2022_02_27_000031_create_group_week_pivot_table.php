<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupWeekPivotTable extends Migration
{
    public function up()
    {
        Schema::create('group_week', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id', 'group_id_fk_5508874')->references('id')->on('groups')->onDelete('cascade');
            $table->unsignedBigInteger('week_id');
            $table->foreign('week_id', 'week_id_fk_5508874')->references('id')->on('weeks')->onDelete('cascade');
        });
    }
}

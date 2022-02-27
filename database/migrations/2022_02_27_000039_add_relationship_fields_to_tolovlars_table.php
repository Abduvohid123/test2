<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTolovlarsTable extends Migration
{
    public function up()
    {
        Schema::table('tolovlars', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id', 'group_fk_5591340')->references('id')->on('groups');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_fk_5580715')->references('id')->on('students');
            $table->unsignedBigInteger('month_id')->nullable();
            $table->foreign('month_id', 'month_fk_5581035')->references('id')->on('months');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentWeekPivotTable extends Migration
{
    public function up()
    {
        Schema::create('student_week', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id', 'student_id_fk_6097522')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('week_id');
            $table->foreign('week_id', 'week_id_fk_6097522')->references('id')->on('weeks')->onDelete('cascade');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupStudentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('group_student', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id', 'student_id_fk_5511927')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id', 'group_id_fk_5511927')->references('id')->on('groups')->onDelete('cascade');
        });
    }
}

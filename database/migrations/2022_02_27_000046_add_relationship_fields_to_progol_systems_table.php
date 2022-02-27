<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProgolSystemsTable extends Migration
{
    public function up()
    {
        Schema::table('progol_systems', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id', 'group_fk_5599216')->references('id')->on('groups');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_fk_6098096')->references('id')->on('students');
            $table->unsignedBigInteger('filial_id')->nullable();
            $table->foreign('filial_id', 'filial_fk_6100085')->references('id')->on('filials');
        });
    }
}

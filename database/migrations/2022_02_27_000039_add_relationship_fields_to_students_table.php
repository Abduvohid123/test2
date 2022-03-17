<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('tuman_id')->nullable();
            $table->foreign('tuman_id', 'tuman_fk_6097542')->references('id')->on('tumanlars');
            $table->unsignedBigInteger('reklama_id')->nullable();
            $table->foreign('reklama_id', 'reklama_fk_6097288')->references('id')->on('reklamas');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6098113')->references('id')->on('users');
        });
    }
}

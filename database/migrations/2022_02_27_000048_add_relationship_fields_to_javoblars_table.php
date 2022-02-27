<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJavoblarsTable extends Migration
{
    public function up()
    {
        Schema::table('javoblars', function (Blueprint $table) {
            $table->unsignedBigInteger('savol_id')->nullable();
            $table->foreign('savol_id', 'savol_fk_6098479')->references('id')->on('savollars');
        });
    }
}

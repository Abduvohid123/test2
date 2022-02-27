<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTumanlarsTable extends Migration
{
    public function up()
    {
        Schema::table('tumanlars', function (Blueprint $table) {
            $table->unsignedBigInteger('viloyat_id')->nullable();
            $table->foreign('viloyat_id', 'viloyat_fk_6097537')->references('id')->on('viloyatlars');
        });
    }
}

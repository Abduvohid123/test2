<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtaOnasTable extends Migration
{
    public function up()
    {
        Schema::create('ota_onas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('status')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

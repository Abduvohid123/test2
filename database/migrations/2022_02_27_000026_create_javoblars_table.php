<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJavoblarsTable extends Migration
{
    public function up()
    {
        Schema::create('javoblars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('javob');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

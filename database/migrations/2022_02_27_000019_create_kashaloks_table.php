<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKashaloksTable extends Migration
{
    public function up()
    {
        Schema::create('kashaloks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('summa', 15, 2);
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

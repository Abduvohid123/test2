<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTolovlarsTable extends Migration
{
    public function up()
    {
        Schema::create('tolovlars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year');
            $table->string('status');
            $table->float('summa', 15, 2);
            $table->float('chegirma', 15, 2);
            $table->string('tolov_turi');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

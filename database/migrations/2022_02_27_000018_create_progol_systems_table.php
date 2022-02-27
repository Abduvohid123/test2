<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgolSystemsTable extends Migration
{
    public function up()
    {
        Schema::create('progol_systems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('day')->nullable();
            $table->string('active')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

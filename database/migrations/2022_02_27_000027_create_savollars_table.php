<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavollarsTable extends Migration
{
    public function up()
    {
        Schema::create('savollars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('savol')->nullable();
            $table->longText('savol_title');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

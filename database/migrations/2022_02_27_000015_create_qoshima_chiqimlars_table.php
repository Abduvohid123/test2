<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQoshimaChiqimlarsTable extends Migration
{
    public function up()
    {
        Schema::create('qoshima_chiqimlars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('chiqim_sababi');
            $table->float('summa', 15, 2);
            $table->string('who_is_deleted')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

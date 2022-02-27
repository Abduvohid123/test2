<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoshqaIshchilarMaoshlarisTable extends Migration
{
    public function up()
    {
        Schema::create('boshqa_ishchilar_maoshlaris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('summa', 15, 2);
            $table->float('bonus', 15, 2);
            $table->float('jarima', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

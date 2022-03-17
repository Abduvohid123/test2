<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBoshqaIshchilarMaoshlarisTable extends Migration
{
    public function up()
    {
        Schema::table('boshqa_ishchilar_maoshlaris', function (Blueprint $table) {
            $table->unsignedBigInteger('worker_id')->nullable();
            $table->foreign('worker_id', 'worker_fk_5583064')->references('id')->on('workers');
            $table->unsignedBigInteger('filial_id')->nullable();
            $table->foreign('filial_id', 'filial_fk_6100055')->references('id')->on('filials');
        });
    }
}

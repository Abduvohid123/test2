<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToQoshimaChiqimlarsTable extends Migration
{
    public function up()
    {
        Schema::table('qoshima_chiqimlars', function (Blueprint $table) {
            $table->unsignedBigInteger('kim_tarafidan_olindi_id')->nullable();
            $table->foreign('kim_tarafidan_olindi_id', 'kim_tarafidan_olindi_fk_5664393')->references('id')->on('workers');
            $table->unsignedBigInteger('filial_id')->nullable();
            $table->foreign('filial_id', 'filial_fk_6100054')->references('id')->on('filials');
        });
    }
}

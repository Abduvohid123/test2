<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSorovnomasTable extends Migration
{
    public function up()
    {
        Schema::table('sorovnomas', function (Blueprint $table) {
            $table->unsignedBigInteger('filial_id')->nullable();
            $table->foreign('filial_id', 'filial_fk_6100090')->references('id')->on('filials');
        });
    }
}

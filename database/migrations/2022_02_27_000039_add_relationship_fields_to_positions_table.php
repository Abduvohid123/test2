<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPositionsTable extends Migration
{
    public function up()
    {
        Schema::table('positions', function (Blueprint $table) {
            $table->unsignedBigInteger('filial_id')->nullable();
            $table->foreign('filial_id', 'filial_fk_6100086')->references('id')->on('filials');
        });
    }
}

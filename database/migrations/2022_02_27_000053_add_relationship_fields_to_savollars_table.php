<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSavollarsTable extends Migration
{
    public function up()
    {
        Schema::table('savollars', function (Blueprint $table) {
            $table->unsignedBigInteger('savol_type_id')->nullable();
            $table->foreign('savol_type_id', 'savol_type_fk_6098473')->references('id')->on('savol_types');
            $table->unsignedBigInteger('filial_id')->nullable();
            $table->foreign('filial_id', 'filial_fk_6100100')->references('id')->on('filials');
        });
    }
}

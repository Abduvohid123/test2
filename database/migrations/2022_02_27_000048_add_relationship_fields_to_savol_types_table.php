<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSavolTypesTable extends Migration
{
    public function up()
    {
        Schema::table('savol_types', function (Blueprint $table) {
            $table->unsignedBigInteger('sorovnoma_id')->nullable();
            $table->foreign('sorovnoma_id', 'sorovnoma_fk_6098445')->references('id')->on('sorovnomas');
        });
    }
}

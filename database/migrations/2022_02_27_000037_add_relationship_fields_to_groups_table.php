<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id', 'room_fk_5508562')->references('id')->on('rooms');
            $table->unsignedBigInteger('fan_id')->nullable();
            $table->foreign('fan_id', 'fan_fk_5511852')->references('id')->on('fans');
            $table->unsignedBigInteger('filial_id')->nullable();
            $table->foreign('filial_id', 'filial_fk_6100083')->references('id')->on('filials');
        });
    }
}

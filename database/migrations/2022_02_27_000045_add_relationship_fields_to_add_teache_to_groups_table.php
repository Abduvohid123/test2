<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddTeacheToGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('add_teache_to_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id', 'group_fk_5584703')->references('id')->on('groups');
            $table->unsignedBigInteger('filial_id')->nullable();
            $table->foreign('filial_id', 'filial_fk_6100084')->references('id')->on('filials');
        });
    }
}

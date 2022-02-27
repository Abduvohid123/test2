<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddTeacheToGroupWorkerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('add_teache_to_group_worker', function (Blueprint $table) {
            $table->unsignedBigInteger('add_teache_to_group_id');
            $table->foreign('add_teache_to_group_id', 'add_teache_to_group_id_fk_6098112')->references('id')->on('add_teache_to_groups')->onDelete('cascade');
            $table->unsignedBigInteger('worker_id');
            $table->foreign('worker_id', 'worker_id_fk_6098112')->references('id')->on('workers')->onDelete('cascade');
        });
    }
}

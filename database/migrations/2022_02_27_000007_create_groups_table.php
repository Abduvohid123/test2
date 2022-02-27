<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->float('cost', 15, 2);
            $table->longText('description')->nullable();
            $table->string('status');
            $table->time('start')->nullable();
            $table->time('finish')->nullable();
            $table->date('start_cource')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

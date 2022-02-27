<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddTeacheToGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('add_teache_to_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sallary_type');
            $table->float('oylik', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTableOrder extends Migration
{

    public function up()
    {
        Schema::create('orders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->float('total_paid');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('orders');
    }
}

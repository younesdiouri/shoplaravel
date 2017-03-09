<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->float('price');
            $table->string('imageurl');
            $table->string('file_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('products');
    }
}


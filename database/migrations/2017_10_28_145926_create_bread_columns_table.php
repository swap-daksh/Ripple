<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreadColumnsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bread_columns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bread');
            $table->string('column');
            $table->string('data_type');
            $table->string('display_name');
            $table->string('type');
            $table->tinyInteger('required')->default(0);
            $table->tinyInteger('browse')->default(0);
            $table->tinyInteger('read')->default(0);
            $table->tinyInteger('edit')->default(0);
            $table->tinyInteger('add')->default(0);
            $table->tinyInteger('delete')->default(0);
            $table->tinyInteger('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bread_columns');
    }

}

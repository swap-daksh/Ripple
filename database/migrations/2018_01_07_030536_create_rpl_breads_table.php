<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRplBreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpl_breads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table');
            $table->string('slug');
            $table->string('display_singular');
            $table->string('display_plural');
            $table->string('icon')->nullable();
            $table->string('model')->nullable();
            $table->string('controller')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('rpl_breads');
    }
}

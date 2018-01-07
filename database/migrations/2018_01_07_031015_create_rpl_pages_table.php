<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRplPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpl_pages', function (Blueprint $table) {
             $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->integer('author');
            $table->string('password')->nullable();
            $table->string('status');
            $table->string('visibility')->default('public')->nullable();
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('rpl_pages');
    }
}

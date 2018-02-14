<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRplRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpl_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rel_table');
            $table->string('rel_column');
            $table->string('ref_table');
            $table->string('ref_column');
            $table->string('ref_display');
            $table->integer('sync_result')->default(0);
            $table->string('sync_with')->nullable();
            $table->string('sync_table')->nullable();
            $table->string('sync_column')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('rpl_relations');
    }
}

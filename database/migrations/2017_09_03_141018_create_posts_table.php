<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->longText('content')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('image')->nullable();
            $table->integer('author');
            $table->string('comments')->default('open');
            $table->string('comment_count')->nullable()->default(0);
            $table->string('categories')->nullable();
            $table->string('tags')->nullable();
            $table->string('password')->nullable();
            $table->string('type')->default('post');
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
        Schema::dropIfExists('posts');
    }
}

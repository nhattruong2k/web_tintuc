<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloggers', function (Blueprint $table) {
            $table->id();
            $table->string('tenblog');
            $table->string('slug_blog');
            $table->text('content');
            $table->string('user_id');
            $table->string('tomtat');
            $table->string('image');
            $table->integer('danhmuc_id');
            $table->integer('kichhoat');
            $table->integer('blog_noibat')->default('0');
            $table->integer('views')->default('0');
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
        Schema::dropIfExists('bloggers');
    }
}

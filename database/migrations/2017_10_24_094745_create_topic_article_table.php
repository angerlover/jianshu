<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicArticleTable extends Migration
{
    /**
     *  文章和专题的关系表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->default(0);
            $table->integer('topic_id')->default(0);
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
        Schema::dropIfExists('article_topics');
    }
}

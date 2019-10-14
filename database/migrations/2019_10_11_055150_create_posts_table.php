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
            $table->increments('id')->comment("主键ID");
            $table->string('title',150)->nullable()->comment('');
$table->text('content')->nullable()->comment('');



            $table->timestamp("created_at")->useCurrent()->comment("创建时间");
            $table->timestamp("updated_at")->useCurrent()->comment("更新时间");
        });
        DB::statement("ALTER TABLE posts comment '注释' ");//表注释

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

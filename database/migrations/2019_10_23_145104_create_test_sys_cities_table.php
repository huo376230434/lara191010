<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestSysCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_sys_cities', function (Blueprint $table) {
            $table->increments('id')->comment("主键ID");
            $table->string('name',150)->nullable()->comment('名称');
            $table->unsignedInteger('parent_id')->default(0)->comment('');
            $table->unsignedInteger('node_id')->default(0)->comment('');
            $table->string('code',150)->nullable()->comment('');
            $table->index("parent_id");

//            $table->dateTime("created_at")->comment("创建时间");
//            $table->dateTime("updated_at")->comment("更新时间");
        });
        DB::statement("ALTER TABLE test_sys_cities comment ' 地区表' ");//表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_sys_cities');
    }
}
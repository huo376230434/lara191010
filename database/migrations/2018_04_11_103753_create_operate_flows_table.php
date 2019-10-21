<?php

use Huojunhao\Lib\Utils\MigrateUtil;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperateFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operate_flows', function (Blueprint $table) {
            $table->increments('id')->comment(" 主键ID");
            $table->unsignedInteger("admin_user_id")->comment("操作用户ID");

            $table->string("message")->comment("操作信息");
             $table->timestamp("created_at")->useCurrent()->comment("创建时间");
            $table->timestamp("updated_at")->useCurrent()->comment("更新时间");
        });
        MigrateUtil::migrateTableComment("operate_flows","业务日志表");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operate_flows');
    }
}

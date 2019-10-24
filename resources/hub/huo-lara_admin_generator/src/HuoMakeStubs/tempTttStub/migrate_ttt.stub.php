<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenancyTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return config('tenancy.database.connection') ?: config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('tenancy.database.users_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 190)->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });


//        Schema::create(config('tenancy.database.menu_table'), function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('parent_id')->default(0);
//            $table->integer('order')->default(0);
//            $table->string('title', 50);
//            $table->string('icon', 50);
//            $table->string('uri', 50)->nullable();
//            $table->string('permission')->nullable();
//
//            $table->timestamps();
//        });
//
//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('tenancy.database.users_table'));
//        Schema::dropIfExists(config('tenancy.database.roles_table'));
//        Schema::dropIfExists(config('tenancy.database.permissions_table'));
//        Schema::dropIfExists(config('tenancy.database.menu_table'));
//        Schema::dropIfExists(config('tenancy.database.user_permissions_table'));
//        Schema::dropIfExists(config('tenancy.database.role_users_table'));
//        Schema::dropIfExists(config('tenancy.database.role_permissions_table'));
//        Schema::dropIfExists(config('tenancy.database.role_menu_table'));
//        Schema::dropIfExists(config('tenancy.database.operation_log_table'));
    }
}

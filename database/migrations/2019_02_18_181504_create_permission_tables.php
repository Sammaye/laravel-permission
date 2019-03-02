<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('permission_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('permission_id');

            /*
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


            $table
                ->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');
            */
            $table->index(['user_id', 'permission_id']);
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');

            /*
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table
                ->foreign('role_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');
            */
            $table->index(['user_id', 'role_id']);
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');

            $table->index(['role_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permission_users');
        Schema::dropIfExists('role_users');
        Schema::dropIfExists('permission_roles');
    }
}

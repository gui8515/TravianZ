<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('description')->nullable();
            $table->date('birthday')->nullable();
            $table->string('location')->nullable();
            $table->integer('id_tribe');
            $table->integer('id_alliance')->nullable();
            $table->boolean('is_plus')->default(false);
            $table->boolean('is_gold')->default(false);
            $table->boolean('is_protected')->default(false);
            $table->boolean('is_online')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->timestamp('plus_expires_at')->nullable();
            $table->timestamp('gold_expires_at')->nullable();
            $table->timestamp('protect_expires_at')->nullable();
            $table->timestamp('last_online')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('banned_at')->nullable();
            $table->integer('access_level')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Parser\Multiple;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->id()->autoIncrement();
            // $table->uuid('uuid')->unique();
            $table->integer('id_user');
            $table->string('name')->default('Village');
            $table->boolean('is_capital')->default(false);
            $table->integer('id_village')->nullable();
            $table->integer('population')->default(0);
            $table->integer('loyalty')->default(100);
            $table->integer('culture_points')->default(0);
            $table->integer('max_culture_points')->default(env('CULTURE_POINTS_MAX', 500));
            $table->integer('wood')->default(env('VILLAGE_WOOD_START', 800)*env('STORAGE_MULTIPLIER', 1));
            $table->integer('max_wood')->default(env('VILLAGE_WOOD_MAX', 800)*env('STORAGE_MULTIPLIER', 1));
            $table->integer('stone')->default(env('VILLAGE_STONE_START', 800)*env('STORAGE_MULTIPLIER', 1));
            $table->integer('max_stone')->default(env('VILLAGE_STONE_MAX', 800)*env('STORAGE_MULTIPLIER', 1));
            $table->integer('iron')->default(env('VILLAGE_IRON_START', 800)*env('STORAGE_MULTIPLIER', 1));
            $table->integer('max_iron')->default(env('VILLAGE_IRON_MAX', 800)*env('STORAGE_MULTIPLIER', 1));
            $table->integer('crop')->default(env('VILLAGE_CROP_START', 800)*env('STORAGE_MULTIPLIER', 1));
            $table->integer('max_crop')->default(env('VILLAGE_CROP_MAX', 800)*env('STORAGE_MULTIPLIER', 1));
            $table->integer('wood_prod')->default(0);
            $table->integer('stone_prod')->default(0);
            $table->integer('iron_prod')->default(0);
            $table->integer('crop_prod')->default(0);
            $table->integer('wood_prod_bonus')->default(0);
            $table->integer('stone_prod_bonus')->default(0);
            $table->integer('iron_prod_bonus')->default(0);
            $table->integer('crop_prod_bonus')->default(0);
            $table->timestamps();

            // Relationships
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_village')->references('id')->on('villages');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villages');
    }
};

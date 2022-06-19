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
            $table->integer('id_user');
            $table->integer('id_village')->nullable();

            $table->string('name')->default('Village');
            $table->integer('type')->default(0);

            $table->boolean('is_capital')->default(false);
            $table->boolean('is_abandoned')->default(false);

            // Coordinates
            // $table->integer('x')->default(0);
            // $table->integer('y')->default(0);

            // World Wonder
            $table->boolean('is_ww')->default(false);
            $table->string('ww_name')->default(0);
            $table->integer('ww_level')->default(0);
            $table->integer('ww_level_max')->default(env('WW_LEVEL_MAX', 100));

            // Expansion
            $table->integer('expansion_max')->default(env('VILLAGE_EXPANSION_MAX', 3));

            // Population
            $table->integer('population')->default(3);
            $table->integer('population_max')->default(env('VILLAGE_POPULATION_MAX', 1000));

            // Gold
            $table->integer('gold')->default(0);
            $table->integer('gold_max')->default(env('VILLAGE_GOLD_MAX', 100));

            // Silver
            $table->integer('silver')->default(0);
            $table->integer('silver_max')->default(env('VILLAGE_SILVER_MAX', 1000));

            // Loyalty
            $table->integer('loyalty')->default(100);
            $table->integer('loyalty_max')->default(env('VILLAGE_LOYALTY_MAX', 100)*env('VILLAGE_LOYALTY_MAX_MULTIPLIER', 1));
            $table->integer('loyalty_prod')->default(0);
            $table->integer('loyalty_bonus')->default(0);

            // Culture Points
            $table->integer('culture')->default(0);
            $table->integer('culture_max')->default(env('VILLAGE_CULTURE_MAX', 500)*env('VILLAGE_CULTURE_MULTIPLIER', 1));
            $table->integer('culture_prod')->default(0);
            $table->integer('culture_bonus')->default(0);

            // Wood
            $table->integer('wood')->default(env('VILLAGE_WOOD_START', 800)*env('VILLAGE_STORAGE_MULTIPLIER', 1));
            $table->integer('wood_max')->default(env('VILLAGE_WOOD_MAX', 800)*env('VILLAGE_STORAGE_MULTIPLIER', 1));
            $table->integer('wood_prod')->default(0);
            $table->integer('wood_bonus')->default(0);

            // Clay
            $table->integer('clay')->default(env('VILLAGE_CLAY_START', 800)*env('VILLAGE_STORAGE_MULTIPLIER', 1));
            $table->integer('clay_max')->default(env('VILLAGE_CLAY_MAX', 800)*env('VILLAGE_STORAGE_MULTIPLIER', 1));
            $table->integer('clay_prod')->default(0);
            $table->integer('clay_bonus')->default(0);

            // Iron
            $table->integer('iron')->default(env('VILLAGE_IRON_START', 800)*env('VILLAGE_STORAGE_MULTIPLIER', 1));
            $table->integer('iron_max')->default(env('VILLAGE_IRON_MAX', 800)*env('VILLAGE_STORAGE_MULTIPLIER', 1));
            $table->integer('iron_prod')->default(0);
            $table->integer('iron_bonus')->default(0);

            // Crop
            $table->integer('crop')->default(env('VILLAGE_CROP_START', 800)*env('VILLAGE_STORAGE_MULTIPLIER', 1));
            $table->integer('crop_max')->default(env('VILLAGE_CROP_MAX', 800)*env('VILLAGE_STORAGE_MULTIPLIER', 1));
            $table->integer('crop_prod')->default(0);
            $table->integer('crop_bonus')->default(0);

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

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
        Schema::create('village_fields', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('village_id');
            $table->integer('field');
            $table->integer('build_type');
            $table->integer('level')->default(0);
            $table->boolean('is_resource')->default(false);
            $table->boolean('is_building')->default(false);
            $table->boolean('is_upgrading')->default(false);
            $table->boolean('is_constructed')->default(false);
            $table->boolean('is_destroyed')->default(false);
            $table->boolean('is_occupied')->default(false);

            $table->timestamps();

            // Relationships
            $table->foreign('village_id')->references('id')->on('villages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('village_fields');
    }
};

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
            $table->integer('id_village');
            $table->integer('field');
            $table->integer('building')->default(0);
            $table->integer('level')->default(0);
            $table->boolean('is_resource')->default(false);

            $table->timestamps();

            // Relationships
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
        Schema::dropIfExists('village_fields');
    }
};

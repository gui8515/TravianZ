<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Village;

return new class extends Migration
{
    // Run the migrations
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Village::class);
            $table->integer('tribe')->default(0);
            $table->integer('type')->default(0);
            $table->integer('amount')->default(1);
            $table->integer('blacksmith_level')->default(0);
            $table->integer('tournament_level')->default(0);
            $table->timestamps();
        });
    }

    // Reverse the migrations
    public function down()
    {
        Schema::dropIfExists('units');
    }
};

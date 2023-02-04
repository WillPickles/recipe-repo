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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('recipe_name');
            $table->integer('recipe_servings')->nullable();
            $table->enum('recipe_type', ['breakfast', 'lunch', 'dinner', 'snack', 'sweet']);
            $table->integer('prep_time')->nullable();
            $table->integer('cook_time')->nullable();
            $table->text('other_information')->nullable();
            $table->text('description')->nullable();
            $table->text('method');
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
        Schema::dropIfExists('recipes');
    }
};

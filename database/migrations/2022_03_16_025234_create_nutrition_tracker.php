<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionTracker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition_tracker', function (Blueprint $table) {
            $table->increments('id_nutrition_tracker');
            $table->integer('id_user');
            $table->string('menu_makanan_sehat');
            $table->string('kandungan_nutrisi');
            $table->string('manfaat_makanan_sehat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nutrition_tracker');
    }
}

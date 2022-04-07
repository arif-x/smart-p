<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition', function (Blueprint $table) {
            $table->increments('id_nutrition');
            $table->string('id_kategori_nutrition');
            $table->string('judul_nutrition');
            $table->string('judul_nutrition_en');
            $table->text('img_nutrition');
            $table->text('konten_nutrition');
            $table->text('konten_nutrition_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nutrition');
    }
}

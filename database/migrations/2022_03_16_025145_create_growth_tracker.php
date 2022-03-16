<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrowthTracker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('growth_tracker', function (Blueprint $table) {
            $table->increments('id_growth_tracker');
            $table->integer('id_user');
            $table->string('berat_badan');
            $table->string('index_masa_tumbuh');
            $table->string('lingkar_kepala');
            $table->string('lingkar_lengan_atas');
            $table->string('lipatan_kulit');
            $table->string('tinggi_badan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('growth_tracker');
    }
}

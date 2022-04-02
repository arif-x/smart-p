<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinationTracker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccination_tracker', function (Blueprint $table) {
            $table->increments('id_vaccination_tracker');
            $table->integer('id_anak');
            $table->string('jadwal_imunisasi');
            $table->string('tipe_imunisasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccination_tracker');
    }
}

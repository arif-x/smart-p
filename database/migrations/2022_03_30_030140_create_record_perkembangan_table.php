<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordPerkembanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_perkembangan', function (Blueprint $table) {
            $table->increments('id_record_perkembangan');
            $table->string('id_anak');
            $table->string('tanggal');
            $table->string('tinggi_badan_perkembangan');
            $table->string('berat_badan_perkembangan');
            $table->string('lingkar_kepala_perkembangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record_perkembangan');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anak', function (Blueprint $table) {
            $table->increments('id_anak');
            $table->integer('id_user');
            $table->string('jenis_kelamin');
            $table->string('nama_anak');
            $table->string('nama_panggilan');
            $table->string('tanggal_lahir');
            $table->string('minggu_kehamilan');
            $table->string('tinggi_badan_lahir');
            $table->string('berat_badan_lahir');
            $table->string('lingkar_kepala_lahir');
            $table->string('tinggi_badan_perkembangan');
            $table->string('berat_badan_perkembangan');
            $table->string('lingkar_kepala_perkembangan');
            $table->string('status_vaksin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anak');
    }
}

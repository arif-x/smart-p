<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('development', function (Blueprint $table) {
            $table->increments('id_development');
            $table->string('id_kategori_development');
            $table->string('id_anak');
            $table->string('jenis');
            $table->string('untuk_usia');
            $table->string('untuk_usia_en');
            $table->string('judul_development');
            $table->string('judul_development_en');
            $table->string('keterangan');
            $table->string('keterangan_en');
            $table->string('stimulus1');
            $table->string('stimulus1_en');
            $table->string('stimulus2');
            $table->string('stimulus2_en');
            $table->string('stimulus3');
            $table->string('stimulus3_en');
            $table->string('stimulus4');
            $table->string('stimulus4_en');
            $table->string('thumnile');
            $table->string('url_video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('development');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsultasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->increments('id_konsultasi');
            $table->string('id_kategori_konsultasi');
            $table->string('id_user');
            $table->string('tanggal_konsultasi');
            $table->string('pertanyaan');
            $table->string('jawaban_konsultasi');
            $table->string('jumlah_like');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konsultasi');
    }
}

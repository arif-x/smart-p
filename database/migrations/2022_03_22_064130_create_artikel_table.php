<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel', function (Blueprint $table) {
            $table->increments('id_artikel');
            $table->string('judul_artikel');
            $table->string('judul_artikel_en');
            $table->string('thumbnail');
            $table->string('label');
            $table->string('label_en');
            $table->string('konten');
            $table->string('konten_en');
            $table->string('id_bahasa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artikel');
    }
}

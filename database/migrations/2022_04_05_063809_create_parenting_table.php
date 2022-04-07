<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parentings', function (Blueprint $table) {
            $table->increments('id_parenting');
            $table->string('id_jenis_parenting');
            $table->string('id_kategori_parenting');
            $table->string('kategori_parenting');
            $table->string('kategori_parenting_en');
            $table->string('judul_parenting');
            $table->string('judul_parenting_en');
            $table->string('thumnile_parenting');
            $table->string('konten_parenting');
            $table->string('konten_parenting_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parenting');
    }
}

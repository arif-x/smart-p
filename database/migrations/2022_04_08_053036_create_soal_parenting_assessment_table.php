<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalParentingAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_parenting_assessment', function (Blueprint $table) {
            $table->increments('id_soal_parenting_assessment');
            $table->string('id_kategori_parenting_assessment');
            $table->string('soal');
            $table->string('soal_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal_parenting_assessment');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKunciJawabanParentingAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kunci_jawaban_parenting_assessment', function (Blueprint $table) {
            $table->increments('id_kunci_jawaban_parenting_assessment');
            $table->string('id_soal_parenting_assessment');
            $table->string('kunci_jawaban');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kunci_jawaban_parenting_assessment');
    }
}

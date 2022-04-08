<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanParentingAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_parenting_assessment', function (Blueprint $table) {
            $table->increments('id_jawaban_parenting_assessment');
            $table->string('id_user');
            $table->string('id_soal_parenting_assessment');
            $table->string('jawaban');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_parenting_assessment');
    }
}

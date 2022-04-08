<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriParentingAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_parenting_assessment', function (Blueprint $table) {
            $table->increments('id_kategori_parenting_assessment');
            $table->string('kategori_parenting_assessment');
            $table->string('kategori_parenting_assessment_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_parenting_assessment');
    }
}

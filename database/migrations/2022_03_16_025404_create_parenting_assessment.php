<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentingAssessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parenting_assessment', function (Blueprint $table) {
            $table->increments('parenting_assessment');
            $table->integer('id_parenting_assessment');
            $table->string('pengukuran_pengetahuan_parenting');
            $table->string('pengukuran_parenting_self_efficacy');
            $table->string('pengukuran_keterampilan_mengasuh_anak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parenting_assessment');
    }
}

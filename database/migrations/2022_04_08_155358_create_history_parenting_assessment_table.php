<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryParentingAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_parenting_assessment', function (Blueprint $table) {
            $table->increments('id_history_parenting_assessment');
            $table->string('id_user');
            $table->string('id_kategori_parenting_assessment');
            $table->string('skor');
            $table->string('tanggal_pengerjaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_parenting_assessment');
    }
}

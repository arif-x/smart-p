<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordVaksinasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_vaksinasi', function (Blueprint $table) {
            $table->increments('id_record_vaksinasi');
            $table->string('id_anak');
            $table->string('tanggal');
            $table->string('id_vaksin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record_vaksinasi');
    }
}

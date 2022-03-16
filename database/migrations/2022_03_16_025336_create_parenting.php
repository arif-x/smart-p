<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParenting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parenting', function (Blueprint $table) {
            $table->increments('id_parenting');
            $table->integer('id_user');
            $table->string('modul_pengasuhan_anak');
            $table->string('video_tutorial_teknik_stimulasi');
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

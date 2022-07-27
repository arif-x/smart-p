<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\KategoriArtikel;

class CreateKategoriArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_artikel', function (Blueprint $table) {
            $table->increments('id_kategori_artikel');
            $table->string('kategori_artikel');
            $table->string('kategori_artikel_en');
        });

        KategoriArtikel::insert(
            [
                'kategori_artikel' => 'Artikel',
                'kategori_artikel_en' => 'Article',
            ],
            [
                'kategori_artikel' => 'Video',
                'kategori_artikel_en' => 'Video',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_artikel');
    }
}

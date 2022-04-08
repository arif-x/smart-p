<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\KlasifikasiTinggiBadan;

class CreateKlasifikasiTinggiBadanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klasifikasi_tinggi_badan', function (Blueprint $table) {
            $table->increments('id_klasifikasi_tinggi_badan');
            $table->string('jenis_kelamin');
            $table->string('bulan');
            $table->string('min');
            $table->string('max');
            $table->string('klasifikasi_tinggi_badan');
            $table->string('klasifikasi_tinggi_badan_en');
            $table->string('saran_klasifikasi_tinggi_badan');
            $table->string('saran_klasifikasi_tinggi_badan_en');
            $table->string('hex_tinggi_badan');
        });

        $data = array(
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '75',
                'max' => '85',
                'klasifikasi_tinggi_badan' => 'Malnutrisi',
                'saran_klasifikasi_tinggi_badan' => 'Konsultasikan kebutuhan gizi anak Anda pada ahli pediatrik',
                'klasifikasi_tinggi_badan_en' => 'Malnutrisi',
                'saran_klasifikasi_tinggi_badan_en' => 'Konsultasikan kebutuhan gizi anak Anda pada ahli pediatrik',
                'hex_tinggi_badan' => 'merah',
                'id_bahasa' => '1'
            ],
        );

        foreach ($data as $newData){
            $klasifikasi = new KlasifikasiTinggiBadan();
            $klasifikasi->jenis_kelamin = $newData['jenis_kelamin'];
            $klasifikasi->bulan = $newData['bulan'];
            $klasifikasi->min = $newData['min'];
            $klasifikasi->max = $newData['max'];
            $klasifikasi->klasifikasi_tinggi_badan = $newData['klasifikasi_tinggi_badan'];
            $klasifikasi->saran_klasifikasi_tinggi_badan = $newData['saran_klasifikasi_tinggi_badan'];
            $klasifikasi->klasifikasi_tinggi_badan_en = $newData['klasifikasi_tinggi_badan_en'];
            $klasifikasi->saran_klasifikasi_tinggi_badan_en = $newData['saran_klasifikasi_tinggi_badan_en'];
            $klasifikasi->hex_tinggi_badan = $newData['hex_tinggi_badan'];
            $klasifikasi->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klasifikasi_tinggi_badan');
    }
}

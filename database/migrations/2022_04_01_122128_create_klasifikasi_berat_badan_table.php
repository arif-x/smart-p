<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\KlasifikasiBeratBadan;

class CreateKlasifikasiBeratBadanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klasifikasi_berat_badan', function (Blueprint $table) {
            $table->increments('id_klasifikasi_berat_badan');
            $table->string('jenis_kelamin');
            $table->string('bulan');
            $table->string('min');
            $table->string('max');
            $table->string('klasifikasi_berat_badan');
            $table->string('klasifikasi_berat_badan_en');
            $table->string('saran_klasifikasi_berat_badan');
            $table->string('saran_klasifikasi_berat_badan_en');
            $table->string('hex_berat_badan');
        });

        $data = array(
            // 36 L
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '7',
                'max' => '10',
                'klasifikasi_berat_badan' => 'Malnutrisi',
                'saran_klasifikasi_berat_badan' => 'Konsultasikan kebutuhan gizi anak Anda pada ahli pediatrik',
                'klasifikasi_berat_badan_en' => 'Malnutrisi EN',
                'saran_klasifikasi_berat_badan_en' => 'Konsultasikan kebutuhan gizi anak Anda pada ahli pediatrik EN',
                'hex_berat_badan' => 'merah',
                'id_bahasa' => '1'
            ],
        );

        foreach ($data as $newData){
            $klasifikasi = new KlasifikasiBeratBadan();
            $klasifikasi->jenis_kelamin = $newData['jenis_kelamin'];
            $klasifikasi->bulan = $newData['bulan'];
            $klasifikasi->min = $newData['min'];
            $klasifikasi->max = $newData['max'];
            $klasifikasi->klasifikasi_berat_badan = $newData['klasifikasi_berat_badan'];
            $klasifikasi->saran_klasifikasi_berat_badan = $newData['saran_klasifikasi_berat_badan'];
            $klasifikasi->klasifikasi_berat_badan_en = $newData['klasifikasi_berat_badan_en'];
            $klasifikasi->saran_klasifikasi_berat_badan_en = $newData['saran_klasifikasi_berat_badan_en'];
            $klasifikasi->hex_berat_badan = $newData['hex_berat_badan'];
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
        Schema::dropIfExists('klasifikasi_berat_badan');
    }
}

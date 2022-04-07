<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\KlasifikasiLingkarKepala;

class CreateKlasifikasiLingkarKepalaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klasifikasi_lingkar_kepala', function (Blueprint $table) {
            $table->increments('id_klasifikasi_lingkar_kepala');
            $table->string('jenis_kelamin');
            $table->string('bulan');
            $table->string('min');
            $table->string('max');
            $table->string('klasifikasi_lingkar_kepala');
            $table->string('klasifikasi_lingkar_kepala_en');
            $table->string('saran_klasifikasi_lingkar_kepala');
            $table->string('saran_klasifikasi_lingkar_kepala_en');
            $table->string('hex_lingkar_kepala');
        });

        $data = array(
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '30',
                'max' => '45.2',
                'klasifikasi_lingkar_kepala' => 'Mikrosefali',
                'saran_klasifikasi_lingkar_kepala' => 'Lakukan pemeriksaan pada dokter agar mengetahui diagnosa perkembangan otak anak Anda',
                'klasifikasi_lingkar_kepala_en' => 'Mikrosefali',
                'saran_klasifikasi_lingkar_kepala_en' => 'Lakukan pemeriksaan pada dokter agar mengetahui diagnosa perkembangan otak anak Anda',
                'hex_lingkar_kepala' => 'merah',
            ],
        );

        foreach ($data as $newData){
            $klasifikasi = new KlasifikasiLingkarKepala();
            $klasifikasi->jenis_kelamin = $newData['jenis_kelamin'];
            $klasifikasi->bulan = $newData['bulan'];
            $klasifikasi->min = $newData['min'];
            $klasifikasi->max = $newData['max'];
            $klasifikasi->klasifikasi_lingkar_kepala = $newData['klasifikasi_lingkar_kepala'];
            $klasifikasi->saran_klasifikasi_lingkar_kepala = $newData['saran_klasifikasi_lingkar_kepala'];
            $klasifikasi->klasifikasi_lingkar_kepala_en = $newData['klasifikasi_lingkar_kepala_en'];
            $klasifikasi->saran_klasifikasi_lingkar_kepala_en = $newData['saran_klasifikasi_lingkar_kepala_en'];
            $klasifikasi->hex_lingkar_kepala = $newData['hex_lingkar_kepala'];
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
        Schema::dropIfExists('klasifikasi_lingkar_kepala');
    }
}

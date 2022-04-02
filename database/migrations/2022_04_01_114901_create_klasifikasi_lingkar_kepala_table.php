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
            $table->string('saran_klasifikasi_lingkar_kepala');
            $table->string('hex_lingkar_kepala');
            $table->string('id_bahasa');
        });

        $data = array(
            // 36 L
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '30',
                'max' => '45.2',
                'klasifikasi_lingkar_kepala' => 'Mikrosefali',
                'saran_klasifikasi_lingkar_kepala' => 'Lakukan pemeriksaan pada dokter agar mengetahui diagnosa perkembangan otak anak Anda',
                'hex_lingkar_kepala' => 'merah',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '45.2',
                'max' => '46.6',
                'klasifikasi_lingkar_kepala' => 'Mendekati Mikrosefali',
                'saran_klasifikasi_lingkar_kepala' => 'Konsultasikan pada dokter untuk mengetahui lebih dalam mengenai mikrosefalus pada anak Anda',
                'hex_lingkar_kepala' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '46.6',
                'max' => '48',
                'klasifikasi_lingkar_kepala' => 'Normal',
                'saran_klasifikasi_lingkar_kepala' => 'Pertumbuhan dan perkembangan lingkar kepala anak Anda sudah baik',
                'hex_lingkar_kepala' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '48',
                'max' => '50.9',
                'klasifikasi_lingkar_kepala' => 'Normal',
                'saran_klasifikasi_lingkar_kepala' => 'Pertumbuhan dan perkembangan lingkar kepala anak Anda sudah baik',
                'hex_lingkar_kepala' => 'hijau_tua',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '50.9',
                'max' => '52.3',
                'klasifikasi_lingkar_kepala' => 'Normal',
                'saran_klasifikasi_lingkar_kepala' => 'Pertumbuhan dan perkembangan lingkar kepala anak Anda sudah baik',
                'hex_lingkar_kepala' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '52.3',
                'max' => '53.7',
                'klasifikasi_lingkar_kepala' => 'Mendekati Mikrosefali',
                'saran_klasifikasi_lingkar_kepala' => 'Konsultasikan pada dokter untuk mengetahui lebih dalam mengenai mikrosefalus pada anak Anda',
                'hex_lingkar_kepala' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '53.7',
                'max' => '56',
                'klasifikasi_lingkar_kepala' => 'Mikrosefali',
                'saran_klasifikasi_lingkar_kepala' => 'Lakukan pemeriksaan pada dokter agar mengetahui diagnosa perkembangan otak anak Anda',
                'hex_lingkar_kepala' => 'merah',
                'id_bahasa' => '1'
            ],
            

            // 36 P
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '30',
                'max' => '45.2',
                'klasifikasi_lingkar_kepala' => 'Mikrosefali',
                'saran_klasifikasi_lingkar_kepala' => 'Lakukan pemeriksaan pada dokter agar mengetahui diagnosa perkembangan otak anak Anda',
                'hex_lingkar_kepala' => 'merah',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '45.2',
                'max' => '46.6',
                'klasifikasi_lingkar_kepala' => 'Mendekati Mikrosefali',
                'saran_klasifikasi_lingkar_kepala' => 'Konsultasikan pada dokter untuk mengetahui lebih dalam mengenai mikrosefalus pada anak Anda',
                'hex_lingkar_kepala' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '46.6',
                'max' => '48',
                'klasifikasi_lingkar_kepala' => 'Normal',
                'saran_klasifikasi_lingkar_kepala' => 'Pertumbuhan dan perkembangan lingkar kepala anak Anda sudah baik',
                'hex_lingkar_kepala' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '48',
                'max' => '50.9',
                'klasifikasi_lingkar_kepala' => 'Normal',
                'saran_klasifikasi_lingkar_kepala' => 'Pertumbuhan dan perkembangan lingkar kepala anak Anda sudah baik',
                'hex_lingkar_kepala' => 'hijau_tua',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '50.9',
                'max' => '52.3',
                'klasifikasi_lingkar_kepala' => 'Normal',
                'saran_klasifikasi_lingkar_kepala' => 'Pertumbuhan dan perkembangan lingkar kepala anak Anda sudah baik',
                'hex_lingkar_kepala' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '52.3',
                'max' => '53.7',
                'klasifikasi_lingkar_kepala' => 'Mendekati Mikrosefali',
                'saran_klasifikasi_lingkar_kepala' => 'Konsultasikan pada dokter untuk mengetahui lebih dalam mengenai mikrosefalus pada anak Anda',
                'hex_lingkar_kepala' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '53.7',
                'max' => '56',
                'klasifikasi_lingkar_kepala' => 'Mikrosefali',
                'saran_klasifikasi_lingkar_kepala' => 'Lakukan pemeriksaan pada dokter agar mengetahui diagnosa perkembangan otak anak Anda',
                'hex_lingkar_kepala' => 'merah',
                'id_bahasa' => '1'
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
            $klasifikasi->hex_lingkar_kepala = $newData['hex_lingkar_kepala'];
            $klasifikasi->id_bahasa = $newData['id_bahasa'];
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

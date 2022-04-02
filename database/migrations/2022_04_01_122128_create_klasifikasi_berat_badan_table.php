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
            $table->string('saran_klasifikasi_berat_badan');
            $table->string('hex_berat_badan');
            $table->string('id_bahasa');
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
                'hex_berat_badan' => 'merah',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '10',
                'max' => '11.3',
                'klasifikasi_berat_badan' => 'Berat Badan Kurang',
                'saran_klasifikasi_berat_badan' => 'Konsultasikan pada dokter untuk mengetahui lebih dalam mengenai mikrosefalus pada anak Anda',
                'hex_berat_badan' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '11.3',
                'max' => '12.7',
                'klasifikasi_berat_badan' => 'Normal',
                'saran_klasifikasi_berat_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '12.7',
                'max' => '16.2',
                'klasifikasi_berat_badan' => 'Normal',
                'saran_klasifikasi_berat_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_tua',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '16.2',
                'max' => '18.3',
                'klasifikasi_berat_badan' => 'Normal',
                'saran_klasifikasi_berat_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '18.3',
                'max' => '20.4',
                'klasifikasi_berat_badan' => 'Berat Badan Lebih',
                'saran_klasifikasi_berat_badan' => 'Konsultasikan pada dokter untuk mengetahui lebih dalam mengenai mikrosefalus pada anak Anda',
                'hex_berat_badan' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '20.4',
                'max' => '24',
                'klasifikasi_berat_badan' => 'Obesitas',
                'saran_klasifikasi_berat_badan' => 'Konsultasikan kebutuhan gizi anak Anda pada ahli pediatrik',
                'hex_berat_badan' => 'merah',
                'id_bahasa' => '1'
            ],
            

            // 36 P
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '7',
                'max' => '10',
                'klasifikasi_berat_badan' => 'Malnutrisi',
                'saran_klasifikasi_berat_badan' => 'Konsultasikan kebutuhan gizi anak Anda pada ahli pediatrik',
                'hex_berat_badan' => 'merah',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '10',
                'max' => '11.3',
                'klasifikasi_berat_badan' => 'Berat Badan Kurang',
                'saran_klasifikasi_berat_badan' => 'Konsultasikan pada dokter untuk mengetahui lebih dalam mengenai mikrosefalus pada anak Anda',
                'hex_berat_badan' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '11.3',
                'max' => '12.7',
                'klasifikasi_berat_badan' => 'Normal',
                'saran_klasifikasi_berat_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '12.7',
                'max' => '16.2',
                'klasifikasi_berat_badan' => 'Normal',
                'saran_klasifikasi_berat_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_tua',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '16.2',
                'max' => '18.3',
                'klasifikasi_berat_badan' => 'Normal',
                'saran_klasifikasi_berat_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '18.3',
                'max' => '20.4',
                'klasifikasi_berat_badan' => 'Berat Badan Lebih',
                'saran_klasifikasi_berat_badan' => 'Jadwalkan pemberian makanan yang bergizi pada anak Anda secara rutin sesuai tahapan usianya',
                'hex_berat_badan' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '20.4',
                'max' => '24',
                'klasifikasi_berat_badan' => 'Obesitas',
                'saran_klasifikasi_berat_badan' => 'Konsultasikan kebutuhan gizi anak Anda pada ahli pediatrik',
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
            $klasifikasi->hex_berat_badan = $newData['hex_berat_badan'];
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
        Schema::dropIfExists('klasifikasi_berat_badan');
    }
}

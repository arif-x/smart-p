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
            $table->string('saran_klasifikasi_tinggi_badan');
            $table->string('hex_berat_badan');
            $table->string('id_bahasa');
        });

        $data = array(
            // 36 L
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '75',
                'max' => '85',
                'klasifikasi_tinggi_badan' => 'Malnutrisi',
                'saran_klasifikasi_tinggi_badan' => 'Konsultasikan kebutuhan gizi anak Anda pada ahli pediatrik',
                'hex_berat_badan' => 'merah',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '85',
                'max' => '88.7',
                'klasifikasi_tinggi_badan' => 'Berat Badan Kurang',
                'saran_klasifikasi_tinggi_badan' => 'Konsultasikan pada dokter untuk mengetahui lebih dalam mengenai mikrosefalus pada anak Anda',
                'hex_berat_badan' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '88.7',
                'max' => '92.4',
                'klasifikasi_tinggi_badan' => 'Normal',
                'saran_klasifikasi_tinggi_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '92.4',
                'max' => '96.1',
                'klasifikasi_tinggi_badan' => 'Normal',
                'saran_klasifikasi_tinggi_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_tua',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '96.1',
                'max' => '99.8',
                'klasifikasi_tinggi_badan' => 'Normal',
                'saran_klasifikasi_tinggi_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '99.8',
                'max' => '103.5',
                'klasifikasi_tinggi_badan' => 'Berat Badan Lebih',
                'saran_klasifikasi_tinggi_badan' => 'Konsultasikan pada dokter untuk mengetahui lebih dalam mengenai mikrosefalus pada anak Anda',
                'hex_berat_badan' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'L',
                'bulan' => '36',
                'min' => '103.5',
                'max' => '125',
                'klasifikasi_tinggi_badan' => 'Obesitas',
                'saran_klasifikasi_tinggi_badan' => 'Konsultasikan kebutuhan gizi anak Anda pada ahli pediatrik',
                'hex_berat_badan' => 'merah',
                'id_bahasa' => '1'
            ],
            

            // 36 P
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '75',
                'max' => '85',
                'klasifikasi_tinggi_badan' => 'Malnutrisi',
                'saran_klasifikasi_tinggi_badan' => 'Konsultasikan kebutuhan gizi anak Anda pada ahli pediatrik',
                'hex_berat_badan' => 'merah',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '85',
                'max' => '88.7',
                'klasifikasi_tinggi_badan' => 'Berat Badan Kurang',
                'saran_klasifikasi_tinggi_badan' => 'Konsultasikan pada dokter untuk mengetahui lebih dalam mengenai mikrosefalus pada anak Anda',
                'hex_berat_badan' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '88.7',
                'max' => '92.4',
                'klasifikasi_tinggi_badan' => 'Normal',
                'saran_klasifikasi_tinggi_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '92.4',
                'max' => '96.1',
                'klasifikasi_tinggi_badan' => 'Normal',
                'saran_klasifikasi_tinggi_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_tua',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '96.1',
                'max' => '99.8',
                'klasifikasi_tinggi_badan' => 'Normal',
                'saran_klasifikasi_tinggi_badan' => 'Kebutuhan gizi anak Anda sudah baik, pertahankan.',
                'hex_berat_badan' => 'hijau_muda',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '99.8',
                'max' => '103.5',
                'klasifikasi_tinggi_badan' => 'Berat Badan Lebih',
                'saran_klasifikasi_tinggi_badan' => 'Jadwalkan pemberian makanan yang bergizi pada anak Anda secara rutin sesuai tahapan usianya',
                'hex_berat_badan' => 'kuning',
                'id_bahasa' => '1'
            ],
            [
                'jenis_kelamin' => 'P',
                'bulan' => '36',
                'min' => '103.5',
                'max' => '125',
                'klasifikasi_tinggi_badan' => 'Obesitas',
                'saran_klasifikasi_tinggi_badan' => 'Konsultasikan kebutuhan gizi anak Anda pada ahli pediatrik',
                'hex_berat_badan' => 'merah',
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
        Schema::dropIfExists('klasifikasi_tinggi_badan');
    }
}

<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Anak;
use App\Models\Bahasa;
use App\Models\RecordPerkembangan;
use App\Models\RecordVaksinasi;
use App\Models\VaccinationTracker;
use App\Models\Vaksin;
use App\Models\Artikel;
use App\Models\KlasifikasiBeratBadan;
use App\Models\KlasifikasiTinggiBadan;
use App\Models\KlasifikasiLingkarKepala;

class HomeController extends Controller
{
    public function index(Request $request){
        $data_anak = Anak::where('id_user', $request->id_user)->orderBy('id_anak', 'DESC')->limit(1)->get();

        if(count($data_anak) == 0){
            return response()->json([
                'status' => true,
                'message' => 'Data anak nggak ada',
            ], 201);
        } else {
            $data_record = RecordPerkembangan::where('id_anak', $data_anak[0]['id_anak'])->orderBy('id_record_perkembangan', 'DESC')->limit(1)->get();

            $data_vaksinasi_anak = RecordVaksinasi::where('id_anak', $data_anak[0]['id_anak'])->get('id_vaksin');

            $vaksinasi = array();

            foreach ($data_vaksinasi_anak as $key => $value) {
                array_push($vaksinasi, $value['id_vaksin']);
            }

            $config_bahasa = Bahasa::where('id_bahasa', $request->id_bahasa)->value('id_bahasa');

            $data_vaksin = Vaksin::whereNotIn('id_vaksin', $vaksinasi)->get();

            $data_artikel = Artikel::orderBy('id_artikel', 'DESC')->limit(5)->get();

            $date_record = Carbon::createFromFormat('d/m/Y', $data_record[0]['tanggal'])->format('Y-m-d');
            $date_record = Carbon::parse($date_record);
            $date_lahir = Carbon::createFromFormat('d/m/Y', $data_anak[0]['tanggal_lahir'])->format('Y-m-d');
            $date_lahir = Carbon::parse($date_lahir);

            $daftar_bulan = $date_record->diffInMonths($date_lahir);

            $klasifikasi_tinggi_badan = DB::select(DB::raw("SELECT * FROM klasifikasi_tinggi_badan WHERE ".$data_record[0]['tinggi_badan_perkembangan']." BETWEEN min AND max AND jenis_kelamin = '".$data_anak[0]['jenis_kelamin']."' AND id_bahasa = '".$request->id_bahasa."'"));
            $data_record[0]['klasifikasi_tinggi_badan'] = $klasifikasi_tinggi_badan[0]->klasifikasi_tinggi_badan;
            $data_record[0]['saran_klasifikasi_tinggi_badan'] = $klasifikasi_tinggi_badan[0]->saran_klasifikasi_tinggi_badan;
            $data_record[0]['hex_tinggi_badan'] = $klasifikasi_tinggi_badan[0]->hex_tinggi_badan;

            $klasifikasi_berat_badan = DB::select(DB::raw("SELECT * FROM klasifikasi_berat_badan WHERE ".$data_record[0]['berat_badan_perkembangan']." BETWEEN min AND max AND jenis_kelamin = '".$data_anak[0]['jenis_kelamin']."' AND id_bahasa = '".$request->id_bahasa."'"));
            $data_record[0]['klasifikasi_berat_badan'] = $klasifikasi_berat_badan[0]->klasifikasi_berat_badan;
            $data_record[0]['saran_klasifikasi_berat_badan'] = $klasifikasi_berat_badan[0]->saran_klasifikasi_berat_badan;
            $data_record[0]['hex_berat_badan'] = $klasifikasi_berat_badan[0]->hex_berat_badan;


            $klasifikasi_lingkar_kepala = DB::select(DB::raw("SELECT * FROM klasifikasi_lingkar_kepala WHERE ".$data_record[0]['lingkar_kepala_perkembangan']." BETWEEN min AND max AND jenis_kelamin = '".$data_anak[0]['jenis_kelamin']."' AND id_bahasa = '".$request->id_bahasa."'"));
            $data_record[0]['klasifikasi_lingkar_kepala'] = $klasifikasi_lingkar_kepala[0]->klasifikasi_lingkar_kepala;
            $data_record[0]['saran_klasifikasi_lingkar_kepala'] = $klasifikasi_lingkar_kepala[0]->saran_klasifikasi_lingkar_kepala;
            $data_record[0]['hex_lingkar_kepala'] = $klasifikasi_lingkar_kepala[0]->hex_lingkar_kepala;

            $tahun = $daftar_bulan/12;
            $tahun = (int)$tahun;
            $data_anak[0]['tahun'] = $tahun;

            $bulan = $daftar_bulan/$tahun;
            $bulan = (int)$bulan;
            $data_anak[0]['bulan'] = $bulan;

            if(!($data_record)){
                return response()->json([
                    'status' => true,
                    'message' => 'Data record nggak ada',
                ], 201);
            } else {
                if(!($data_vaksin)){
                    if(!($data_artikel)){
                        return response()->json([
                            'status' => true,
                            'message' => 'Data artikel nggak ada',
                        ], 201);
                    } else {
                        return response()->json([
                            'status' => true,
                            'message' => 'Data Didapat',
                            'data_anak' => $data_anak,
                            'data_record' => $data_record,
                            'data_vaksin_yang_belum' => 'Nggak Ada',
                            'data_artikel' => 'Nggak Ada',
                        ], 200);
                    }
                } else {
                    return response()->json([
                        'status' => true,
                        'message' => 'Data Didapat',
                        'data_anak' => $data_anak,
                        'data_record' => $data_record,
                        'data_vaksin_yang_belum' => $data_vaksin,
                        'data_artikel' => $data_artikel
                    ], 200);
                }
            }
        }
    }

    public function show($id_anak, Request $request){
        $data_anak = Anak::where('id_user', $request->id_user)->where('id_anak', $id_anak)->get();
        $data_record = RecordPerkembangan::where('id_anak', $data_anak[0]['id_anak'])->orderBy('id_record_perkembangan', 'DESC')->limit(1)->get();

        $data_vaksinasi_anak = RecordVaksinasi::where('id_anak', $data_anak[0]['id_anak'])->get('id_vaksin');

        $vaksinasi = array();

        foreach ($data_vaksinasi_anak as $key => $value) {
            array_push($vaksinasi, $value['id_vaksin']);
        }

        $data_vaksin = Vaksin::whereNotIn('id_vaksin', $vaksinasi)->get();

        if(!($data_anak)){
            return response()->json([
                'status' => true,
                'message' => 'Data anak nggak ada',
            ], 201);
        } else {
            if(!($data_record)){
                return response()->json([
                    'status' => true,
                    'message' => 'Data record nggak ada',
                ], 201);
            } else {
                if(!($data_vaksin)){
                    return response()->json([
                        'status' => true,
                        'message' => 'Data Didapat',
                        'data_anak' => $data_anak,
                        'data_record' => $data_record,
                        'data_vaksin_yang_belum' => 'Nggak Ada'
                    ], 200);
                } else {
                    return response()->json([
                        'status' => true,
                        'message' => 'Data Didapat',
                        'data_anak' => $data_anak,
                        'data_record' => $data_record,
                        'data_vaksin_yang_belum' => $data_vaksin
                    ], 200);
                }
            }
        }
    }

    public function getAll(Request $request){
        $data_anak = Anak::where('id_user', $request->id_user)->get();

        if(!($data_anak)){
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Didapat'
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Didapat',
                'data' => $data_anak
            ], 200);
        }
    }
}

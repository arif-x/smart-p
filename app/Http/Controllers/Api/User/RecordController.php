<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Anak;
use App\Models\RecordPerkembangan;

class RecordController extends Controller
{
    public function index(Request $request){
        $data_anak = Anak::where('id_user', $request->id_user)->where('id_anak', $request->id_anak)->get();
        $data_perkembangan_tinggi_badan = RecordPerkembangan::where('id_anak', $request->id_anak)->select('id_record_perkembangan', 'id_anak', 'tanggal', 'tinggi_badan_perkembangan')->get();

        $data_perkembangan_berat_badan = RecordPerkembangan::where('id_anak', $request->id_anak)->select('id_record_perkembangan', 'id_anak', 'tanggal', 'berat_badan_perkembangan')->get();

        $data_perkembangan_lingkar_kepala = RecordPerkembangan::where('id_anak', $request->id_anak)->select('id_record_perkembangan', 'id_anak', 'tanggal', 'lingkar_kepala_perkembangan')->get();

        $param_grafik = $request->parameter_grafik;

        if($param_grafik == 1){
            for ($i=0; $i < count($data_perkembangan_tinggi_badan); $i++) { 
                $date_record = Carbon::createFromFormat('d/m/Y', $data_perkembangan_tinggi_badan[$i]['tanggal'])->format('Y-m-d');
                $date_record = Carbon::parse($date_record);
                $date_lahir = Carbon::createFromFormat('d/m/Y', $data_anak[0]['tanggal_lahir'])->format('Y-m-d');
                $date_lahir = Carbon::parse($date_lahir);

                $daftar_bulan = $date_record->diffInMonths($date_lahir);

                $klasifikasi_tinggi_badan = DB::select(DB::raw("SELECT * FROM klasifikasi_tinggi_badan WHERE ".$data_perkembangan_tinggi_badan[$i]['tinggi_badan_perkembangan']." BETWEEN min AND max AND jenis_kelamin = '".$data_anak[0]['jenis_kelamin']."'"));

                $data_perkembangan_tinggi_badan[$i]['klasifikasi_tinggi_badan'] = $klasifikasi_tinggi_badan[0]->klasifikasi_tinggi_badan;
                $data_perkembangan_tinggi_badan[$i]['klasifikasi_tinggi_badan_en'] = $klasifikasi_tinggi_badan[0]->klasifikasi_tinggi_badan_en;
                $data_perkembangan_tinggi_badan[$i]['saran_klasifikasi_tinggi_badan'] = $klasifikasi_tinggi_badan[0]->saran_klasifikasi_tinggi_badan;
                $data_perkembangan_tinggi_badan[$i]['saran_klasifikasi_tinggi_badan_en'] = $klasifikasi_tinggi_badan[0]->saran_klasifikasi_tinggi_badan_en;
                $data_perkembangan_tinggi_badan[$i]['hex_tinggi_badan'] = $klasifikasi_tinggi_badan[0]->hex_tinggi_badan;
                $data_perkembangan_tinggi_badan[$i]['bulan'] = $daftar_bulan;
            }

            return response()->json([
                'status' => true,
                'message' => 'Data Didapat',
                'data_tinggi_badan' => $data_perkembangan_tinggi_badan
            ]);
        } elseif ($param_grafik == 2) {
            for ($i=0; $i < count($data_perkembangan_berat_badan); $i++) { 
                $date_record = Carbon::createFromFormat('d/m/Y', $data_perkembangan_berat_badan[$i]['tanggal'])->format('Y-m-d');
                $date_record = Carbon::parse($date_record);
                $date_lahir = Carbon::createFromFormat('d/m/Y', $data_anak[0]['tanggal_lahir'])->format('Y-m-d');
                $date_lahir = Carbon::parse($date_lahir);

                $daftar_bulan = $date_record->diffInMonths($date_lahir);


                $klasifikasi_berat_badan = DB::select(DB::raw("SELECT * FROM klasifikasi_berat_badan WHERE ".$data_perkembangan_berat_badan[$i]['berat_badan_perkembangan']." BETWEEN min AND max AND jenis_kelamin = '".$data_anak[0]['jenis_kelamin']."'"));

                $data_perkembangan_berat_badan[$i]['klasifikasi_berat_badan'] = $klasifikasi_berat_badan[0]->klasifikasi_berat_badan;
                $data_perkembangan_berat_badan[$i]['klasifikasi_berat_badan_en'] = $klasifikasi_berat_badan[0]->klasifikasi_berat_badan_en;
                $data_perkembangan_berat_badan[$i]['saran_klasifikasi_berat_badan'] = $klasifikasi_berat_badan[0]->saran_klasifikasi_berat_badan;
                $data_perkembangan_berat_badan[$i]['saran_klasifikasi_berat_badan_en'] = $klasifikasi_berat_badan[0]->saran_klasifikasi_berat_badan_en;
                $data_perkembangan_berat_badan[$i]['hex_berat_badan'] = $klasifikasi_berat_badan[0]->hex_berat_badan;
                $data_perkembangan_berat_badan[$i]['bulan'] = $daftar_bulan;
            }

            return response()->json([
                'status' => true,
                'message' => 'Data Didapat',
                'data_berat_badan' => $data_perkembangan_berat_badan
            ]);
        }  elseif ($param_grafik == 3) {
            for ($i=0; $i < count($data_perkembangan_lingkar_kepala); $i++) { 
                $date_record = Carbon::createFromFormat('d/m/Y', $data_perkembangan_lingkar_kepala[$i]['tanggal'])->format('Y-m-d');
                $date_record = Carbon::parse($date_record);
                $date_lahir = Carbon::createFromFormat('d/m/Y', $data_anak[0]['tanggal_lahir'])->format('Y-m-d');
                $date_lahir = Carbon::parse($date_lahir);

                $daftar_bulan = $date_record->diffInMonths($date_lahir);


                $klasifikasi_lingkar_kepala = DB::select(DB::raw("SELECT * FROM klasifikasi_lingkar_kepala WHERE ".$data_perkembangan_lingkar_kepala[$i]['lingkar_kepala_perkembangan']." BETWEEN min AND max AND jenis_kelamin = '".$data_anak[0]['jenis_kelamin']."'"));

                $data_perkembangan_lingkar_kepala[$i]['klasifikasi_lingkar_kepala'] = $klasifikasi_lingkar_kepala[0]->klasifikasi_lingkar_kepala;
                $data_perkembangan_lingkar_kepala[$i]['klasifikasi_lingkar_kepala_en'] = $klasifikasi_lingkar_kepala[0]->klasifikasi_lingkar_kepala_en;
                $data_perkembangan_lingkar_kepala[$i]['saran_klasifikasi_lingkar_kepala'] = $klasifikasi_lingkar_kepala[0]->saran_klasifikasi_lingkar_kepala;
                $data_perkembangan_lingkar_kepala[$i]['saran_klasifikasi_lingkar_kepala_en'] = $klasifikasi_lingkar_kepala[0]->saran_klasifikasi_lingkar_kepala_en;
                $data_perkembangan_lingkar_kepala[$i]['hex_lingkar_kepala'] = $klasifikasi_lingkar_kepala[0]->hex_lingkar_kepala;
                $data_perkembangan_lingkar_kepala[$i]['bulan'] = $daftar_bulan;
            }

            return response()->json([
                'status' => true,
                'message' => 'Data Didapat',
                'data_lingkar_kepala' => $data_perkembangan_lingkar_kepala
            ]);
        } 
        
    }
}

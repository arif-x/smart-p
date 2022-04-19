<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriDevelopment;
use App\Models\Development;
use App\Models\JawabanDevelopment;
use DB;

class DevelopmentController extends Controller
{
    public function index(Request $request){
        $data_kategori_development = KategoriDevelopment::get();

        $data_development = DB::select(DB::raw('select development.*, jawaban_development.id_user, jawaban_development.id_anak, jawaban_development.jawaban from `development` left join `jawaban_development` on `jawaban_development`.`id_development` = `development`.`id_development` and (`id_anak` = '.$request->id_anak.' and `id_user` = '.$request->id_user.') or (`id_user` is null and `id_anak` is null) where `id_kategori_development` = '.$data_kategori_development[0]->id_kategori_development.''));

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data_kategori_development' => $data_kategori_development,
            'data_development' => $data_development
        ], 200);

    }

    public function single(Request $request){
        $data_kategori_development = KategoriDevelopment::get();

        $data_development = DB::select(DB::raw('select development.*, jawaban_development.id_user, jawaban_development.id_anak, jawaban_development.jawaban from `development` left join `jawaban_development` on `jawaban_development`.`id_development` = `development`.`id_development` and (`id_anak` = '.$request->id_anak.' and `id_user` = '.$request->id_user.') or (`id_user` is null and `id_anak` is null) where `id_kategori_development` = '.$request->id_kategori_development.''));

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data_kategori_development' => $data_kategori_development,
            'data_development' => $data_development
        ], 200);

    }

    public function store(Request $request){
        $check = JawabanDevelopment::where('id_user', $request->id_user)->where('id_anak', $request->id_anak)->where('id_development', $request->id_development)->first();

        if(empty($check)){
            $data = JawabanDevelopment::create([
                'id_development' => $request->id_development,
                'jawaban' => $request->jawaban,
                'id_user' => $request->id_user,
                'id_anak' => $request->id_anak,
            ]);

            if(!$data){
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Ditambah',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Data Ditambah',
                    'data' => $data
                ], 200);
            }
        } else {
            $data = JawabanDevelopment::where('id_development', $request->id_development)->where('id_user', $request->id_user)->update([
                'jawaban' => $request->jawaban
            ]);

            if(!$data){
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diupdate',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Data Diupdate',
                    'data' => $data
                ], 200);
            }
        }
    }
}

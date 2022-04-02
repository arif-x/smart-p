<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\User;
use App\Models\RecordPerkembangan;
use Auth;

class AnakController extends Controller
{
    public function index(Request $request){
        $data = Anak::where('id_user', $request->id_user)->get();
        if(empty($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data Kosong'
            ], 201);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Didapat',
                'data' => $data
            ], 200);
        }
    }

    public function store(Request $request){
        $data = Anak::updateOrCreate(
            ['id_anak' => $request->id_anak],
            [
                'id_user' => $request->id_user,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nama_anak' => $request->nama_anak,
                'nama_panggilan' => $request->nama_panggilan,
                'tanggal_lahir' => $request->tanggal_lahir,
                'minggu_kehamilan' => $request->minggu_kehamilan,
                'tinggi_badan_lahir' => $request->tinggi_badan_lahir,
                'berat_badan_lahir' => $request->berat_badan_lahir,
                'lingkar_kepala_lahir' => $request->lingkar_kepala_lahir,
            ]
        );

        if(!($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Dibuat/Diedit'
            ], 201);
        } else {

            User::where('id_user', $request->id_user)->update([
                'status' => 2
            ]); 

            $record = RecordPerkembangan::create([
                'id_anak' => $data->id_anak,
                'tanggal' => $request->tanggal,
                'tinggi_badan_perkembangan' => $request->tinggi_badan_perkembangan,
                'berat_badan_perkembangan' => $request->berat_badan_perkembangan,
                'lingkar_kepala_perkembangan' => $request->lingkar_kepala_perkembangan,
            ]);

            if(!($record)){
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Dibuat/Diedit'
                ], 201);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Data Dibuat/Diedit',
                    'data_anak' => [$data],
                    'data_record' => [$record]
                ], 200);
            }
        }
    }

    public function show($id, Request $request){
        $data = Anak::where('id_user', $request->id_user)->find($id);
        if(empty($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Didapat'
            ], 201);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Didapat',
                'data' => [$data]
            ], 200);
        }
    }

    public function destroy($id, Request $request){
        $data = Anak::where('id_user', $request->id_user)->find($id)->delete();
        if(!($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Dihapus'
            ], 201);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Dihapus',
                'data' => [$data]
            ], 200);
        }
    }
}

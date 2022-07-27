<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LikeKonsultasi;
use App\Models\Konsultasi;

class LikeKonsultasiController extends Controller
{
    public function store(Request $request){
        $data_insert = [
            'id_user' => $request->id_user,
            'id_konsultasi' => $request->id_konsultasi, 
        ];
        $data = LikeKonsultasi::insert($data_insert);
        $total = LikeKonsultasi::where($request->id_konsultasi)->count();
        $konsultasi_count = Konsultasi::where($request->id_konsultasi)->update([
            'jumlah_like' => $total
        ]);

        if($data){
            return response()->json([
                'status' => true,
                'message' => 'Data Ditambahkan',
                'data_insert' => $data_insert, 
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Gagal Ditambahkan',
            ], 200);
        }
    }

    public function destroy(Request $request){
        $data_delete = [
            'id_user' => $request->id_user,
            'id_konsultasi' => $request->id_konsultasi, 
        ];

        $data = LikeKonsultasi::where('id_user', $request->id_user)->where('id_konsultasi', $request->id_konsultasi)->delete();

        $total = LikeKonsultasi::where($request->id_konsultasi)->count();
        $konsultasi_count = Konsultasi::where($request->id_konsultasi)->update([
            'jumlah_like' => $total
        ]);

        if($data){
            return response()->json([
                'status' => true,
                'message' => 'Data Dihapus',
                'data_delete' => $data_delete, 
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Gagal Dihapus',
            ], 200);
        }
    }
}

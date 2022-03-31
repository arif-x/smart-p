<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\User;
use Auth;

class AnakController extends Controller
{
    public function index(){
        $data = Anak::where('id_user', Auth::user()->id_user)->get();
        if(empty($data)){
            return response()->json([
                'error' => false,
                'message' => 'Data Kosong'
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Data Didapat',
                'data' => $data
            ], 200);
        }
    }

    public function store(Request $request){
        $data = Anak::updateOrCreate(
            ['id_anak' => $request->id_anak],
            [
                'id_user' => Auth::user()->id_user,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nama_anak' => $request->nama_anak,
                'nama_panggilan' => $request->nama_panggilan,
                'tanggal_lahir' => $request->tanggal_lahir,
                'minggu_kehamilan' => $request->minggu_kehamilan,
                'tinggi_badan_lahir' => $request->tinggi_badan_lahir,
                'berat_badan_lahir' => $request->berat_badan_lahir
            ]
        );

        if(!($data)){
            return response()->json([
                'error' => false,
                'message' => 'Data Gagal Dibuat/Diedit'
            ], 201);
        } else {

            $check = Anak::where('id_user', Auth::user()->id_user)->first();

            if(empty($check)){
                User::where('id_user', Auth::user()->id_user)->update([
                    'status' => 2
                ]); 
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Dibuat/Diedit',
                'data' => [$data]
            ], 200);
        }
    }

    public function show($id){
        $data = Anak::where('id_user', Auth::user()->id_user)->find($id);
        if(empty($data)){
            return response()->json([
                'error' => false,
                'message' => 'Data Gagal Didapat'
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Data Didapat',
                'data' => [$data]
            ], 200);
        }
    }

    public function destroy($id){
        $data = Anak::where('id_user', Auth::user()->id_user)->find($id)->delete();
        if(!($data)){
            return response()->json([
                'error' => false,
                'message' => 'Data Gagal Dihapus'
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Data Dihapus',
                'data' => [$data]
            ], 200);
        }
    }
}

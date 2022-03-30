<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak;
use Auth;

class AnakController extends Controller
{
    public function index(){
        $data = Anak::where('id_user', Auth::user()->id_user)->get();
        if(empty($data)){
            return response()->json([
                'Success' => 'Data kosong'
            ], 201);
        } else {
            return response()->json([
                'Success' => 'Data didapat',
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
                'berat_badan_lahir' => $request->berat_badan_lahir,
                'lingkar_kepala_lahir' => $request->lingkar_kepala_lahir,
                'tinggi_badan_perkembangan' => $request->tinggi_badan_perkembangan,
                'berat_badan_perkembangan' => $request->berat_badan_perkembangan,
                'lingkar_kepala_perkembangan' => $request->lingkar_kepala_perkembangan,
                'status_vaksin' => $request->status_vaksin,
            ]
        );

        if(!($data)){
            return response()->json([
                'Error' => 'Data nggak ditambah/edit'
            ], 201);
        } else {
            return response()->json([
                'Success' => 'Data ditambah/edit',
                'data' => $data
            ], 200);
        }
    }

    public function show($id){
        $data = Anak::where('id_user', Auth::user()->id_user)->find($id);
        if(empty($data)){
            return response()->json([
                'Error' => 'Data nggak ada'
            ], 201);
        } else {
            return response()->json([
                'Success' => 'Data ada',
                'data' => $data
            ], 200);
        }
    }

    public function destroy($id){
        $data = Anak::where('id_user', Auth::user()->id_user)->find($id)->delete();
        if(!($data)){
            return response()->json([
                'Error' => 'Data nggak ada'
            ], 201);
        } else {
            return response()->json([
                'Success' => 'Data dihapus',
                'data' => $data
            ], 200);
        }
    }
}

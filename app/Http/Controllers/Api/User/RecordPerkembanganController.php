<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecordPerkembangan;

class RecordPerkembanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RecordPerkembangan::get();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = RecordPerkembangan::updateOrCreate(
            ['id_record_perkembangan' => $request->id_record_perkembangan],
            [
                'id_anak' => $request->id_anak,
                'tanggal' => $request->tanggal,
                'tinggi_badan_perkembangan' => $request->tinggi_badan_perkembangan,
                'berat_badan_perkembangan' => $request->berat_badan_perkembangan,
                'lingkar_kepala_perkembangan' => $request->lingkar_kepala_perkembangan,
            ]
        );

        if(!($data)){
            return response()->json([
                'error' => false,
                'message' => 'Data Gagal Dibuat/Diedit'
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Data Dibuat/Diedit',
                'data' => [$data]
            ], 200);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = RecordPerkembangan::find($id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RecordPerkembangan::find($id)->delete();
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

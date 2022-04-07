<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaksin;
use Auth;

class VaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Vaksin::get();
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

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Vaksin::updateOrCreate(
            ['id_vaksin' => $request->id_vaksin],
            [
                'nama_vaksin' => $request->nama_vaksin,
                'jadwal_vaksin' => $request->jadwal_vaksin,
                'keterangan_vaksin' => $request->keterangan_vaksin
            ]
        );

        if(!($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Dibuat/Diedit'
            ], 201);
        } else {
            return response()->json([
                'status' => true,
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
        $data = Vaksin::find($id);
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Vaksin::find($id)->delete();
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
